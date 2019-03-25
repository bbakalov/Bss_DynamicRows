<?php

namespace Bforward\PickUpProductFromShop\Observer\Product;

use Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class CatalogProductSaveAfterObserver implements ObserverInterface
{
    /**
     * @var \Bforward\PickUpProductFromShop\Model\ProductShopStockFactory
     */
    private $productShopStock;

    public function __construct(
        \Bforward\PickUpProductFromShop\Model\ProductShopStockFactory $productShopStock
    ) {
        $this->productShopStock   = $productShopStock;
    }

    /**
     * Save chosen pickup shops and product qty there
     *
     * - event: catalog_product_save_after
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getProduct();
        if (!$product) {
            return;
        }

        $productId      = $observer->getProduct()->getId();
        $pickupShopData = $product->getData('pickupshop_product_qty');

        try {
            if (\is_array($pickupShopData) && !empty($pickupShopData)) {
                foreach ($pickupShopData as $shopData) {
                    unset($shopData['record_id']);
                    $shopData['product_id'] = $productId;
                    //TODO: save value to existing entity, instead of creating new
                    $productShopStock       = $this->productShopStock->create();
                    $productShopStock->setData($shopData);
                    $productShopStock->save();
                }
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
        }
    }
}
