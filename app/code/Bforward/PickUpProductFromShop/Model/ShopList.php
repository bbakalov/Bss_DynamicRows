<?php

namespace Bforward\PickUpProductFromShop\Model;

class ShopList extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'bforward_pickupproductfromshop_shoplist';

    protected $_cacheTag = 'bforward_pickupproductfromshop_shoplist';

    protected $_eventPrefix = 'bforward_pickupproductfromshop_shoplist';

    protected function _construct()
    {
        $this->_init('Bforward\PickUpProductFromShop\Model\ResourceModel\ShopList');
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