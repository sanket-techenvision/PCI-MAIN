<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateService_CategoryRequest;
use App\Http\Requests\UpdateService_CategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Service_CategoryRepository;
use Illuminate\Http\Request;
use Flash;
use app\Models\Service_Category;

class Service_CategoryController extends AppBaseController
{
    /** @var Service_CategoryRepository $serviceCategoryRepository*/
    private $serviceCategoryRepository;

    public function __construct(Service_CategoryRepository $serviceCategoryRepo)
    {
        $this->serviceCategoryRepository = $serviceCategoryRepo;
    }

    /**
     * Display a listing of the Service_Category.
     */
    public function index(Request $request)
    {
        $serviceCategories = Service_Category::all();

        return view('service__categories.index')
            ->with('serviceCategories', $serviceCategories);
    }

    /**
     * Show the form for creating a new Service_Category.
     */
    public function create()
    {
        return view('service__categories.create');
    }

    /**
     * Store a newly created Service_Category in storage.
     */
    public function store(CreateService_CategoryRequest $request)
    {
        $input = $request->all();

        $serviceCategory = $this->serviceCategoryRepository->create($input);

        Flash::success('Service  Category saved successfully.');

        return redirect(route('serviceCategories.index'));
    }

    /**
     * Display the specified Service_Category.
     */
    public function show($id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }

        return view('service__categories.show')->with('serviceCategory', $serviceCategory);
    }

    /**
     * Show the form for editing the specified Service_Category.
     */
    public function edit($id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }

        return view('service__categories.edit')->with('serviceCategory', $serviceCategory);
    }

    /**
     * Update the specified Service_Category in storage.
     */
    public function update($id, UpdateService_CategoryRequest $request)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }

        $serviceCategory = $this->serviceCategoryRepository->update($request->all(), $id);

        Flash::success('Service  Category updated successfully.');

        return redirect(route('serviceCategories.index'));
    }

    /**
     * Remove the specified Service_Category from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($id);

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }

        $this->serviceCategoryRepository->delete($id);

        Flash::success('Service  Category deleted successfully.');

        return redirect(route('serviceCategories.index'));
    }
}
