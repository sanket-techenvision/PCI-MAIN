<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateService_CategoryRequest;
use App\Http\Requests\UpdateService_CategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Service_CategoryRepository;
use Illuminate\Http\Request;
use Flash;
use app\Models\Service_Category;
use App\Models\User;

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
        // dd($request);
        $authUserName = Auth()->user()->user_first_name . ' ' . Auth()->user()->user_last_name;
        // dd($authUserName);
        $validatedData = $request->validate([
            'service_cat_name' => 'required|string|max:255|unique:service_categories,service_cat_name',
            'service_cat_description' => 'nullable|string|max:255',
            'service_cat_status' => 'required|string|max:255',
        ]);
        // dd($validatedData);
        try {
            $input = [
                'service_cat_name' => $validatedData['service_cat_name'],
                'service_cat_description' => $validatedData['service_cat_description'],
                'service_cat_status' => $validatedData['service_cat_status'],
                'cat_created_by' => $authUserName,
            ];

            $serviceCategory = $this->serviceCategoryRepository->create($input);

            return redirect(route('serviceCategories.index'))->with('success', 'Service Category saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the Service Category.'])->withInput();
        }
    }

    /**
     * Display the specified Service_Category.
     */
    public function show($service_cat_id)
    {
        $serviceCategory = Service_Category::where('service_cat_id', $service_cat_id)->first();

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }
        // dd($serviceCategory);
        return view('service__categories.show')->with('serviceCategory', $serviceCategory);
    }

    /**
     * Show the form for editing the specified Service_Category.
     */
    public function edit($service_cat_id)
    {
        $serviceCategory = Service_Category::where('service_cat_id', $service_cat_id)->first();

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }

        return view('service__categories.edit')->with('serviceCategory', $serviceCategory);
    }

    /**
     * Update the specified Service_Category in storage.
     */
    public function update($service_cat_id, UpdateService_CategoryRequest $request)
    {
        $authUserName = Auth()->user()->user_first_name . ' ' . Auth()->user()->user_last_name;
        $serviceCategory = Service_Category::where('service_cat_id', $service_cat_id)->first();

        if (empty($serviceCategory)) {
            return redirect(route('serviceCategories.index'))->withErrors(['error' => 'Service Category not found']);
        }
        try {
            $request['cat_updated_by'] = $authUserName;
            $serviceCategory->update($request->all());

            Flash::success('Service Category updated successfully.');
            return redirect(route('serviceCategories.index'))->with('success', 'Service Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Service Category.'])->withInput();
        }
    }

    /**
     * Remove the specified Service_Category from storage.
     *
     * @throws \Exception
     */
    public function destroy($service_cat_id)
    {
        $serviceCategory = $this->serviceCategoryRepository->find($service_cat_id);

        if (empty($serviceCategory)) {
            Flash::error('Service  Category not found');

            return redirect(route('serviceCategories.index'));
        }

        $this->serviceCategoryRepository->delete($service_cat_id);

        Flash::success('Service  Category deleted successfully.');

        return redirect(route('serviceCategories.index'));
    }
}
