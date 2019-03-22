<?php

namespace Bforward\PickUpProductFromShop\Api;

interface ShopListManagementInterface
{

    /**
     * Find shops for picking up
     *
     * @return \Bforward\PickUpProductFromShop\Api\Data\ShopListInterface[]
     */
    public function fetchShops();
}