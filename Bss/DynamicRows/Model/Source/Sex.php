<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Sex
 *
 * @package Bss\DynamicRows\Model\Source
 */
class Sex implements OptionSourceInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => 'Male'],
            ['value' => 1, 'label' => 'Female'],
        ];
    }
}
