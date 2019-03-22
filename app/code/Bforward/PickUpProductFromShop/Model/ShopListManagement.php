<?php

namespace Bforward\PickUpProductFromShop\Model;

use Bforward\PickUpProductFromShop\Api\ShopListManagementInterface;

class ShopListManagement implements ShopListManagementInterface
{
    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListFactory
     */
    private $shopList;

    /**
     * ShopListManagement constructor.
     *
     * @param \Bforward\PickUpProductFromShop\Model\ShopListFactory $shopList
     */
    public function __construct(ShopListFactory $shopList)
    {
        $this->shopList = $shopList;
    }

    /**
     * @return array|\Bforward\PickUpProductFromShop\Api\Data\ShopListInterface[]
     */
    public function fetchShops()
    {
        $list = [];
        foreach ($this->shopList->create()->getCollection() as $shop) {
            $list [] = $shop;
        }
        return $list;
    }
}