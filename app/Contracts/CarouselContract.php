<?php

namespace App\Contracts;

/**
 * Interface BrandContract
 * @package App\Contracts
 */
interface CarouselContract {

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCarousels(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCarouselById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCarousel(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCarousel(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCarousel($id);
}
