<?php

namespace Bforward\PickUpProductFromShop\Api;

use Bforward\PickUpProductFromShop\Model\ShopList;

/**
 * Interface SampleInterface
 * @package Academy\Database\Api\Data
 */
interface ShopListRepositoryInterface
{
    /**
     * @param ShopList $sample
     * @return mixed
     */
    public function save(ShopList $sample);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @return ShopList[]
     */
    public function getList(): array;
}