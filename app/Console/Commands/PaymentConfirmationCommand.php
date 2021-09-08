<?php

namespace App\Console\Commands;

use App\Models\Payments\Payment;
use App\Repositories\Payments\PaymentsRepository;
use Illuminate\Console\Command;
use OpenPayU_Exception;
use OpenPayU_Order;
use OpenPayU_Configuration;

class PaymentConfirmationCommand extends Command
{
    /**
     * @var string $signature
     */
    protected $signature = 'payment:confirmation';

    /**
     * @var string $description
     */
    protected $description = 'Akceptacja opłat abonamentów';

    private static int $POS_ID = 419018;
    private static string $MD5 = 'ced07dd4abda7f9745cc68f6bcaac397';
    private static int $CLIENT_ID = 419018;
    private static string $CLIENT_SECRET = '48594b331388856fa0c452001ae16b3a';
    private static string $ENVIRONMENT = 'sandbox';

    public function __construct(
        private PaymentsRepository $paymentsRepository
    )
    {
        parent::__construct();
        OpenPayU_Configuration::setEnvironment(self::$ENVIRONMENT);
        OpenPayU_Configuration::setMerchantPosId(self::$POS_ID);
        OpenPayU_Configuration::setSignatureKey(self::$MD5);
        OpenPayU_Configuration::setOauthClientId(self::$CLIENT_ID);
        OpenPayU_Configuration::setOauthClientSecret(self::$CLIENT_SECRET);
    }

    /**
     * @return int
     * @throws OpenPayU_Exception
     */
    public function handle(): int
    {
        $paymentsPayu = $this->paymentsRepository->findBy([
           'payment_type' => Payment::$paymentTypes['payu'],
           'status' => Payment::$statuses['STARTED']
        ]);

        if ($paymentsPayu->count() > 0) {
            /**
             * @var Payment $paymentPayu
             */
            foreach ($paymentsPayu as $paymentPayu) {
                $response = OpenPayU_Order::retrieve($paymentPayu->payu_id);
                $statusPayu = $response->getResponse()->orders[0]->status;

                if ($statusPayu == 'COMPLETED') {
                    $paymentPayu->update([
                        'status' => Payment::$statuses['PAID']
                    ]);
                }

                if ($statusPayu == 'PENDING') {
                    $paymentPayu->update([
                        'status' => Payment::$statuses['PENDING']
                    ]);
                }

                if ($statusPayu == 'CANCELED') {
                    $paymentPayu->update([
                        'status' => Payment::$statuses['CANCEL']
                    ]);
                }
            }
        }

        return 0;
    }
}
