define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-service',
    'Bforward_PickUpProductFromShop/js/view/checkout/shipping/pickupshop-service',
    'mage/translate'
], function ($, ko, Component, quote, shippingService, pickupshopService, t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Bforward_PickUpProductFromShop/checkout/shipping/form'
        },

        initialize: function (config) {
            this.shops = ko.observableArray();
            this.selectedShop = ko.observable();
            this._super();
        },

        initObservable: function () {
            this._super();

            this.showShopListSelection = ko.computed(function() {
                return this.shops().length != 0
            }, this);

            this.selectedMethod = ko.computed(function() {
                var method = quote.shippingMethod();
                var selectedMethod = method != null ? method.carrier_code + '_' + method.method_code : null;
                return selectedMethod;
            }, this);

            quote.shippingMethod.subscribe(function(method) {
                var selectedMethod = method != null ? method.carrier_code + '_' + method.method_code : null;
                if (selectedMethod == 'shipfromshop_shipfromshop') {
                    this.reloadShops();
                }
            }, this);

            this.selectedShop.subscribe(function(shop) {
                if (quote.shippingAddress().extensionAttributes == undefined) {
                    quote.shippingAddress().extensionAttributes = {};
                }
                quote.shippingAddress().extensionAttributes.shipfromshop = shop;
            });


            return this;
        },

        setShopList: function(list) {
            this.shops(list);
        },

        reloadShops: function() {
            pickupshopService.getShopList(quote.shippingAddress(), this);
            var defaultShop = this.shops()[0];
            if (defaultShop) {
                this.selectedShop(defaultShop);
            }
        },

        getShop: function () {
            var shop;
            if (this.selectedShop()) {
                for (var i in this.shops()) {
                    var shopOption = this.shops()[i];
                    if (shopOption.id == this.selectedShop()) {
                        shop = shopOption;
                    }
                }
            }
            else {
                shop = this.shops()[0];
            }

            return shop;
        },

        initSelector: function() {
            var startShop = this.getShop();
        }
    });
});