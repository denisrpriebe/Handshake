<?php

namespace IrishTitan\Handshake\Core\Security;

use Magento\Framework\Registry as MagentoRegistry;

class Registry
{

    /**
     * The magento registry instance.
     *
     * @var MagentoRegistry
     */
    protected $registry;

    /**
     * Registry constructor.
     *
     * @param MagentoRegistry $registry
     */
    public function __construct(MagentoRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Secure the area.
     *
     * @return void
     */
    public function secure()
    {
        $this->registry->unregister('isSecureArea');
        $this->registry->register('isSecureArea', true);
    }

}