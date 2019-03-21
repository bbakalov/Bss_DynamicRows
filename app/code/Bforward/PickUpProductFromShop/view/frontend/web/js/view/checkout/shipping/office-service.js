define(
    [
        'Bforward_PickUpProductFromShop/js/view/checkout/shipping/model/resource-url-manager',
        'Magento_Checkout/js/model/quote',
        'Magento_Customer/js/model/customer',
        'mage/storage',
        'Magento_Checkout/js/model/shipping-service',
        'Bforward_PickUpProductFromShop/js/view/checkout/shipping/model/office-registry',
        'Magento_Checkout/js/model/error-processor'
    ],
    function (resourceUrlManager, quote, customer, storage, shippingService, officeRegistry, errorProcessor) {
        'use strict';

        return {
            /**
             * Get nearest machine list for specified address
             * @param {Object} address
             */
            getOfficeList: function (address, form) {
                shippingService.isLoading(true);
                var cacheKey = address.getCacheKey(),
                    cache = officeRegistry.get(cacheKey),
                    serviceUrl = resourceUrlManager.getUrlForOfficeList(quote);

                if (cache) {
                    form.setOfficeList(cache);
                    shippingService.isLoading(false);
                } else {
                    storage.get(
                        serviceUrl, false
                    ).done(
                        function (result) {
                            officeRegistry.set(cacheKey, result);
                            form.setOfficeList(result);
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