<?php

namespace Bss\DynamicRows\Model\ResourceModel\DynamicRows;



use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;



class Collection extends AbstractCollection

{

    protected $_idFieldName = 'row_id';



    protected function _construct()

    {

        $this->_init(

            'Bss\DynamicRows\Model\DynamicRows',

            'Bss\DynamicRows\Model\ResourceModel\DynamicRows'

        );

    }

}