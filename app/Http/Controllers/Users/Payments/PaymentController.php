<?php

namespace App\Http\Controllers\Users\Payments;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Payments\PaymentRequest;
use App\Http\Resources\Payments\PaymentsResource;
use App\Models\Payments\Payment;
use App\Models\Payments\PromotionalCode;
use App\Models\Subscriptions\Subscription;
use App\Repositories\Payments\PaymentsRepository;
use App\Repositories\Payments\PromotionalCodeRepository;
use App\Repositories\Payments\Subscriptions\SubscriptionRepository;
use App\Services\Payments\PaymentService;
use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends ApiController
{
    /**
     * @param PaymentService $paymentService
     * @param PaymentsRepository $paymentsRepository
     * @param SubscriptionRepository $subscriptionRepository
     * @param PromotionalCodeRepository $promotionalCodeRepository
     */
    public function __construct(
        private PaymentService            $paymentService,
        private PaymentsRepository        $paymentsRepository,
        private SubscriptionRepository    $subscriptionRepository,
        private PromotionalCodeRepository $promotionalCodeRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->paymentsRepository->findBy(['user_id' => Auth::id()], true);

            return PaymentsResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param PaymentRequest $request
     * @return JsonResponse
     */
    public function payment(PaymentRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            /**
             * @var Subscription $subscription
             */
            $subscription = $this->subscriptionRepository->find($data['subscribe_id']);
            if (!$subscription) {
                return $this->noFoundResponse();
            }
            $data['amount'] = $subscription->price;
            $payment = $this->paymentService->save($data);
            if (!$payment) {
                return $this->badResponse('P??atno???? nie powid??a si??');
            }

            $res = $this->paymentService->payment($payment);
            if ($res['success'] == 1) {
                return $this->successResponse('Przekierowanie do bramki p??atniczej', [
                    'redirectUrl' => $res['url']
                ]);
            }

            return $this->badResponse('P??atno???? si?? nie powiod??a. Spr??buj jeszcze raz. Je??li problem si?? powt??rzy skontaktuj si?? z nami');
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $paymentId
     * @return JsonResponse
     */
    public function finalization(int $paymentId): JsonResponse
    {
        try {
            /**
             * @var Payment $payment
             */
            $payment = $this->paymentsRepository->find($paymentId);
            if (!$payment) {
                return $this->badResponse('P??atno???? nie istnieje');
            }

            $res = $this->paymentService->payment($payment);

            return $this->successResponse('Przekierowanie do bramki p??atno??ci', [
                'redirectUrl' => $res['url']
            ]);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param string $code
     * @return JsonResponse
     */
    public function checkRabatCode(string $code): JsonResponse
    {
        /**
         * @var PromotionalCode|null $code
         */
        $code = $this->promotionalCodeRepository->findOneBy(['name' => $code]);

        if (!$code) {
            return $this->badResponse('Podany kod rabatowy jest nieprawid??owy');
        }

        return $this->successResponse('', [
            'code' => $code
        ]);
    }
}
