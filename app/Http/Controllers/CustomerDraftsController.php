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
use PDF;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Country;

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
        $serviceCats = Service_Category::where('service_cat_id', '>', 1)->get();
        // dd($serviceCats);
        $countries = Country::all();
        return view('customer.customer_drafts.create', compact('serviceCats','countries'));
    }

    /**
     * Store a newly created CustomerDrafts in storage.
     */
    public function store(CreateCustomerDraftsRequest $request)
    {
        // dd($request);
        $input = $request->all();
        $input['bank_name'] = Banks::where('bank_id', $input['bank_id'])->first()->bank_name;
        $input['bank_swift_code'] = Banks::where('bank_id', $input['bank_id'])->first()->bank_swift_code;
        $input['bank_address'] = Banks::where('bank_id', $input['bank_id'])->first()->bank_address;


        $input['letter_type'] = '';
        if ($input['service_cat_id'] == 2) {
            $input['letter_type'] = 'LETTER OF CREDIT';
        } elseif ($input['service_cat_id'] == 3) {
            $input['letter_type'] = 'BANK GUARANTEE';
        } elseif ($input['service_cat_id'] == 4) {
            $input['letter_type'] = 'STANDBY LETTER OF CREDIT';
        } else {
            $input['letter_type'] = '';
        }
        // $customerDrafts = $this->customerDraftsRepository->create($input);
        $pdf = PDF::loadView('customer.customer_drafts.customer_draft_pdf', [
            'applicant_first_name' => $input['applicant_first_name'],
            'applicant_last_name' => $input['applicant_last_name'],
            'applicant_email' => $input['applicant_email'],
            'applicant_address' => $input['applicant_address'],

            'service_category' => $input['service_cat_id'],
            'service_sub_category' => $input['service_sub_cat_id'],
            'service_subsub_category' => $input['service_subsub_cat_id'],

            'bank_name' => $input['bank_name'],
            'bank_swift_code' => $input['bank_swift_code'],
            'bank_address' => $input['bank_address'],

            'beneficiary_first_name' => $input['beneficiary_first_name'],
            'beneficiary_last_name' => $input['beneficiary_last_name'],
            'beneficiary_email' => $input['beneficiary_email'],
            'beneficiary_address' => $input['beneficiary_address'],
            'beneficiary_account_no' => $input['beneficiary_account_no'],
            'guarantee_amount' => $input['guarantee_amount'],
            'letter_type' => $input['letter_type'],
        ]);
        $currentDate = date('Y-m-d_H-i-s');
        $currentMonth = date('F');
        $filename = 'customer_draft_' . $input['applicant_first_name'] . '_' . $input['applicant_last_name'] . '_'  . $currentDate . '.pdf';
        // Save the PDF to the storage or serve it for download
        $pdf->save(storage_path('app/public/' . $filename));

        Flash::success('Customer Drafts saved successfully.');

        return redirect(route('customer-drafts.index'));
    }

    /**
     * Display the specified CustomerDrafts.
     */
    public function show($id)
    {
        $customerDrafts = $this->customerDraftsRepository->find($id);

        if (empty($customerDrafts)) {
            Flash::error('Drafts not found');

            return redirect(route('drafts.index'));
        }
        // dd($customerDrafts);
        return view('customer.customer_drafts.show')->with('customerDrafts', $customerDrafts);
    }

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
