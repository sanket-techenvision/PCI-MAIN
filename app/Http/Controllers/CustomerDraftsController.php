<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerDraftsRequest;
use App\Http\Requests\UpdateCustomerDraftsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Banks;
use App\Models\City;
use App\Models\Service_Category;
use App\Models\Service_Sub_Category;
use App\Models\ServiceSubSubCategory;
use App\Repositories\CustomerDraftsRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Country;
use App\Models\Currency;
use App\Models\CustomerDrafts;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $user_id = Auth::user()->user_id;

        $customerDrafts = CustomerDrafts::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        $srno = 1;
        foreach ($customerDrafts as $data) {
            $data['service_category'] = Service_Category::where('service_cat_id', $data['service_cat_id'])->first()->service_cat_name;
            $data['service_sub_category'] = Service_Sub_Category::where('service_sub_cat_id', $data['service_sub_cat_id'])->first()->service_sub_cat_name;
            $data['service_subsub_category'] = ServiceSubSubCategory::where('service_subsub_cat_id', $data['service_subsub_cat_id'])->first()->service_subsub_cat_name;
            $data['bank_name'] = Banks::where('bank_id', $data['bank_id'])->first()->bank_name;
            $data['srno'] = $srno;
            $srno++;
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
        $countries = Country::all();
        $user = Auth::user();
        $userdata['stateid'] = State::where('name', $user['user_state'])->first()->id;
        $userdata['cityid'] = City::where('name', $user['user_city'])->first()->id;
        // dd($userdata);
        return view('customer.customer_drafts.createcopy', compact('serviceCats', 'countries', 'userdata'));
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
        $input['applicant_country'] = Country::where('id', $input['applicant_country'])->first()->name;
        $input['applicant_state'] = State::where('id', $input['applicant_state'])->first()->name;
        $input['applicant_city'] = City::where('id', $input['applicant_city'])->first()->name;
        $input['beneficiary_country'] = Country::where('id', $input['beneficiary_country'])->first()->name;
        $input['beneficiary_state'] = State::where('id', $input['beneficiary_state'])->first()->name;
        $input['beneficiary_city'] = City::where('id', $input['beneficiary_city'])->first()->name;

        // dd($input);
        $input['letter_type'] = '';
        $service_SubSub_Cats = ServiceSubSubCategory::all();
        if ($input['service_cat_id'] == 1) {
            $subsubcatid = $input['service_subsub_cat_id'];
            if ($subsubcatid) {
                $input['letter_type'] = ServiceSubSubCategory::where('service_subsub_cat_id', $subsubcatid)->first()->service_subsub_cat_name;
            }
        }elseif ($input['service_cat_id'] == 3) {
            $subsubcatid = $input['service_subsub_cat_id'];
            if ($subsubcatid) {
                $input['letter_type'] = ServiceSubSubCategory::where('service_subsub_cat_id', $subsubcatid)->first()->service_subsub_cat_name;
            }
        } else {
            $input['letter_type'] = '(Type of Letter)';
        }
        // dd($input['letter_type']);
        $currentDate = Carbon::now()->format('Y-m-d_H-i-s');
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $ref_1 = $input['applicant_country'];
        $ref_2 = Service_Category::where('service_cat_id', $input['service_cat_id'])->first()->service_cat_name;
        $ref_3 = Carbon::now()->format('d');
        $ref_4 = CustomerDrafts::whereBetween('created_at', [$startOfDay, $endOfDay])->count();
        $ref_5 = Carbon::now()->format('m-d');
        $ref_6 = ServiceSubSubCategory::where('service_subsub_cat_id', $subsubcatid)->first()->service_subsub_cat_name;

        $reference_name = $ref_1 . '/' . $ref_2 . '/' . $ref_3 . '-' . $ref_4 .'/'. $ref_5 .'.'. $ref_6;
        $reference_name = 'REF : ' . $reference_name;
        dd($reference_name);
        $customerDrafts = $this->customerDraftsRepository->create($input);

        $pdf = PDF::loadView('customer.customer_drafts.customer_draft_pdf_rwa', [
            'applicant_first_name' => $input['applicant_first_name'],
            'applicant_last_name' => $input['applicant_last_name'],
            'applicant_email' => $input['applicant_email'],

            'applicant_address' => $input['applicant_address'],
            'applicant_country' => $input['applicant_country'],
            'applicant_state' => $input['applicant_state'],
            'applicant_city' => $input['applicant_city'],

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
            'beneficiary_country' => $input['beneficiary_country'],
            'beneficiary_state' => $input['beneficiary_state'],
            'beneficiary_city' => $input['beneficiary_city'],

            'beneficiary_account_no' => $input['beneficiary_account_no'],
            'guarantee_amount' => $input['guarantee_amount'],
            'letter_type' => $input['letter_type'],
        ]);
        $filename = 'customer_draft_' . $input['applicant_first_name'] . '_' . $input['applicant_last_name'] . '_'  . $currentDate . '.pdf';
        $pdf->save(storage_path('app/public/' . $filename));

        session()->flash('success', 'Your request has been submitted successfully. Please await for admin approval. You will receive a notification via email or SMS once approved. Feel free to logout for now.');

        return redirect(route('customer-drafts.index'));
    }

    /**
     * Display the specified CustomerDrafts.
     */
    public function show($id)
    {
        $customerDrafts = $this->customerDraftsRepository->find($id);

        if (empty($customerDrafts)) {
            // Flash::error('Drafts not found');
            session()->flash('error', 'Drafts not found');
            return redirect(route('customer-drafts.index'));
        }
        $customerDrafts['service_cat_id'] = Service_Category::where('service_cat_id', $customerDrafts['service_cat_id'])->first()->service_cat_name;
        $customerDrafts['service_sub_cat_id'] = Service_Sub_Category::where('service_sub_cat_id', $customerDrafts['service_sub_cat_id'])->first()->service_sub_cat_name;
        $customerDrafts['service_subsub_cat_id'] = ServiceSubSubCategory::where('service_subsub_cat_id', $customerDrafts['service_subsub_cat_id'])->first()->service_subsub_cat_name;
        $customerDrafts['bank_id'] = Banks::where('bank_id', $customerDrafts['bank_id'])->first()->bank_name;
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
    public function getDynamicForm(Request $request)
    {
        $categoryId = $request['categoryId'];
        $subCategoryId = $request['subCategoryId'];
        $subSubCategoryId = $request['subSubCategoryId'];
        $bankId = $request['bankId'];
        $countries = Country::all();
        $user = Auth::user();
        $userdata['stateid'] = State::where('name', $user['user_state'])->first()->id;
        $userdata['cityid'] = City::where('name', $user['user_city'])->first()->id;
        
        // && in_array($subCategoryId, [1, 2, 3, 4]) && $subSubCategoryId == 37)
        $formFields = '';
        $currency = Currency::all();
        if ($categoryId == 1) {
            $formFields = view('customer.customer_drafts.forms.1A1', compact('countries', 'userdata', 'currency'))->render();
        } elseif ($categoryId == 2) {
            $formFields = view('customer.customer_drafts.forms.2A1', compact('countries', 'userdata', 'currency'))->render();
        } elseif ($categoryId == 3 && $subCategoryId == 8 && $subSubCategoryId == 7) {
            $formFields = view('customer.customer_drafts.forms.3A1', compact('countries', 'userdata', 'currency'))->render();
        } else {
            // Handle other cases or return a default form
            $formFields = '<p id="disable_next">No form available for the selected options.</p>';
        }

        return response($formFields);
    }
}
