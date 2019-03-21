<?php

namespace Bforward\PickUpProductFromShop\Model;

use Bforward\PickUpProductFromShop\Api\OfficeManagementInterface;
use Bforward\PickUpProductFromShop\Api\Data\OfficeInterfaceFactory;

class OfficeManagement implements OfficeManagementInterface
{
    protected $officeFactory;

    /**
     * OfficeManagement constructor.
     * @param OfficeInterfaceFactory $officeInterfaceFactory
     */
    public function __construct(OfficeInterfaceFactory $officeInterfaceFactory)
    {
        $this->officeFactory = $officeInterfaceFactory;
    }

    /**
     * Get offices for the given postcode and city
     *
     * @param string $postcode
     * @param string $city
     *
     * @return \Bforward\PickUpProductFromShop\Api\Data\OfficeInterface[]
     */
    public function fetchOffices($postcode, $city)
    {
        //TODO: prepare available shops based on products availibility
        $result = [];
        for($i = 0; $i < 4;$i++) {
            $office = $this->officeFactory->create();
            $office->setName("Office {$i}");
            $office->setLocation("Address {$i}");
            $result[] = $office;
        }

        return $result;
    }
}