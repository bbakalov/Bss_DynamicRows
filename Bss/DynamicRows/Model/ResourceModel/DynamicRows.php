<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class DynamicRows
 *
 * @package Bss\DynamicRows\Model\ResourceModel
 */
class DynamicRows extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('bss_dynamic_rows', 'row_id');
    }

    /**
     * @return void
     * @throws LocalizedException
     */
    public function deleteDynamicRows()
    {
        $connection = $this->getConnection();
        $connection->delete($this->getMainTable(), ['row_id > ?' => 0]);
    }
}
