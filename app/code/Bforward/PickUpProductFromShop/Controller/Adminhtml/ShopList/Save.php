<?php

namespace Bforward\PickUpProductFromShop\Controller\Adminhtml\ShopList;

use Magento\Backend\App\Action;

class Save extends Action
{

    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListFactory
     */
    private $shopListFactory;

    /**
     * @param \Magento\Backend\App\Action\Context                   $context
     * @param \Bforward\PickUpProductFromShop\Model\ShopListFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Bforward\PickUpProductFromShop\Model\ShopListFactory $shopListFactory
    ) {
        parent::__construct($context);
        $this->shopListFactory = $shopListFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/addshop');

            return;
        }
        try {
            $this->shopListFactory->create()->setData($data)->save();
            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bforward_PickUpProductFromShop::shoplist_save');
    }
}
