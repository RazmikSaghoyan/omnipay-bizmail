<?php

namespace Omnipay\Bizmail\Message;

use GuzzleHttp\Client;
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
    protected $paymentUrl = 'https://biz.mail.ru/api/v1/platform/domains/';

    /**
     * Sets the request biz Api Key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setBizApiKey($value)
    {
        return $this->setParameter('bizApiKey', $value);
    }

    /**
     * Get the request biz Api Key.
     * @return $this
     */
    public function getBizApiKey()
    {
        return $this->getParameter('bizApiKey');
    }

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
            'description' => $this->getDescription() ?? ''
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
        $response = $this->createPaymentRequest($data);

        return $this->response = new PurchaseResponse($this, $response);
    }

    /**
     * @param $data
     *
     * @return array|mixed
     */
    protected function createPaymentRequest($data)
    {
        $client = new Client([
            'headers' => [
                'MRG-BIZ-PARTNER-Key' => $this->getBizApiKey()
            ]
        ]);
        $response = $client->post($this->getPaymentUrl(), [
            'form_params' => [
                'type'        => $data['type'],
                'kind'        => $data['kind'],
                'amount'      => $data['amount'],
                'description' => $data['description'],
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
