<?php

namespace App\Http\Controllers;

use App\Mail\GenerateDraftMail;
use App\Mail\RejectDraftMail;
use App\Models\Banks;
use App\Models\Country;
use App\Models\CustomerDrafts;
use App\Models\Service_Category;
use App\Models\Service_Sub_Category;
use App\Models\ServiceSubSubCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Monolog\Formatter\JsonFormatter;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.index");
    }

    public function profile()
    {
        return redirect()->route("admin-dashboard");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //getCustomerDrafts
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // dd($id);
        $data = CustomerDrafts::where('id', $id)->first();
        if (empty($data)) {
            session()->flash('error', 'Draft not found');
            return redirect(route('admin.drafts.index'));
        }
        $data['service_cat_id'] = Service_Category::where('service_cat_id', $data['service_cat_id'])->first()->service_cat_name;
        $data['service_sub_cat_id'] = Service_Sub_Category::where('service_sub_cat_id', $data['service_sub_cat_id'])->first()->service_sub_cat_name;
        $data['service_subsub_cat_id'] = ServiceSubSubCategory::where('service_subsub_cat_id', $data['service_subsub_cat_id'])->first()->service_subsub_cat_name;
        $data['bank_id'] = Banks::where('bank_id', $data['bank_id'])->first()->bank_name;

        // dd($data);
        return view('admin.customer-drafts.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }

    public function customer_drafts(Request $request)
    {
        $draftsJson = CustomerDraftsController::getCustomerDrafts($request);
        $draftsArray = json_decode($draftsJson->content(), true);
        $data = [];
        foreach ($draftsArray as $values) {
            $data2 = [];
            $data2['service_cat'] = Service_Category::select('service_cat_name')->where('service_cat_id', $values['service_cat_id'])->first()->service_cat_name;
            $data2['service_sub_cat'] = Service_Sub_Category::select('service_sub_cat_name')->where('service_sub_cat_id', $values['service_sub_cat_id'])->first()->service_sub_cat_name;
            $data2['service_subsub_cat'] = ServiceSubSubCategory::select('service_subsub_cat_name')->where('service_subsub_cat_id', $values['service_subsub_cat_id'])->first()->service_subsub_cat_name;
            $data2['date'] = Carbon::parse($values['created_at'])->format('d-M-Y h:i A');
            $data[] = array_merge($values, $data2);
        }
        // dd($data);

        return view('admin.customer-drafts.index', compact('data'));
    }

    public function approve_customer_draft(Request $request)
    {
        // Fetch the record by its ID
        $customerDraft = CustomerDrafts::find($request->id);

        // Check if the record exists and the current status is 'pending' and not generated
        if ($customerDraft && $customerDraft->approval_status == 'pending'  && $customerDraft->approval_status != 'generated') {
            // Update the status to 'generated'
            $customerDraft->approval_status = 'generated';
            $customerDraft->approve_notice = $request->approve_notice;

            $customerDraft->save();

            $bank_name = Banks::where('bank_id', $customerDraft['bank_id'])->first()->bank_name;
            $bank_swift_code = Banks::where('bank_id', $customerDraft['bank_id'])->first()->bank_swift_code;
            $bank_address = Banks::where('bank_id', $customerDraft['bank_id'])->first()->bank_address;

            $letter_type = '';
            $service_SubSub_Cats = ServiceSubSubCategory::all();
            if ($customerDraft['service_cat_id'] == 1) {
                $subsubcatid = $customerDraft['service_subsub_cat_id'];
                if ($subsubcatid) {
                    $letter_type = ServiceSubSubCategory::where('service_subsub_cat_id', $subsubcatid)->first()->service_subsub_cat_name;
                }
            } elseif ($customerDraft['service_cat_id'] == 3) {
                $subsubcatid = $customerDraft['service_subsub_cat_id'];
                if ($subsubcatid) {
                    $letter_type = ServiceSubSubCategory::where('service_subsub_cat_id', $subsubcatid)->first()->service_subsub_cat_name;
                }
            } else {
                $letter_type = '(Type of Letter)';
            }

            $currentDate = Carbon::now()->format('Y-m-d_H-i-s');
            $startOfDay = Carbon::now()->startOfDay();
            $endOfDay = Carbon::now()->endOfDay();
            $ref_1 = Country::select('sortname')->where('name', $customerDraft['applicant_country'])->first()->sortname;
            $ref_2 = Service_Category::where('service_cat_id', $customerDraft['service_cat_id'])->first()->short_name;
            $ref_3 = Carbon::now()->format('d');
            $ref_4 = CustomerDrafts::whereBetween('created_at', [$startOfDay, $endOfDay])->count();
            $ref_5 = Carbon::now()->format('my');
            $ref_6 = ServiceSubSubCategory::where('service_subsub_cat_id', $customerDraft['service_subsub_cat_id'])->first()->short_name;
            $ref_7 = $customerDraft->applicant_first_name;
            $reference_name = $ref_1 . '/' . $ref_2 . '/' . $ref_3 . '-' . $ref_4 . '/' . $ref_5 . '.' . $ref_6 . '.' . $ref_7;
            $reference_name = 'REF : ' . $reference_name;
            // dd($reference_name);
            // dd($customerDraft);
            $pdf = PDF::loadView('admin.customer-drafts.customer_draft_pdf_rwa', [
                'applicant_first_name' => $customerDraft['applicant_first_name'],
                'applicant_last_name' => $customerDraft['applicant_last_name'],
                'applicant_email' => $customerDraft['applicant_email'],

                'applicant_address' => $customerDraft['applicant_address'],
                'applicant_country' => $customerDraft['applicant_country'],
                'applicant_state' => $customerDraft['applicant_state'],
                'applicant_city' => $customerDraft['applicant_city'],

                'bank_name' => $bank_name,
                'bank_swift_code' => $bank_swift_code,
                'bank_address' => $bank_address,

                'beneficiary_first_name' => $customerDraft['beneficiary_first_name'],
                'beneficiary_last_name' => $customerDraft['beneficiary_last_name'],
                'beneficiary_email' => $customerDraft['beneficiary_email'],

                'beneficiary_address' => $customerDraft['beneficiary_address'],
                'beneficiary_country' => $customerDraft['beneficiary_country'],
                'beneficiary_state' => $customerDraft['beneficiary_state'],
                'beneficiary_city' => $customerDraft['beneficiary_city'],

                'beneficiary_account_no' => $customerDraft['beneficiary_account_no'],
                'guarantee_amount' => $customerDraft['guarantee_amount'],
                'contract_no' => $customerDraft['contract_no'],
                'contract_date' => $customerDraft['contract_date'],
                'letter_type' => $letter_type,
                'reference' => $reference_name,
            ]);
            $filename = 'customer_draft_' . $customerDraft['applicant_first_name'] . '_' . $customerDraft['applicant_last_name'] . '_'  . $currentDate . '.pdf';
            $pdfPath = storage_path('app/public/' . $filename);
            $pdf->save($pdfPath);

            // Update the file_path after saving the PDF
            $customerDraft->file_path = 'public/' . $filename;
            $customerDraft->save();
            $details = [
                'subject' => 'Draft Generated Notice',
                'title' => 'Your draft has been generated',
                'body' => 'Congratulations! Your draft has been generated. You can view the generated draft attached below.',
            ];
            Mail::to($customerDraft->applicant_email)->send(new GenerateDraftMail($details, $filename));

            // Optional: return a response or redirect based on your application flow
            return redirect()->route('admin.drafts.index')->with('success', 'The draft was generated and a notification email was sent successfully...!!!');
        } elseif ($customerDraft && $customerDraft->approval_status == 'generated') {
            return redirect()->route('admin.drafts.index')->with('error', 'Already Approved...!');
        } else {
            return redirect()->back()->with('error', 'Draft Not Found...!');
        }
    }
    public function reject_customer_draft(Request $request)
    {
        // dd($request );
        $customerDraft = CustomerDrafts::find($request->id);
        if ($customerDraft && $customerDraft->approval_status == 'pending') {
            // Update the status to 'rejected'
            $customerDraft->approval_status = 'rejected';
            $customerDraft->reason = $request->reason;
            $customerDraft->save();
            $details = [
                'subject' => 'Draft Rejection Notice',
                'title' => 'Your draft has been rejected',
                'body' => 'We regret to inform you that your draft has been rejected. Please review the feedback and resubmit.',
                'reason' => $request->input('reason', 'No specific reason provided.')
            ];
            Mail::to($customerDraft->applicant_email)->send(new RejectDraftMail($details));
            return redirect()->back()->with('success', 'The draft was rejected and a notification email was sent successfully.');
        } else {
            return redirect()->back()->with('error', 'Draft not found or already processed.');
        }
    }
}
