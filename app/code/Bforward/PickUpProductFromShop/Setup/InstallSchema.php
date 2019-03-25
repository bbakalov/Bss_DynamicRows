<?php

namespace Bforward\PickUpProductFromShop\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->createShopListTable($setup);
        $this->createProductShopStockTable($setup);

        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $installer
     *
     * @return null
     * @throws \Zend_Db_Exception
     */
    private function createShopListTable($installer)
    {
        $connection = $installer->getConnection();
        $tableName  = $installer->getTable(Schema::SHOP_LIST_TABLE);
        $table      = $connection->newTable($tableName)->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false, 'default' => '']
        )->addColumn(
            'address',
            Table::TYPE_TEXT,
            Table::MAX_TEXT_SIZE,
            ['nullbale' => true]
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            Table::DEFAULT_TEXT_SIZE,
            ['nullbale' => true]
        )->addColumn(
            'phone_number',
            Table::TYPE_TEXT,
            Table::DEFAULT_TEXT_SIZE,
            ['nullbale' => true]
        )->addColumn('created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT]
        )->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]
        )->addColumn(
            'is_active',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1']
        )->addColumn(
            'store_id',
            Table::TYPE_SMALLINT,
            5,
            ['nullable' => false, 'default' => '0', 'unsigned' => true],
            'Store ID'
        )->addForeignKey(
            $installer->getFkName(
                $installer->getTable(Schema::SHOP_LIST_TABLE),
                'store_id',
                'store',
                'store_id'
            ),
            'store_id',
            $installer->getTable('store'),
            'store_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_NO_ACTION
        )->setOption('charset', 'utf8');

        $connection->createTable($table);
    }

    /**
     * @param SchemaSetupInterface $installer
     *
     * @return null
     * @throws \Zend_Db_Exception
     */
    private function createProductShopStockTable($installer)
    {
        $connection = $installer->getConnection();
        $tableName  = $installer->getTable(Schema::PRODUCT_SHOP_STOCK_TABLE);
        $table      = $connection->newTable($tableName)->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
        )->addColumn(
            'product_id',
            Table::TYPE_INTEGER,
            10,
            ['nullable' => false, 'unsigned' => true]
        )->addColumn(
            'shop_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true]
        )->addColumn(
            'qty',
            Table::TYPE_DECIMAL,
            null,
            [
                Table::OPTION_UNSIGNED => false,
                Table::OPTION_NULLABLE => false,
                Table::OPTION_DEFAULT => 0,
                Table::OPTION_PRECISION => 10,
                Table::OPTION_SCALE => 4,
            ],
            'Quantity'
        )->addColumn('created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT]
        )->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]
        )->addForeignKey(
            $installer->getFkName(
                Schema::PRODUCT_SHOP_STOCK_TABLE,
                'product_id',
                'catalog_product_entity',
                'entity_id'
            ),
            'product_id',
            $installer->getTable('catalog_product_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
         ->addForeignKey(
            $installer->getFkName(
                Schema::PRODUCT_SHOP_STOCK_TABLE,
                'shop_id',
                Schema::SHOP_LIST_TABLE,
                'id'
            ),
            'shop_id',
            $installer->getTable(Schema::SHOP_LIST_TABLE),
            'id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
         ->setOption('charset', 'utf8');

        $connection->createTable($table);
    }
}
