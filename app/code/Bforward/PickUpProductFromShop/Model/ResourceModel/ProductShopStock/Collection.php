<?php

namespace Bforward\PickUpProductFromShop\Model\ResourceModel\ProductShopStock;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'bforward_pickupproductfromshop_productshopstock_collection';
    protected $_eventObject = 'shoplist_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
//        $this->_init('Bforward\PickUpProductFromShop\Model\ShopList',
//            'Bforward\PickUpProductFromShop\Model\ResourceModel\ShopList');
        $this->_init(\Bforward\PickUpProductFromShop\Model\ProductShopStock::class,
            \Bforward\PickUpProductFromShop\Model\ResourceModel\ProductShopStock::class);
    }
}

