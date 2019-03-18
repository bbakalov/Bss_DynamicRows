<?php

namespace Bforward\PickUpProductFromShop\Controller\Adminhtml\ShopList;

use Magento\Backend\App\Action;

class Delete extends Action
{

    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListRepository
     */
    private $shopListRepository;

    /**
     * Delete constructor.
     *
     * @param \Magento\Backend\App\Action\Context                      $context
     * @param \Bforward\PickUpProductFromShop\Model\ShopListRepository $shopListRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Bforward\PickUpProductFromShop\Model\ShopListRepository $shopListRepository
    ) {
        parent::__construct($context);
        $this->shopListRepository = $shopListRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id === null) {
            $this->_redirect('*/*/index');

            return;
        }
        try {
            $shop = $this->shopListRepository->getById($id);
            $shop->delete();
            $this->messageManager->addSuccessMessage(__('Row data has been successfully deleted.'));
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
