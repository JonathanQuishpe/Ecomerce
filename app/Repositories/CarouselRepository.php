<?php

namespace App\Repositories;

use App\Models\Carousel;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CarouselContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class CarouselRepository extends BaseRepository implements CarouselContract {

    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Brand $model
     */
    public function __construct(Carousel $model) {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCarousels(string $order = 'id', string $sort = 'desc', array $columns = ['*']) {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCarouselById(int $id) {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Brand|mixed
     */
    public function createCarousel(array $params) {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'carousels');
            }

            $merge = $collection->merge(compact('logo'));

            $carousel = new Carousel($merge->all());

            $carousel->save();

            return $carousel;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCarousel(array $params) {
        $carousel = $this->findCarouselById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {

            if ($carousel->logo != null) {
                $this->deleteOne($carousel->logo);
            }

            $logo = $this->uploadOne($params['logo'], 'carousels');
        }
        $status = $collection->has('status') ? 1 : 0;
        $merge = $collection->merge(compact('logo', 'status'));

        $carousel->update($merge->all());

        return $carousel;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCarousel($id) {
        $carousel = $this->findCarouselById($id);

        if ($carousel->logo != null) {
            $this->deleteOne($carousel->logo);
        }

        $carousel->delete();

        return $carousel;
    }

}
