<?php

namespace IrishTitan\Handshake\Core;

use Magento\Customer\Model\Session as CustomerSession;

class Auth
{

    /**
     * The customer session instance.
     *
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * Auth constructor.
     *
     * @param CustomerSession $customerSession
     */
    public function __construct(CustomerSession $customerSession)
    {
        $this->customerSession = $customerSession;
    }

    /**
     * Check if there is an authenticated user.
     *
     * @return bool
     */
    public function check(): bool
    {
        return $this->customerSession->isLoggedIn();
    }

    /**
     * Get the authenticated user.
     *
     * @return bool|\Magento\Customer\Model\Customer
     */
    public function user()
    {
        return $this->check() ? $this->customerSession->getCustomer() : false;
    }

}