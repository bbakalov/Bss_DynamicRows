<?php

namespace Bforward\PickUpProductFromShop\Model\Source;


class PickupShopList implements \Magento\Framework\Option\ArrayInterface

{
    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListRepository
     */
    private $pickupShopRepository;

    public function __construct(
        \Bforward\PickUpProductFromShop\Model\ShopListRepository $pickupShopRepository
    ) {
        $this->pickupShopRepository = $pickupShopRepository;
    }

    public function toOptionArray()

    {
        $shops = [];
        foreach ($this->pickupShopRepository->getList() as $shopId => $shop) {
            $shops[] = [
                'label' => $shop->getName(),
                'value' => $shopId,
            ];
        }
        return $shops;
    }
}
