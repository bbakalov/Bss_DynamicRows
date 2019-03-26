<?php

namespace Bss\DynamicRows\Model;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;
    protected $rowCollection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Bss\DynamicRows\Model\ResourceModel\DynamicRows\Collection $collection,
        \Bss\DynamicRows\Model\ResourceModel\DynamicRows\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection    = $collection;
        $this->rowCollection = $collectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $collection = $this->rowCollection->create()->setOrder('position', 'ASC');
        $items      = $collection->getItems();
        foreach ($items as $item) {
            $this->loadedData['stores']['dynamic_rows_container'][] = $item->getData();
        }

        return $this->loadedData;
    }
}