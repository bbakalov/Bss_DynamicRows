<?php

namespace Bss\DynamicRows\Controller\Adminhtml\Row;

class Save extends \Magento\Backend\App\Action
{

    protected $dynamicRow;
    protected $dynamicRowResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Bss\DynamicRows\Model\DynamicRowsFactory $dynamicRowFactory,
        \Bss\DynamicRows\Model\ResourceModel\DynamicRowsFactory $dynamicRowResource
    ) {
        parent::__construct($context);
        $this->dynamicRow         = $dynamicRowFactory;
        $this->dynamicRowResource = $dynamicRowResource;
    }

    public function execute()
    {
        try {
            $dynamicRowResource = $this->dynamicRowResource->create();
            $dynamicRowData     = $this->getRequest()->getParam('dynamic_rows_container');
            $dynamicRowResource->deleteDynamicRows();
            if (is_array($dynamicRowData) && !empty($dynamicRowData)) {
                foreach ($dynamicRowData as $dynamicRowDatum) {
                    $model = $this->dynamicRow->create();
                    unset($dynamicRowDatum['row_id']);
                    $model->addData($dynamicRowDatum);
                    $model->save();
                }
            }
            $this->messageManager->addSuccessMessage(__('Rows have been saved successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('*/*/index/scope/stores');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_DynamicRows::dynamic_rows');
    }
}