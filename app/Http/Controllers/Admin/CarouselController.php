<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\CarouselContract;
use App\Http\Controllers\BaseController;

class CarouselController extends BaseController {

    /**
     * @var CarouselContract
     */
    protected $carouselRepository;

    /**
     * CategoryController constructor.
     * @param BrandContract $brandRepository
     */
    public function __construct(CarouselContract $carouselRepository) {
        $this->carouselRepository = $carouselRepository;
    }

    public function index() {
        $carousels = $this->carouselRepository->listCarousels();

        $this->setPageTitle('Carusel', 'Lista de todas las imgagenes');
        return view('admin.carousels.index', compact('carousels'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $this->setPageTitle('Carusel', 'Crear slider');
        return view('admin.carousels.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:191',
            'logo' => 'mimes:jpg,jpeg,png|max:3000|required'
                ], [
            'name.required' => 'El campo nombre es requerido.',
            'logo.required' => 'La imagen es requerida.',
            'logo.mimes' => 'La imagen solo puede ser: jpg,jpeg,png.',
            'logo.max' => 'El peso de la imagen debe ser menor a 3000 kb.',
        ]);

        $params = $request->except('_token');

        $carousel = $this->carouselRepository->createCarousel($params);

        if (!$carousel) {
            return $this->responseRedirectBack('Error occurred while creating brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.carousels.index', 'Imagen agregada con éxito', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $carousel = $this->carouselRepository->findCarouselById($id);

        $this->setPageTitle('Carousel', 'Editar Slider : ' . $carousel->name);
        return view('admin.carousels.edit', compact('carousel'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:191',
            'logo' => 'mimes:jpg,jpeg,png|max:3000|required'
                ], [
            'name.required' => 'El campo nombre es requerido.',
            'logo.required' => 'La imagen es requerida.',
            'logo.mimes' => 'La imagen solo puede ser: jpg,jpeg,png.',
            'logo.max' => 'El peso de la imagen debe ser menor a 3000 kb.',
        ]);

        $params = $request->except('_token');

        $carousel = $this->carouselRepository->updateCarousel($params);

        if (!$carousel) {
            return $this->responseRedirectBack('Error occurred while updating brand.', 'error', true, true);
        }
        return $this->responseRedirectBack('Imagen actualizada con éxito', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $carousel = $this->carouselRepository->deleteCarousel($id);

        if (!$carousel) {
            return $this->responseRedirectBack('Error occurred while deleting brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.carousels.index', 'Imagen eliminada con éxito', 'success', false, false);
    }

}
