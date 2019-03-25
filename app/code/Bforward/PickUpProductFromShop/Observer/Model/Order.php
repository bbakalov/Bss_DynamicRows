<?php

namespace Bforward\PickUpProductFromShop\Observer\Model;

use Magento\Framework\Event\Observer;

class Order implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Save pickup_shop_id to order from order quote
     *
     * - event: layout_generate_blocks_after
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $observer->getEvent()->getOrder()->setPickupShopId($observer->getEvent()->getQuote()->getShippingAddress()->getPickupShopId());
    }
}