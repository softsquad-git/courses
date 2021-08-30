<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Repositories\Payments\PaymentsRepository;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentsRepository $paymentsRepository,
        private PaymentService $paymentService
    )
    {
    }

    public function index(Request $request)
    {
        $data = $this->paymentsRepository->findBy($request->all());

        return view('admin.payments.index', [
            'data' => $data,
            'title' => 'Płatności'
        ]);
    }
}
