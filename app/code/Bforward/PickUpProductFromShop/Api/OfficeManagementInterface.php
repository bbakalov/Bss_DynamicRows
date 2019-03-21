<?php

namespace Bforward\PickUpProductFromShop\Api;

interface OfficeManagementInterface
{

    /**
     * Find offices for the customer
     *
     * @param string $postcode
     * @param string $city
     * @return \Bforward\PickUpProductFromShop\Api\Data\OfficeInterface[]
     */
    public function fetchOffices($postcode, $city);
}