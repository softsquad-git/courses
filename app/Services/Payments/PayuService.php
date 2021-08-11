<?php

namespace App\Services\Payments;
use App\Models\Payments\Payment;
use Illuminate\Support\Str;
use \OpenPayU_Configuration;
use \OpenPayU_Exception_Configuration;
use \OpenPayU_Order;
use \OpenPayU_Exception;
use \Exception;

class PayuService
{
    private static int $POS_ID = 419018;
    private static string $MD5 = 'ced07dd4abda7f9745cc68f6bcaac397';
    private static int $CLIENT_ID = 419018;
    private static string $CLIENT_SECRET = '48594b331388856fa0c452001ae16b3a';
    private static string $ENVIRONMENT = 'sandbox';

    /**
     * @throws OpenPayU_Exception_Configuration
     */
    public function __construct()
    {
        OpenPayU_Configuration::setEnvironment(self::$ENVIRONMENT);
        OpenPayU_Configuration::setMerchantPosId(self::$POS_ID);
        OpenPayU_Configuration::setSignatureKey(self::$MD5);
        OpenPayU_Configuration::setOauthClientId(self::$CLIENT_ID);
        OpenPayU_Configuration::setOauthClientSecret(self::$CLIENT_SECRET);
    }

    /**
     * @param Payment $payment
     * @return object
     * @throws OpenPayU_Exception
     * @throws Exception
     */
    public function pay(Payment $payment): object
    {
        $order['continueUrl'] = route('payment.success');
        $order['notifyUrl'] = route('payment.notify');
        $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
        $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $order['description'] = 'Opłata abonamentu za kurs';
        $order['currencyCode'] = 'PLN';
        $order['totalAmount'] = $payment->price;
        $order['extOrderId'] = Str::random(4);

        $order['products'][0]['name'] = 'Abonament';
        $order['products'][0]['unitPrice'] = $payment->price;
        $order['products'][0]['quantity'] = 1;

        $order['buyer']['email'] = $payment->user?->email;
        $order['buyer']['phone'] = $payment->user?->phone;
        $order['buyer']['firstName'] = $payment->user?->first_name;
        $order['buyer']['lastName'] = $payment->user?->last_name;

        $response = OpenPayU_Order::create($order);
        if ($response->getStatus() != 'SUCCESS') {
            throw new Exception('Wystąpił błąd podczas płatności');
        }

        $response = $response->getResponse();
        $payment->update(['payu_order_id' => $response->orderId]);

        return $response;
    }
}
