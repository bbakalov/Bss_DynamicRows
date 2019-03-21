define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-service',
    'Bforward_PickUpProductFromShop/js/view/checkout/shipping/office-service',
    'mage/translate'
], function ($, ko, Component, quote, shippingService, officeService, t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Bforward_PickUpProductFromShop/checkout/shipping/form'
        },

        initialize: function (config) {
            this.offices = ko.observableArray();
            this.selectedOffice = ko.observable();
            this._super();
        },

        initObservable: function () {
            this._super();

            this.showOfficeSelection = ko.computed(function() {
                console.log(this.offices().length)
                return this.offices().length != 0
            }, this);

            this.selectedMethod = ko.computed(function() {
                var method = quote.shippingMethod();
                var selectedMethod = method != null ? method.carrier_code + '_' + method.method_code : null;
                return selectedMethod;
            }, this);

            quote.shippingMethod.subscribe(function(method) {
                var selectedMethod = method != null ? method.carrier_code + '_' + method.method_code : null;
                if (selectedMethod == 'shipfromshop_shipfromshop') {
                    this.reloadOffices();
                }
            }, this);

            this.selectedOffice.subscribe(function(office) {
                if (quote.shippingAddress().extensionAttributes == undefined) {
                    quote.shippingAddress().extensionAttributes = {};
                }
                quote.shippingAddress().extensionAttributes.shipfromshop = office;
            });


            return this;
        },

        setOfficeList: function(list) {
            this.offices(list);
        },

        reloadOffices: function() {
            officeService.getOfficeList(quote.shippingAddress(), this);
            var defaultOffice = this.offices()[0];
            if (defaultOffice) {
                this.selectedOffice(defaultOffice);
            }
        },

        getOffice: function() {
            var office;
            if (this.selectedOffice()) {
                for (var i in this.offices()) {
                    var m = this.offices()[i];
                    if (m.name == this.selectedOffice()) {
                        office = m;
                    }
                }
            }
            else {
                office = this.offices()[0];
            }

            return office;
        },

        initSelector: function() {
            var startOffice = this.getOffice();
        }
    });
});