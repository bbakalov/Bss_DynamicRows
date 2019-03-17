<?php

namespace Bforward\PickUpProductFromShop\Model\ResourceModel;

class ShopList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('shop_list', 'id');
    }
}
