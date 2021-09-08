<?php

namespace App\Services\Payments;

use App\Models\Payments\Payment;
use \Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use \OpenPayU_Exception;

class PaymentService
{
    public function __construct(
        private PayuService $payuService,
        private PayPalService $payPalService
    )
    {
    }

    /**
     * @param Payment $payment
     * @return array
     * @throws OpenPayU_Exception
     */
    #[ArrayShape(['url' => "int|mixed|string", 'success' => "null"])] public function payment(Payment $payment): array
    {
        $data = [
            'url' => '',
            'success' => null
        ];

        if ($payment->payment_type == Payment::$paymentTypes['payu']) {
            $item = $this->payuService->pay($payment);

            if ($item->status?->statusCode == 'SUCCESS') {
                $data['url'] = $item->redirectUri;
                $data['success'] = 1;
            } else {
                $data['url'] = null;
                $data['success'] = 0;
            }
        }

        return $data;
    }

    /**
     * @param array $data
     * @return Payment
     * @throws Exception
     */
    public function save(array $data): Payment
    {
        DB::beginTransaction();
        try {
            $data['user_id'] = Auth::id();
            $data['token'] = Str::random(64);
            $data['status'] = Payment::$statuses['STARTED'];
            if ($data['payment_type'] != Payment::$paymentTypes['payu'] && $data['payment_type'] != Payment::$paymentTypes['paypal']) {
                throw new Exception('Brak danego sposobu płatności');
            }

            $payment = Payment::create($data);

            DB::commit();
            return $payment;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
