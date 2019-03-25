<?php

namespace Bforward\PickUpProductFromShop\Model;

class ProductShopStock extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'bforward_pickupproductfromshop_productshopstock';

    protected $_cacheTag = 'bforward_pickupproductfromshop_productshopstock';

    protected $_eventPrefix = 'bforward_pickupproductfromshop_productshopstock';

    protected function _construct()
    {
        $this->_init(\Bforward\PickUpProductFromShop\Model\ResourceModel\ProductShopStock::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        return [];
    }
}