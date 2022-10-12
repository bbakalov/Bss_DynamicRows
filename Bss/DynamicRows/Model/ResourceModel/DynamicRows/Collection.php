<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Model\ResourceModel\DynamicRows;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package Bss\DynamicRows\Model\ResourceModel\DynamicRows
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'row_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Bss\DynamicRows\Model\DynamicRows::class,
            \Bss\DynamicRows\Model\ResourceModel\DynamicRows::class
        );
    }
}
