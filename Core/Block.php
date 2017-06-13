<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Block extends Template
{

    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

}