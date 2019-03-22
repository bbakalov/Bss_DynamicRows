<?php

namespace Bforward\PickUpProductFromShop\Observer\Model;

class Order implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getEvent()->getOrder()->setPickupShopId($observer->getEvent()->getQuote()->getShippingAddress()->getPickupShopId());

        return $this;
    }
}