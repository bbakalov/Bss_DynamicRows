<?php

namespace Bss\DynamicRows\Setup;



use Magento\Framework\Setup\InstallSchemaInterface;

use Magento\Framework\Setup\ModuleContextInterface;

use Magento\Framework\Setup\SchemaSetupInterface;

use Magento\Framework\DB\Ddl\Table as Table;



class InstallSchema implements InstallSchemaInterface

{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)

    {

        $installer = $setup;



        $installer->startSetup();



        $table = $installer->getConnection()->newTable(

            $installer->getTable('bss_dynamic_rows')

        )->addColumn(

            'row_id',

            Table::TYPE_INTEGER,

            null,

            ['identity' => true, 'nullable' => false, 'primary' => true],

            'ID'

        )->addColumn(

            'row_name',

            Table::TYPE_TEXT,

            null,

            ['nullable' => false],

            'Row Name'

        )->addColumn(

            'birthday',

            Table::TYPE_DATE,

            null,

            ['nullable' => false],

            'Date of birth'

        )->addColumn(

            'sex',

            Table::TYPE_SMALLINT,

            null,

            ['nullable' => false],

            'Sex'

        )->addColumn(

            'position',

            Table::TYPE_INTEGER,

            null,

            ['nullable' => false],

            'Position'

        )->setComment(

            'Bss Dynamic Rows'

        );



        $installer->getConnection()->createTable($table);



        $installer->endSetup();

    }

}