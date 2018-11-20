<?php
namespace Omnipay\Bizmail\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
/**
 * Class PurchaseResponse
 * @package Omnipay\Bizmail\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * Gateway payment Url
     * @var string
     */
    protected $paymentUrl = 'https://payments.ameriabank.am/webservice/PaymentService.svc?wsdl';

    /**
     * Set successful to false, as transaction is not completed yet
     * @return bool
     */
    public function isSuccessful()
    {
        return true;
    }

    /**
     * Mark purchase as redirect type
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**omnipay/common
     * Get redirect data
     * @return array|mixed
     */
    public function getRedirectData()
    {
        return $this->data;
    }


    /**
     * Create Payment Request Soap coll
     * @return mixed
     */
    public function createPaymentRequest()
    {
        $client = new \SoapClient($this->getPaymentUrl(), [
            'soap_version'    => SOAP_1_1,
            'exceptions'      => true,
            'trace'           => 1,
            'wsdl_local_copy' => true
        ]);

        $args['paymentfields'] = array(
            'Opaque'        => $this->data['Opaque'],
            'backURL'       => $this->data['backURL'],
            'OrderID'       => $this->data['OrderID'],
            'Username'      => $this->data['Username'],
            'Password'      => $this->data['Password'],
            'ClientID'      => $this->data['ClientID'],
            'Description'   => $this->data['Description'],
            'Currency'      => $this->data['Currency'],
            'PaymentAmount' => $this->data['PaymentAmount'],
        );
        dd($args);
        return $webService = $client->GetPaymentID($args);
    }
}
