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
        private PayuService $payuService
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

        $item = $this->payuService->pay($payment);

        $data['url'] = $item->redirectUri;
        $data['url'] = 1;

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

            $payment = Payment::create($data);

            DB::commit();
            return $payment;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
