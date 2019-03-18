<?php

namespace Bforward\PickUpProductFromShop\Ui\Component\Listing\ShopList\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends Column
{

    /** Url edit path */
    const ROW_EDIT_URL = 'bforward_pickupproductfromshop/shoplist/addshop';

    /** Url delete path */
    const ROW_DELETE_URL = 'bforward_pickupproductfromshop/shoplist/delete';

    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit']   = [
                        'href'  => $this->_urlBuilder->getUrl(
                            self::ROW_EDIT_URL,
                            ['id' => $item['id']]
                        ),
                        'label' => __('Edit'),
                    ];
                    $item[$name]['delete'] = [
                        'href'  => $this->_urlBuilder->getUrl(
                            self::ROW_DELETE_URL,
                            ['id' => $item['id']]
                        ),
                        'label' => __('Delete'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}
