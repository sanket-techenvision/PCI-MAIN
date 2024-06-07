<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerDraftsRequest;
use App\Http\Requests\UpdateCustomerDraftsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Banks;
use App\Models\Service_Category;
use App\Models\Service_Sub_Category;
use App\Models\ServiceSubSubCategory;
use App\Repositories\CustomerDraftsRepository;
use Illuminate\Http\Request;
use Flash;

class CustomerDraftsController extends AppBaseController
{
    /** @var CustomerDraftsRepository $customerDraftsRepository*/
    private $customerDraftsRepository;

    public function __construct(CustomerDraftsRepository $customerDraftsRepo)
    {
        $this->customerDraftsRepository = $customerDraftsRepo;
    }

    /**
     * Display a listing of the CustomerDrafts.
     */
    public function index(Request $request)
    {
        $customerDrafts = $this->customerDraftsRepository->all();
        
        foreach ($customerDrafts as $data) {
            $data['service_category'] = Service_Category::where('service_cat_id', $data['service_cat_id'])->first()->service_cat_name;
            $data['service_sub_category'] = Service_Sub_Category::where('service_sub_cat_id', $data['service_sub_cat_id'])->first()->service_sub_cat_name;
            $data['service_subsub_category'] = ServiceSubSubCategory::where('service_subsub_cat_id', $data['service_subsub_cat_id'])->first()->service_subsub_cat_name;
            $data['bank_name'] = Banks::where('bank_id', $data['bank_id'])->first()->bank_name;
        }
        // dd($customerDrafts);

        return view('customer.customer_drafts.index')
            ->with('customerDrafts', $customerDrafts);
    }

    /**
     * Show the form for creating a new CustomerDrafts.
     */
    public function create()
    {
        $serviceCats = Service_Category::all();

        return view('customer.customer_drafts.create', compact('serviceCats'));
    }

    /**
     * Store a newly created CustomerDrafts in storage.
     */
    public function store(CreateCustomerDraftsRequest $request)
    {
        // dd($request);
        $input = $request->all();

        $customerDrafts = $this->customerDraftsRepository->create($input);

        Flash::success('Customer Drafts saved successfully.');

        return redirect(route('customer-drafts.index'));
    }

    /**
     * Display the specified CustomerDrafts.
     */
     

    /**
     * Show the form for editing the specified CustomerDrafts.
     */
    public function edit($id)
    {
        $customerDrafts = $this->customerDraftsRepository->find($id);
        $serviceCats = Service_Category::all();
        // dd($customerDrafts);
        if (empty($customerDrafts)) {
            Flash::error('Customer Drafts not found');

            return redirect(route('customer-drafts.index'));
        }

        return view('customer.customer_drafts.edit', compact('customerDrafts', 'serviceCats'));
    }

    /**
     * Update the specified CustomerDrafts in storage.
     */
    public function update($id, UpdateCustomerDraftsRequest $request)
    {
        $customerDrafts = $this->customerDraftsRepository->find($id);

        if (empty($customerDrafts)) {
            Flash::error('Customer Drafts not found');

            return redirect(route('customer-drafts.index'));
        }

        $customerDrafts = $this->customerDraftsRepository->update($request->all(), $id);

        Flash::success('Customer Drafts updated successfully.');

        return redirect(route('customer-drafts.index'));
    }

    /**
     * Remove the specified CustomerDrafts from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $customerDrafts = $this->customerDraftsRepository->find($id);

        if (empty($customerDrafts)) {
            Flash::error('Customer Drafts not found');

            return redirect(route('customerDrafts.index'));
        }

        $this->customerDraftsRepository->delete($id);

        Flash::success('Customer Drafts deleted successfully.');

        return redirect(route('customer-drafts.index'));
    }
}
