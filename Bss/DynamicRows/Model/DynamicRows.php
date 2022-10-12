<?php

namespace Bss\DynamicRows\Model;



use Magento\Framework\Model\AbstractModel;



class DynamicRows extends AbstractModel

{

    const CACHE_TAG = 'bss_dynamic_rows';



    protected $_cacheTag = 'bss_dynamic_rows';



    protected $_eventPrefix = 'bss_dynamic_rows';



    protected function _construct()

    {

        $this->_init(\Bss\DynamicRows\Model\ResourceModel\DynamicRows::class);

    }



}