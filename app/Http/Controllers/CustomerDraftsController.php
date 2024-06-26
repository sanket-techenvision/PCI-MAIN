<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerDraftsRequest;
use App\Http\Requests\UpdateCustomerDraftsRequest;
use App\Http\Controllers\AppBaseController;
use App\Mail\CustomerDraftRequest;
use App\Mail\DraftRequest;
use App\Models\Banks;
use App\Models\City;
use App\Models\Service_Category;
use App\Models\Service_Sub_Category;
use App\Models\ServiceSubSubCategory;
use App\Repositories\CustomerDraftsRepository;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Country;
use App\Models\Currency;
use App\Models\CustomerDrafts;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Psy\CodeCleaner;

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
        $draftcount = $customerDrafts->count();
        $srno = $draftcount;
        foreach ($customerDrafts as $data) {
            $data['service_category'] = Service_Category::where('service_cat_id', $data['service_cat_id'])->first()->service_cat_name;
            $data['service_sub_category'] = Service_Sub_Category::where('service_sub_cat_id', $data['service_sub_cat_id'])->first()->service_sub_cat_name;
            $data['service_subsub_category'] = ServiceSubSubCategory::where('service_subsub_cat_id', $data['service_subsub_cat_id'])->first()->service_subsub_cat_name;
            $data['bank_name'] = Banks::where('bank_id', $data['bank_id'])->first()->bank_name;
            $data['srno'] = $srno;
            $srno--;
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
        $input['applicant_country'] = Country::where('id', $input['applicant_country'])->first()->name;
        $input['applicant_state'] = State::where('id', $input['applicant_state'])->first()->name;
        $input['applicant_city'] = City::where('id', $input['applicant_city'])->first()->name;
        $input['beneficiary_country'] = Country::where('id', $input['beneficiary_country'])->first()->name;
        $input['beneficiary_state'] = State::where('id', $input['beneficiary_state'])->first()->name;
        $input['beneficiary_city'] = City::where('id', $input['beneficiary_city'])->first()->name;

        $customerDrafts = $this->customerDraftsRepository->create($input);
        $details = [
            'subject' => 'New Draft Request',
            'requested_by' => $input['applicant_first_name'] . ' ' . $input['applicant_last_name'],
            'submitted_by' => Auth::user()->user_first_name . ' ' . Auth::user()->user_last_name,
            'title' => 'New draft request created',
            'body' => 'A new draft/service/request has been submitted for approval. Here are the details:',
        ];
        // dd($details);
        // Send Mail To Admin
        Mail::to('sanket@techenvision.in')->send(new DraftRequest($details));

        // Send Mail to Customer/applicant
        Mail::to($input['applicant_email'])->send(new CustomerDraftRequest($details));

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
        $isApproved = ($customerDrafts->approval_status == 'generated');
        $isRejected = ($customerDrafts->approval_status == 'rejected');
        return view('customer.customer_drafts.show', [
            'customerDrafts' => $customerDrafts,
            'isApproved' => $isApproved,
            'isRejected' => $isRejected,
        ]);
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

        $categoryName = Service_Category::where('service_cat_id', $categoryId)->first()->service_cat_name;
        $subCategoryName = Service_Sub_Category::where('service_sub_cat_id', $subCategoryId)->first()->service_sub_cat_name;
        $subSubCategoryName = ServiceSubSubCategory::where('service_subsub_cat_id', $subSubCategoryId)->first()->service_subsub_cat_name;
        $bankName = Banks::where('bank_id', $bankId)->first()->bank_name;

        $countries = Country::all();
        $currency = Currency::all();
        $user = Auth::user();
        $userdata['stateid'] = State::where('name', $user['user_state'])->first()->id;
        $userdata['cityid'] = City::where('name', $user['user_city'])->first()->id;

        $formFields = '';
        $breadCrumb = '<nav aria-label="breadcrumb" style="display:flex; justify-content: start;">
                    <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><h4 style="display: inline;"><a href="#">' . $categoryName . '</a></h4></li>
                        <li class="breadcrumb-item"><h4 style="display: inline;"><a href="#">' . $subCategoryName . '</a></h4></li>
                        <li class="breadcrumb-item active" aria-current="page"><h4 style="display: inline;">' . $subSubCategoryName . '</h4></li>
                    </ol>
                </nav>';

        if ($categoryId == 1 && in_array($subSubCategoryId, [1, 2, 3, 4, 5, 6, 7, 8])) {
            // Form For all RWA->Hard Copy
            $formFields = view('customer.customer_drafts.forms.1A1', compact('countries', 'userdata', 'currency', 'breadCrumb'))->render();
        } elseif ($categoryId == 2) {
            $formFields = view('customer.customer_drafts.forms.2A1', compact('countries', 'userdata', 'currency', 'breadCrumb'))->render();
        } elseif ($categoryId == 3 && $subCategoryId == 8 && $subSubCategoryId == 39) {
            // Form for BG->Performance Bond
            $formFields = view('customer.customer_drafts.forms.3A1', compact('countries', 'userdata', 'currency', 'breadCrumb'))->render();
        } else {
            // Handle other cases or return a default form
            $formFields = '<p id="disable_next">No form available for the selected options.</p>';
        }

        return response($formFields);
    }

    public static function getCustomerDrafts(Request $request)
    {
        $data = CustomerDrafts::all();
        return response()->json($data);
    }

    public static function downloaddraft($id)
    {
        // dd($id);
        $data = CustomerDrafts::select('*')->where('id', $id)->where('approval_status', 'generated')->first();
        if ($data) {
            $filePath = $data->file_path;
            // dd($filePath);
            // Check if the file exists in storage
            if (Storage::exists($filePath)) {
                // Return the file as a response for download
                return Storage::download($filePath);
            } else {
                // File does not exist in storage
                return redirect()->back()->with('error', 'Draft PDF not found in storage');
            }
        } else {
            return redirect()->back()->with('error', 'Draft PDF not generated or not approved...!');
        }
    }

    public function changerequestform(Request $request)
    {
        $request['chnageinrequest'] = strip_tags($request->input('chnageinrequest'));
        dd($request);
        $validData = $request->validate([
            'chnageinrequest' => 'required|string',
            'file' => 'nullable|file|max:2024|mimes:pdf,doc,docx,jpeg,png',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            dd($file);
        }
    }

    public function cofirmDraft(Request $request)
    {
        $id = $request->input('draft_id');
        $draft = CustomerDrafts::select('id')->where('id', $id)
            ->where('approval_status', 'generated')
            ->where('applicant_confirmation', 'pending')
            ->first();
        if ($draft) {
            $draft['applicant_confirmation'] = 'Confirmed';
            $draft->save();
            return redirect()->back()->with('success', 'Draft confirmed successfully');
        } else {
            return redirect()->back()->with('error', 'Draft Already Approved...!!!');
        }
    }
}
