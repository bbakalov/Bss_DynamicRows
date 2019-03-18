<?php

namespace Bforward\PickUpProductFromShop\Model;


use Bforward\PickUpProductFromShop\Api\ShopListRepositoryInterface;

class ShopListRepository implements ShopListRepositoryInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    protected $news;

    protected $objectManager;
    /**
     * @var \Bforward\PickUpProductFromShop\Model\ShopListFactory
     */
    private $shopList;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Bforward\PickUpProductFromShop\Model\ShopListFactory $shopList
    ) {
        $this->objectManager = $objectManager;
        $this->shopList = $shopList;
    }


    /**
     * @param \Bforward\PickUpProductFromShop\Model\ShopList $shop
     * @return $this|mixed
     * @throws \Exception
     */
    public function save(\Bforward\PickUpProductFromShop\Model\ShopList $shop)
    {
        return $shop->save();
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $list = [];
        foreach ($this->shopList->create()->getCollection() as $shop) {
            $list [$shop->getId()] = $shop;
        }
        return $list;
    }

    /**
     * @param int $id
     * @return \Bforward\PickUpProductFromShop\Model\ShopList
     */
    public function getById(int $id)
    {
        return $this->shopList->create()->load($id);
    }
}
