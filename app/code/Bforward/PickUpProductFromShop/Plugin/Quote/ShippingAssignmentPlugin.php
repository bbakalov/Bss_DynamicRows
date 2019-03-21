<?php

namespace Bforward\PickUpProductFromShop\Plugin\Quote;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\ShippingInterface;
use Bforward\PickUpProductFromShop\Model\Carrier\Shipping;

/**
 * ShippingAssignmentPlugin
 */
class ShippingAssignmentPlugin
{
    /**
     * @param                                           $subject
     * @param \Magento\Quote\Api\Data\ShippingInterface $value
     *
     * @return array
     */
    public function beforeSetShipping($subject, ShippingInterface $value)
    {
        $method = $value->getMethod();
        /** @var AddressInterface $address */
        $address = $value->getAddress();
        if ($method === Shipping::CARRIER_CODE . '_' . Shipping::METHOD_CODE
            && $address->getExtensionAttributes()
            && $address->getExtensionAttributes()->getShipfromshop()
        ) {
            $address->setCarrierOffice($address->getExtensionAttributes()->getShipfromshop());
        } elseif ($method !== Shipping::CARRIER_CODE . '_' . Shipping::METHOD_CODE) {
            //reset inpost machine when changing shipping method
            $address->setCarrierOffice(null);
        }

        return [$value];
    }
}