<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends BaseController {

    /**
     * @var CategoryContract
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categoryRepository
     */
    public function __construct(CategoryContract $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Categorias', 'Listado de todas las categorias');
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        //$categories = $this->categoryRepository->listCategories('id', 'asc');
        $categories = $this->categoryRepository->treeList();

        $this->setPageTitle('Categorias', 'Crear categoría');
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:191',
            'parent_id' => 'required|not_in:0',
            'image' => 'mimes:jpg,jpeg,png|max:1000|required'
                ]
                , [
            'name.required' => 'El campo nombre es requerido.',
            'name.max' => 'El número de caracteres no debe ser más que 191.',
            'parent_id.required' => 'Debe seleccionar un categoría.',
            'parent_id.not_in' => 'La categoría no puede ser 0.',
            'image.required' => 'La imagen es requerida.',
            'image.mimes' => 'La imagen solo permite archivos de tipo: jpg,jpeg,png.',
            'image.max' => 'La imagen no puede ser más grande a 1000 KB.',
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        //$categories = $this->categoryRepository->listCategories();
        $categories = $this->categoryRepository->treeList();

        $this->setPageTitle('Categorias', 'Editar Categoría : ' . $targetCategory->name);
        return view('admin.categories.edit', compact('categories', 'targetCategory'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:191',
            'parent_id' => 'required|not_in:0',
            'image' => 'mimes:jpg,jpeg,png|max:1000|required'
                ], [
            'name.required' => 'El campo nombre es requerido.',
            'name.max' => 'El número de caracteres no debe ser más que 191.',
            'parent_id.required' => 'Debe seleccionar un categoría.',
            'parent_id.not_in' => 'La categoría no puede ser 0.',
            'image.required' => 'La imagen es requerida.',
            'image.mimes' => 'La imagen solo permite archivos de tipo: jpg,jpeg,png.',
            'image.max' => 'La imagen no puede ser más grande a 1000 KB.',
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category actualizada con éxito', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Categoría borrada con éxito', 'success', false, false);
    }

}
