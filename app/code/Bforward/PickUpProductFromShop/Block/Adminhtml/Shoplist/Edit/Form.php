<?php

namespace Bforward\PickUpProductFromShop\Block\Adminhtml\Shoplist\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * @var \Magento\Store\Model\System\Store
     */
    private $systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->systemStore = $systemStore;
    }

    /**
     * Prepare form.
     *
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form  = $this->_formFactory->create(
            [
                'data' => [
                    'id'      => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action'  => $this->getData('action'),
                    'method'  => 'post',
                ],
            ]
        );

        $form->setHtmlIdPrefix('PickUpProductFromShopshoplist_');
        if ($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit shop'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add shop'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name'     => 'name',
                'label'    => __('name'),
                'id'       => 'name',
                'title'    => __('name'),
                'class'    => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'address',
            'text',
            [
                'name'  => 'address',
                'label' => __('Address'),
                'id'    => 'address',
                'title' => __('Address'),
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name'  => 'email',
                'label' => __('Email'),
                'id'    => 'email',
                'title' => __('Email'),
            ]
        );

        $fieldset->addField(
            'phone_number',
            'text',
            [
                'name'  => 'phone_number',
                'label' => __('Phone number'),
                'id'    => 'phone_number',
                'title' => __('Phone number'),
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name'     => 'is_active',
                'label'    => __('Status'),
                'id'       => 'is_active',
                'title'    => __('Status'),
                'values'   => [0 => __('Inactive'), 1 => __('Active')],
                'class'    => 'status',
                'required' => true,
            ]
        );

        $field    = $fieldset->addField(
            'store_id',
            'select',
            [
                'name'     => 'store_id',
                'label'    => __('Website'),
                'title'    => __('Website'),
                'required' => true,
                'values'   => $this->systemStore->getWebsiteValuesForForm(),
            ]
        );
        $renderer = $this->getLayout()->createBlock(
            \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element::class
        );
        $field->setRenderer($renderer);


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
