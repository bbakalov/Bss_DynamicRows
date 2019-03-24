<?php

namespace Bforward\PickUpProductFromShop\Block\Order;

use \Magento\Framework\View\Element\Template\Context as TemplateContext;
use \Magento\Framework\Registry;
use \Magento\Payment\Helper\Data as PaymentHelper;
use \Magento\Sales\Model\Order\Address\Renderer as AddressRenderer;

class Info extends \Magento\Sales\Block\Order\Info
{

    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListRepository
     */
    private $shopList;

    /**
     * @param TemplateContext                                          $context
     * @param Registry                                                 $registry
     * @param PaymentHelper                                            $paymentHelper
     * @param AddressRenderer                                          $addressRenderer
     * @param array                                                    $data
     * @param \Bforward\PickUpProductFromShop\Model\ShopListRepository $shopList
     */
    public function __construct(
        TemplateContext $context,
        Registry $registry,
        PaymentHelper $paymentHelper,
        AddressRenderer $addressRenderer,
        array $data = [],
        \Bforward\PickUpProductFromShop\Model\ShopListRepository $shopList
    ) {
        parent::__construct($context, $registry, $paymentHelper, $addressRenderer, $data);
        $this->shopList = $shopList;
    }

    /**
     * Get pickup shop
     *
     * @return \Bforward\PickUpProductFromShop\Model\ShopList|string
     */
    public function getPickupShop()
    {
        $pickupShop   = '';
        $pickupShopId = $this->getOrder()->getPickupShopId();
        if ($pickupShopId) {
            $pickupShop = $this->shopList->getById((int)$pickupShopId);
        }

        return $pickupShop;
    }
}
