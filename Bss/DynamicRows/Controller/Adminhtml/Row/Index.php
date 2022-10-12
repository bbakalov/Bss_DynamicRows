<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Controller\Adminhtml\Row;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 *
 * @package Bss\DynamicRows\Controller\Adminhtml\Row
 */
class Index extends \Magento\ImportExport\Controller\Adminhtml\Export\Index
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Bss_DynamicRows::dynamic_rows');
        $resultPage->getConfig()->getTitle()->prepend(__('Dynamic Rows'));
        $resultPage->getConfig()->getTitle()->prepend(__('Dynamic Rows'));
        $resultPage->addBreadcrumb(__('Dynamic Rows'), __('Dynamic Rows'));

        return $resultPage;
    }

    /**
     * @inheritDoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_DynamicRows::dynamic_rows');
    }
}
