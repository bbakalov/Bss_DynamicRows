<?php

namespace Bforward\PickUpProductFromShop\Model;

use Bforward\PickUpProductFromShop\Api\Data\OfficeInterfaceFactory;
use Bforward\PickUpProductFromShop\Api\ShopListManagementInterface;

class ShopListManagement implements ShopListManagementInterface
{
    protected $officeFactory;
    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListFactory
     */
    private $shopList;

    /**
     * OfficeManagement constructor.
     * @param OfficeInterfaceFactory $officeInterfaceFactory
     */
    public function __construct(ShopListFactory $shopList)
    {
        $this->shopList = $shopList;
    }

    /**
     * Get offices for the given postcode and city
     *
     * @return \Bforward\PickUpProductFromShop\Api\Data\OfficeInterface[]
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