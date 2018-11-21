<?php

namespace Omnipay\Bizmail;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\AbstractGateway;
use Omnipay\Bizmail\Message\PurchaseRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;


/**
 * Class Gateway
 * @package Omnipay\Bizmail
 *
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 */
class Gateway extends AbstractGateway
{

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return 'Bizmail';
    }

    /**
     * Gateway constructor.
     *
     * @param \Omnipay\Common\Http\ClientInterface|null      $httpClient
     * @param \Symfony\Component\HttpFoundation\Request|null $httpRequest
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        parent::__construct($httpClient, $httpRequest);
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
     * Create a purchase request
     *
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }
}
