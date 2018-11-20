<?php
namespace Omnipay\Bizmail\Message;
use Omnipay\Common\Message\AbstractResponse;
/**
 * Class CompletePurchaseResponse
 * @package Omnipay\Bizmail\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{

    /**
     * Indicates whether transaction was successful
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->data->status === 40;
    }

    /**
     * Get TransactionId
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data->eid ?? '';
    }


    /**
     * Get
     * @return null|string
     */
    public function getTransactionReference()
    {
        return $this->data->eid ?? '';
    }

}