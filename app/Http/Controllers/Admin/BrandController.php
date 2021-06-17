<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;

class BrandController extends BaseController {

    /**
     * @var BrandContract
     */
    protected $brandRepository;

    /**
     * CategoryController constructor.
     * @param BrandContract $brandRepository
     */
    public function __construct(BrandContract $brandRepository) {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $brands = $this->brandRepository->listBrands();

        $this->setPageTitle('Marcas', 'Lista de todas las marcas');
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $this->setPageTitle('Marca', 'Crear Marca');
        return view('admin.brands.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:191',
            'logo' => 'mimes:jpg,jpeg,png|max:1000|required'
                ], [
            'name.required' => 'El campo nombre es requerido.',
            'logo.required' => 'La imagen es requerida.',
            'logo.mimes' => 'La imagen solo puede ser: jpg,jpeg,png.',
            'logo.max' => 'El peso de la imagen debe ser menor a 1000 kb.',
        ]);

        $params = $request->except('_token');

        $brand = $this->brandRepository->createBrand($params);

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while creating brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Marca agregada con éxito', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $brand = $this->brandRepository->findBrandById($id);

        $this->setPageTitle('Marcas', 'Ediitar Marca : ' . $brand->name);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:191',
            'logo' => 'mimes:jpg,jpeg,png|max:1000|required'
                ], [
            'name.required' => 'El campo nombre es requerido.',
            'logo.required' => 'La imagen es requerida.',
            'logo.mimes' => 'La imagen solo puede ser: jpg,jpeg,png.',
            'logo.max' => 'El peso de la imagen debe ser menor a 1000 kb.',
        ]);

        $params = $request->except('_token');

        $brand = $this->brandRepository->updateBrand($params);

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while updating brand.', 'error', true, true);
        }
        return $this->responseRedirectBack('Marca actualizada con éxito', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $brand = $this->brandRepository->deleteBrand($id);

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while deleting brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Marca borrada con éxito', 'success', false, false);
    }

}
