/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            changePersonType: 'LeonardoBrasileiro_BrazilCustomerAttributes/change-person-type',
            inputMask: 'LeonardoBrasileiro_BrazilCustomerAttributes/jquery.mask'
        },
    },
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'LeonardoBrasileiro_BrazilCustomerAttributes/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/create-shipping-address': {
                'LeonardoBrasileiro_BrazilCustomerAttributes/js/action/create-shipping-address-mixin': true
            },
            'Magento_Checkout/js/action/create-billing-address': {
                'LeonardoBrasileiro_BrazilCustomerAttributes/js/action/create-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'LeonardoBrasileiro_BrazilCustomerAttributes/js/action/place-order-mixin': true
            }
        }
    }
};
