<?php

namespace IrishTitan\Handshake\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface as Context;
use Magento\Framework\Setup\SchemaSetupInterface as Setup;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Run the migrations on 'setup:upgrade'.
     *
     * @param Setup $setup
     * @param Context $context
     */
    public function install(Setup $setup, Context $context)
    {
        $setup->startSetup();



        $setup->endSetup();
    }
}
