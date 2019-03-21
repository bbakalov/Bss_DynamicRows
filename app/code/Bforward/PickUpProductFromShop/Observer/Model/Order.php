<?php

namespace Bforward\PickUpProductFromShop\Observer\Model;

class Order implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        //TODO: implement logic about choosen shipment method and saving store for picking up
        $observer->getEvent()->getOrder()->setPickupShopId(77);
        return $this;
    }
}