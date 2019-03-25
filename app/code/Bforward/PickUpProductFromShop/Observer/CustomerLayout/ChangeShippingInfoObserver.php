<?php

namespace Bforward\PickUpProductFromShop\Observer\CustomerLayout;

use Bforward\PickUpProductFromShop\Model\Carrier\Shipping;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * Change order info template for temando orders in customer account.
 *
 * @package Temando\Shipping\Observer
 * @author  Sebastian Ertner <sebastian.ertner@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.temando.com/
 */
class ChangeShippingInfoObserver implements ObserverInterface
{

    /**
     * - event: layout_generate_blocks_after
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($observer->getData('full_action_name') !== 'sales_order_view') {
            return;
        }

        /** @var \Magento\Framework\View\Layout $layout */
        $layout    = $observer->getData('layout');
        $infoBlock = $layout->getBlock('sales.order.info');
        if (!$infoBlock instanceof \Magento\Sales\Block\Order\Info) {
            return;
        }

        $order = $infoBlock->getOrder();
        if (!$order instanceof OrderInterface || !$order->getData('shipping_method')) {
            // wrong type, virtual or corrupt order
            return;
        }

        if ($order->getShippingMethod(true)->getData('carrier_code') !== Shipping::CARRIER_CODE) {
            return;
        }

        $infoBlock->setTemplate('Bforward_PickUpProductFromShop::order/info.phtml');
    }
}
