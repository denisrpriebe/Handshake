<?php

namespace IrishTitan\Handshake\Core;

use Magento\Customer\Model\Session as MagentoCustomerSession;
use Magento\Framework\Session\SessionManager;

class Session
{

    /**
     * The magento 2 session instance.
     * Default is the customer session.
     *
     * @var
     */
    protected $instance;

    /**
     * Session constructor.
     *
     * @param MagentoCustomerSession $instance
     */
    public function __construct(MagentoCustomerSession $instance)
    {
        $this->setInstance($instance);
    }

    /**
     * Set the session instance.
     *
     * @param SessionManager $instance
     */
    public function setInstance(SessionManager $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Save a variable to the session.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->instance->setData($key, $value);
    }

    /**
     * Retrieve a value from the session.
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->instance->getData($key, false);
    }

    /**
     * Check if the session has the given key.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return $this->instance->get($key, false) ? true : false;
    }

    /**
     * Clear all session data.
     *
     * @return mixed
     */
    public function flush()
    {
        return $this->instance->clearStorage();
    }

    /**
     * Unset a value from the session.
     *
     * @param $key
     * @return mixed
     */
    public function forget($key)
    {
        return $this->instance->getData($key, true);
    }

}