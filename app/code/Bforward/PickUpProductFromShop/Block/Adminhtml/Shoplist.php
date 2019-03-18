<?php
namespace Bforward\PickUpProductFromShop\Block\Adminhtml;

class Shoplist extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_shoplist';
        $this->_blockGroup = 'Bforward_PickUpProductFromShop';
        $this->_headerText = __('Posts');
        $this->_addButtonLabel = __('Create New Post');
        parent::_construct();
    }
}