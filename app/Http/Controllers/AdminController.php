<?php

namespace App\Http\Controllers;

use App\Models\CustomerDrafts;
use App\Models\Service_Category;
use App\Models\Service_Sub_Category;
use App\Models\ServiceSubSubCategory;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Monolog\Formatter\JsonFormatter;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view("admin.index");
    }

    public function profile(){
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
    public function show(Request $request)
    {
        //
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

    public function customer_drafts(Request $request){
        $draftsJson = CustomerDraftsController::getCustomerDrafts($request);
        $draftsArray = json_decode($draftsJson->content(), true);
        $data = [];
        foreach ($draftsArray as $values) {
            $data2=[];
            $data2['service_cat'] = Service_Category::select('service_cat_name')->where('service_cat_id', $values['service_cat_id'])->first()->service_cat_name;
            $data2['service_sub_cat'] = Service_Sub_Category::select('service_sub_cat_name')->where('service_sub_cat_id', $values['service_sub_cat_id'])->first()->service_sub_cat_name;
            $data2['service_subsub_cat'] = ServiceSubSubCategory::select('service_subsub_cat_name')->where('service_subsub_cat_id', $values['service_subsub_cat_id'])->first()->service_subsub_cat_name;
            $data2['date'] = Carbon::parse($values['created_at'])->format('d-M-Y h:i A');
            $data[] = array_merge($values, $data2); 
        }
        // dd($data);
        
        return view('admin.customer-drafts.index', compact('data'));
    }
}
