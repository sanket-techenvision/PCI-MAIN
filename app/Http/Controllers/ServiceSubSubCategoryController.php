<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceSubSubCategoryRequest;
use App\Http\Requests\UpdateServiceSubSubCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServiceSubSubCategoryRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Service_Sub_Category;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\ServiceSubSubCategory;

class ServiceSubSubCategoryController extends AppBaseController
{
    /** @var ServiceSubSubCategoryRepository $serviceSubSubCategoryRepository*/
    private $serviceSubSubCategoryRepository;

    public function __construct(ServiceSubSubCategoryRepository $serviceSubSubCategoryRepo)
    {
        $this->serviceSubSubCategoryRepository = $serviceSubSubCategoryRepo;
    }

    /**
     * Display a listing of the ServiceSubSubCategory.
     */
    public function index(Request $request)
    {
        $serviceSubSubCategories = ServiceSubSubCategory::all();
        return view('service_sub_sub_categories.index')
            ->with('serviceSubSubCategories', $serviceSubSubCategories);
    }

    /**
     * Show the form for creating a new ServiceSubSubCategory.
     */
    public function create()
    {
        $serviceSubCategories = Service_Sub_Category::all();

        return view('service_sub_sub_categories.create', compact('serviceSubCategories'));
    }

    /**
     * Store a newly created ServiceSubSubCategory in storage.
     */
    public function store(CreateServiceSubSubCategoryRequest $request)
    {
        $authUserName = Auth()->user()->user_first_name . ' ' . Auth()->user()->user_last_name;
        $validatedData = $request->validate([
            'service_sub_cat_id' => 'required|exists:service_sub_categories,service_sub_cat_id',
            'service_subsub_cat_name' => 'required|string|max:255',
            'service_subsub_cat_description' => 'nullable|string|max:255',
            'service_subsub_cat_status' => 'required|string|in:active,inactive',
        ]);
        
        try {
            $validatedData['service_subsub_cat_created_by'] = $authUserName;
            // dd($validatedData);
            $serviceSubSubCategory = $this->serviceSubSubCategoryRepository->create($validatedData);

            Flash::success('Service Sub Sub Category saved successfully.');

            return redirect(route('serviceSubSubCategories.index'));
        } catch (\Exception $e) {
            Flash::error('Combination Already Exists. The combination of service sub category and service subsub category name must be unique.');
            return redirect()->route('serviceSubSubCategories.index');
        }
    }

    /**
     * Display the specified ServiceSubSubCategory.
     */
    public function show($id)
    {
        $serviceSubSubCategory = $this->serviceSubSubCategoryRepository->find($id);
        if (empty($serviceSubSubCategory)) {
            Flash::error('Service Sub Sub Category not found');

            return redirect(route('serviceSubSubCategories.index'));
        }

        return view('service_sub_sub_categories.show')->with('serviceSubSubCategory', $serviceSubSubCategory);
    }

    /**
     * Show the form for editing the specified ServiceSubSubCategory.
     */
    public function edit($id)
    {
        $serviceSubSubCategory = $this->serviceSubSubCategoryRepository->find($id);
        $serviceSubCategories = Service_Sub_Category::all();

        if (empty($serviceSubSubCategory)) {
            Flash::error('Service Sub Sub Category not found');

            return redirect(route('serviceSubSubCategories.index'));
        }

        return view('service_sub_sub_categories.edit', compact('serviceSubSubCategory', 'serviceSubCategories'));
    }

    /**
     * Update the specified ServiceSubSubCategory in storage.
     */
    public function update($id, UpdateServiceSubSubCategoryRequest $request)
    {
        $authUserName = Auth()->user()->user_first_name . ' ' . Auth()->user()->user_last_name;

        try {
            $serviceSubSubCategory = $this->serviceSubSubCategoryRepository->find($id);

            if (empty($serviceSubSubCategory)) {
                Flash::error('Service SubSub Category not found');
                return redirect()->route('serviceSubSubCategories.index');
            }

            $validatedData = $request->all();
            $validatedData['service_subsub_cat_updated_by'] = $authUserName;

            $serviceSubSubCategory = $this->serviceSubSubCategoryRepository->update($validatedData, $id);

            Flash::success('Service SubSub Category updated successfully.');

            return redirect()->route('serviceSubSubCategories.index');
        } catch (\Exception $e) {
            Flash::error('An error occurred while updating the Service Sub Sub Category: ');

            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Service Sub Sub Category.'])->withInput();
        }
    }


    /**
     * Remove the specified ServiceSubSubCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceSubSubCategory = $this->serviceSubSubCategoryRepository->find($id);

        if (empty($serviceSubSubCategory)) {
            Flash::error('Service Sub Sub Category not found');

            return redirect(route('serviceSubSubCategories.index'));
        }

        $this->serviceSubSubCategoryRepository->delete($id);

        Flash::success('Service Sub Sub Category deleted successfully.');

        return redirect(route('serviceSubSubCategories.index'));
    }

    public function getSubSubCategories($subCategoryId)
    {
        $subSubCategories = ServiceSubSubCategory::where('service_sub_cat_id', $subCategoryId)->pluck('service_subsub_cat_name', 'service_subsub_cat_id');
        return response()->json($subSubCategories);
    }
}
