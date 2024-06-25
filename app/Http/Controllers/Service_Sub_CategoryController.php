<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateService_Sub_CategoryRequest;
use App\Http\Requests\UpdateService_Sub_CategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Service_Sub_Category;
use App\Repositories\Service_Sub_CategoryRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Service_Category;

class Service_Sub_CategoryController extends AppBaseController
{
    /** @var Service_Sub_CategoryRepository $serviceSubCategoryRepository*/
    private $serviceSubCategoryRepository;
    public function __construct(Service_Sub_CategoryRepository $serviceSubCategoryRepo)
    {
        $this->serviceSubCategoryRepository = $serviceSubCategoryRepo;
    }

    /**
     * Display a listing of the Service_Sub_Category.
     */
    public function index(Request $request)
    {
        $serviceSubCategories = Service_Sub_Category::all();

        return view('service_sub_categories.index')
            ->with('serviceSubCategories', $serviceSubCategories);
    }

    /**
     * Show the form for creating a new Service_Sub_Category.
     */
    public function create()
    {
        $serviceCategories = Service_Category::all();

        return view('service_sub_categories.create', compact('serviceCategories'));
    }

    /**
     * Store a newly created Service_Sub_Category in storage.
     */
    public function store(CreateService_Sub_CategoryRequest $request)
    {
        $authUserName = Auth()->user()->user_first_name . ' ' . Auth()->user()->user_last_name;

        // Validate the request data
        $validatedData = $request->validate([
            'service_cat_id' => 'required|exists:service_categories,service_cat_id',
            'service_sub_cat_name' => 'required|string|max:255|unique:service_sub_categories,service_sub_cat_name',
            'service_sub_cat_description' => 'nullable|string|max:255',
            'service_sub_cat_status' => 'required|string|max:255',
        ]);
        try {
            // Create the service subcategory
            $input = [
                'service_cat_id' => $validatedData['service_cat_id'],
                'service_sub_cat_name' => $validatedData['service_sub_cat_name'],
                'service_sub_cat_description' => $validatedData['service_sub_cat_description'],
                'service_sub_cat_status' => $validatedData['service_sub_cat_status'],
                'service_sub_cat_created_by' => $authUserName,
            ];

            $serviceSubCategory = $this->serviceSubCategoryRepository->create($input);

            return redirect(route('service_sub_categories.index'))->with('success', 'Service Subcategory saved successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the Service Subcategory.'])->withInput();
        }
    }


    /**
     * Display the specified Service_Sub_Category.
     */
    public function show($id)
    {
        $serviceSubCategory = $this->serviceSubCategoryRepository->find($id);

        if (empty($serviceSubCategory)) {
            Flash::error('Service  Sub  Category not found');

            return redirect(route('service_sub_categories.index'));
        }

        return view('service_sub_categories.show')->with('serviceSubCategory', $serviceSubCategory);
    }

    /**
     * Show the form for editing the specified Service_Sub_Category.
     */
    public function edit($id)
    {
        $serviceSubCategory = $this->serviceSubCategoryRepository->find($id);
        $serviceCategories = Service_Category::all();

        if (empty($serviceSubCategory)) {
            Flash::error('Service  Sub  Category not found');

            return redirect(route('service_sub_categories.index'));
        }

        return view('service_sub_categories.edit', compact('serviceSubCategory', 'serviceCategories'));
    }

    /**
     * Update the specified Service_Sub_Category in storage.
     */
    public function update($service_sub_cat_id, UpdateService_Sub_CategoryRequest $request)
    {
        $authUserName = Auth()->user()->user_first_name . ' ' . Auth()->user()->user_last_name;
        $serviceSubCategory = Service_Sub_Category::where('service_sub_cat_id', $service_sub_cat_id)->first();
        if (empty($serviceSubCategory)) {
            return redirect(route('service_sub_categories.index'))->withErrors(['error' => 'Service Subcategory not found']);
        }
        try {
            $input = $request->all();
            $input['service_sub_cat_updated_by'] = $authUserName;

            $serviceSubCategory->update($input);
            Flash::success('Service Sub Category updated successfully.');
            return redirect(route('service_sub_categories.index'))->with('success', 'Service Subcategory updated successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Service Subcategory.'])->withInput();
        }
    }


    /**
     * Remove the specified Service_Sub_Category from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceSubCategory = $this->serviceSubCategoryRepository->find($id);

        if (empty($serviceSubCategory)) {
            Flash::error('Service  Sub  Category not found');

            return redirect(route('service_sub_categories.index'));
        }

        $this->serviceSubCategoryRepository->delete($id);

        Flash::success('Service  Sub  Category deleted successfully.');

        return redirect(route('service_sub_categories.index'));
    }


    public function getSubCategories($categoryId)
    {
        $subCategories = Service_Sub_Category::where('service_cat_id', $categoryId)->pluck('service_sub_cat_name', 'service_sub_cat_id');
        return response()->json($subCategories);
    }
}
