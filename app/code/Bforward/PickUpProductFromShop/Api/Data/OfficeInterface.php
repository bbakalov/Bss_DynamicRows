<?php

namespace Bforward\PickUpProductFromShop\Api\Data;

/**
 * Office Interface
 */
interface OfficeInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getLocation();
}