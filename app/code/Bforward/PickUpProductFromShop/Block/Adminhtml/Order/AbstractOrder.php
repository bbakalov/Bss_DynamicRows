<?php

namespace Bforward\PickUpProductFromShop\Block\Adminhtml\Order;

/**
 * Adminhtml order abstract block
 */
class AbstractOrder extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder
{

    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListRepository
     */
    private $shopList;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Sales\Helper\Admin             $adminHelper
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        array $data = [],
        \Bforward\PickUpProductFromShop\Model\ShopListRepository $shopList
    ) {
        parent::__construct($context, $registry, $adminHelper, $data);
        $this->shopList = $shopList;
    }

    /**
     * Get pickup shop
     *
     * @return \Bforward\PickUpProductFromShop\Model\ShopList | string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPickupShop()
    {
        $pickupShop = '';
        $pickupShopId   = $this->getOrder()->getPickupShopId();
        if ($pickupShopId) {
            $pickupShop = $this->shopList->getById((int) $pickupShopId);
        }

        return $pickupShop;
    }
}
