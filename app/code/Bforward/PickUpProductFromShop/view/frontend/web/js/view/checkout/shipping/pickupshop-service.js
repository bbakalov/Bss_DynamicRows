define(
    [
        'Bforward_PickUpProductFromShop/js/view/checkout/shipping/model/resource-url-manager',
        'Magento_Checkout/js/model/quote',
        'Magento_Customer/js/model/customer',
        'mage/storage',
        'Magento_Checkout/js/model/shipping-service',
        'Bforward_PickUpProductFromShop/js/view/checkout/shipping/model/shop-registry',
        'Magento_Checkout/js/model/error-processor'
    ],
    function (resourceUrlManager, quote, customer, storage, shippingService, shopRegistry, errorProcessor) {
        'use strict';

        return {
            /**
             * Get nearest machine list for specified address
             * @param {Object} address
             */
            getShopList: function (address, form) {
                shippingService.isLoading(true);
                var cacheKey = address.getCacheKey(),
                    cache = shopRegistry.get(cacheKey),
                    serviceUrl = resourceUrlManager.getUrlForShopList(quote);

                if (cache) {
                    form.setShopList(cache);
                    shippingService.isLoading(false);
                } else {
                    storage.get(
                        serviceUrl, false
                    ).done(
                        function (result) {
                            shopRegistry.set(cacheKey, result);
                            form.setShopList(result);
                        }
                    ).fail(
                        function (response) {
                            errorProcessor.process(response);
                        }
                    ).always(
                        function () {
                            shippingService.isLoading(false);
                        }
                    );
                }
            }
        };
    }
);