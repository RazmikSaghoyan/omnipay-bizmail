<?php

namespace Omnipay\Bizmail\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * Class PurchaseRequest
 * @package Omnipay\Bizmail\Message
 */
class PurchaseRequest extends AbstractRequest
{

    /**
     * Gateway payment Url
     * @var string
     */
    protected $paymentUrl = 'https://testbiz3.mail.ru/platform/domains/';

    /**
     * Sets the request biz Project Id.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setBizProjectId($value)
    {
        return $this->setParameter('bizProjectId', $value);
    }

    /**
     * Get the request biz Project Id.
     * @return $this
     */
    public function getBizProjectId()
    {
        return $this->getParameter('bizProjectId');
    }

    /**
     * Sets the request billing type.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

    /**
     * Get the request billing type.
     * @return $this
     */
    public function getType()
    {
        return $this->getParameter('type');
    }

    /**
     * Sets the request kind.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setKind($value)
    {
        return $this->setParameter('kind', $value);
    }

    /**
     * Get the request kind.
     * @return $this
     */
    public function getKind()
    {
        return $this->getParameter('kind');
    }

    /**
     * Sets the request Amount
     *
     * @param $value
     *
     * @return $this
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * Get Amount
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Sets the request description.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    /**
     * Get the request description.
     * @return $this
     */
    public function getDescription()
    {
        return $this->getParameter('description');
    }

    /**
     * get payment Url
     * @return string
     */
    public function getPaymentUrl()
    {
        return $this->paymentUrl.$this->getBizProjectId().'/transactions/';
    }


    /**
     * Prepare data to send
     * @return array|mixed
     */
    public function getData()
    {
        $this->validate('bizProjectId', 'type', 'kind', 'amount');

        return [
            'type'        => $this->getType(),
            'kind'        => $this->getKind(),
            'amount'      => $this->getAmount(),
            'description' => $this->getDescription()
        ];
    }

    /**
     * Send data and return response instance
     *
     * @param mixed $data
     *
     * @return \Omnipay\Bizmail\Message\PurchaseResponse|\Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $payment = $this->createPaymentRequest($data);
        if (empty($payment->GetPaymentIDResult->PaymentID) || $payment->GetPaymentIDResult->Respmessage != 'OK') {
            return $payment->GetPaymentIDResult;
        } else {

            $data['PaymentId'] = $payment->GetPaymentIDResult->PaymentID;
        }

        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * Create Payment Request Ameria Bank
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    protected function createPaymentRequest($data)
    {
        $args['paymentfields'] = $data;

        $client = new \SoapClient($this->getPaymentUrl(), [
            'soap_version'    => SOAP_1_1,
            'exceptions'      => true,
            'trace'           => 1,
            'wsdl_local_copy' => true
        ]);

        return $webService = $client->GetPaymentID($args);
    }

}