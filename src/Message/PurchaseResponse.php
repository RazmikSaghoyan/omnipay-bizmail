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
     * Indicates whether transaction was successful
     * @return bool
     */
    public function isSuccessful()
    {
        return ($this->data['status'] ?? 0) == 40;
    }

    /**
     * Indicates whether transaction was redirect
     * @return bool
     */
    public function isRedirect()
    {
        return ($this->data['status'] ?? 0) == 20;
    }

    /**
     * Gets the redirect target url.
     * @return string
     */
    public function getRedirectUrl()
    {
        return 'https://biz.mail.ru/domains/goto/billing/pay/';
    }

    /**
     * Response Message
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return $this->data['status_human'] ?? '';
    }

    /**
     * Get the response data.
     * @return mixed
     */
    public function getData()
    {
        return ['transaction' => $this->data];
    }

    /**
     * Get TransactionId
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data['eid'] ?? '';
    }
}
