<?php

namespace Bforward\PickUpProductFromShop\Model;

use Magento\Framework\DataObject;
use Bforward\PickUpProductFromShop\Api\Data\OfficeInterface;
//TODO: implement correct shoplist instead of sample office
class Office extends DataObject implements OfficeInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return (string)$this->_getData('name');
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return (string)$this->_getData('location');
    }
}