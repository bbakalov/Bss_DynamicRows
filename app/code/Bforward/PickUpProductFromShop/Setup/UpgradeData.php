<?php

namespace Bforward\PickUpProductFromShop\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Upgrade Data script
 *
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var \Magento\Sales\Setup\SalesSetupFactory
     */
    private $salesSetupFactory;
    /**
     * @var \Magento\Quote\Setup\QuoteSetupFactory
     */
    private $quoteSetupFactory;

    /**
     * @param \Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory
     * @param \Magento\Quote\Setup\QuoteSetupFactory $quoteSetupFactory
     */
    public function __construct(
        \Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory,
        \Magento\Quote\Setup\QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2', '<=')) {
            /** @var \Magento\Sales\Setup\SalesSetup $catalogSetup */
            $salesSetup = $this->salesSetupFactory->create(['resourceName' => 'sales_setup', 'setup' => $setup]);
            $salesSetup->addAttribute(\Magento\Sales\Model\Order::ENTITY, 'pickup_shop_id', [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'length'   => 5,
                'visible'  => false,
                'nullable' => true,
            ]);
        }
        if (version_compare($context->getVersion(), '0.0.3', '<=')) {
            /** @var \Magento\Quote\Setup\QuoteSetup $quoteSetup */
            $quoteSetup = $this->quoteSetupFactory->create(['setup' => $setup]);
            $quoteSetup->addAttribute('quote', 'pickup_shop_id', [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'length'   => 5,
                'visible'  => false,
                'nullable' => true,
            ]);
        }

        $setup->endSetup();
    }
}
