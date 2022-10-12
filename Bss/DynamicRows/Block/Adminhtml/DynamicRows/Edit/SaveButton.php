<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Block\Adminhtml\DynamicRows\Edit;

use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 *
 * @package Bss\DynamicRows\Block\Adminhtml\DynamicRows\Edit
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $url = $this->getUrl('bss/row/save');

        return [
            'label'      => __('Save Rows'),
            'class'      => 'save primary',
            'on_click'   => "setLocation('" . $url . "')",
            'sort_order' => 90,
        ];
    }
}
