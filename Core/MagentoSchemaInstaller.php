<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface as Context;
use Magento\Framework\Setup\SchemaSetupInterface as Setup;

class MagentoSchemaInstaller implements InstallSchemaInterface
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

        $this->run();

        $setup->endSetup();
    }

    /**
     * The migrations to run.
     *
     * @return void
     */
    protected function run()
    {

    }
}
