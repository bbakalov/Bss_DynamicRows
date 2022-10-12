<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class DynamicRows
 *
 * @package Bss\DynamicRows\Model
 */
class DynamicRows extends AbstractModel
{
    const CACHE_TAG = 'bss_dynamic_rows';

    protected $_cacheTag = 'bss_dynamic_rows';

    protected $_eventPrefix = 'bss_dynamic_rows';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(\Bss\DynamicRows\Model\ResourceModel\DynamicRows::class);
    }
}
