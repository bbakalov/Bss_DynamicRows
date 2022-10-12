<?php

declare(strict_types=1);

namespace Bss\DynamicRows\Model;

use Bss\DynamicRows\Model\ResourceModel\DynamicRows\Collection;
use Bss\DynamicRows\Model\ResourceModel\DynamicRows\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 *
 * @package Bss\DynamicRows\Model
 */
class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    protected $rowCollection;

    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param Collection        $collection
     * @param CollectionFactory $collectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection    = $collection;
        $this->rowCollection = $collectionFactory;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $collection = $this->rowCollection->create()->setOrder('position', 'ASC');
        foreach ($collection->getItems() as $item) {
            $this->loadedData['stores']['dynamic_rows_container'][] = $item->getData();
        }

        return $this->loadedData;
    }
}
