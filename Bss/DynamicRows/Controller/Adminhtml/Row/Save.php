<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Controller\Adminhtml\Row;

use Bss\DynamicRows\Model\DynamicRowsFactory as DynamicRowsModelFactory;
use Bss\DynamicRows\Model\ResourceModel\DynamicRowsFactory as DynamicRowsResourceModelFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

/**
 * Class Save
 *
 * @package Bss\DynamicRows\Controller\Adminhtml\Row
 */
class Save extends Action
{
    protected $dynamicRowsModelFactory;

    protected $dynamicRowsResourceModelFactory;

    /**
     * @param Context                         $context
     * @param DynamicRowsModelFactory         $dynamicRowsModelFactory
     * @param DynamicRowsResourceModelFactory $dynamicRowsResourceModelFactory
     */
    public function __construct(
        Context $context,
        DynamicRowsModelFactory $dynamicRowsModelFactory,
        DynamicRowsResourceModelFactory $dynamicRowsResourceModelFactory
    ) {
        parent::__construct($context);
        $this->dynamicRowsModelFactory         = $dynamicRowsModelFactory;
        $this->dynamicRowsResourceModelFactory = $dynamicRowsResourceModelFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        try {
            $dynamicRowResourceModel = $this->dynamicRowsResourceModelFactory->create();
            $dynamicRowData          = $this->getRequest()->getParam('dynamic_rows_container');
            $dynamicRowResourceModel->deleteDynamicRows();

            if (\is_array($dynamicRowData) && !empty($dynamicRowData)) {
                foreach ($dynamicRowData as $dynamicRowDatum) {
                    $dynamicRowsModel = $this->dynamicRowsModelFactory->create();
                    unset($dynamicRowDatum['row_id']);
                    $dynamicRowsModel->addData($dynamicRowDatum);
                    $dynamicRowsModel->save();
                }
            }

            $this->messageManager->addSuccessMessage(__('Rows have been saved successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        $this->_redirect('*/*/index/scope/stores');
    }

    /**
     * @inheritDoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_DynamicRows::dynamic_rows');
    }
}
