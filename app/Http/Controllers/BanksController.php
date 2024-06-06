<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBanksRequest;
use App\Http\Requests\UpdateBanksRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Banks;
use App\Models\Service_Sub_Category;
use App\Repositories\BanksRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use DB;
use PHPUnit\Framework\Constraint\ArrayHasKey;

class BanksController extends AppBaseController
{
    /** @var BanksRepository $banksRepository*/
    private $banksRepository;

    public function __construct(BanksRepository $banksRepo)
    {
        $this->banksRepository = $banksRepo;
    }

    /**
     * Display a listing of the Banks.
     */
    public function index(Request $request)
    {
        $banks = $this->banksRepository->all();
        // dd($banks);
        return view('banks.index')
            ->with('banks', $banks);
    }

    /**
     * Show the form for creating a new Banks.
     */
    public function create()
    {
        $serviceSubCategories = Service_Sub_Category::all()->pluck('service_sub_cat_name','service_sub_cat_id');
        // $data = json_encode($serviceSubCategories);
        // dd($data);
        return view('banks.create', compact('serviceSubCategories'));
    }

    /**
     * Store a newly created Banks in storage.
     */
    public function store(CreateBanksRequest $request)
    {
        $input = $request->all();

        $banks = $this->banksRepository->create($input);

        Flash::success('Banks saved successfully.');

        return redirect(route('banks.index'));
    }

    /**
     * Display the specified Banks.
     */
    public function show($id)
    {
        $banks = $this->banksRepository->find($id);

        if (empty($banks)) {
            Flash::error('Banks not found');

            return redirect(route('banks.index'));
        }

        return view('banks.show')->with('banks', $banks);
    }

    /**
     * Show the form for editing the specified Banks.
     */
    public function edit($id)
    {
        $banks = $this->banksRepository->find($id);
        $serviceSubCategories = Service_Sub_Category::all()->pluck('service_sub_cat_name', 'service_sub_cat_id');
        $draftTypes = DB::table('draft_types')->pluck('draft_type', 'draftType_id');
        if (empty($banks)) {
            Flash::error('Banks not found');

            return redirect(route('banks.index'));
        }

        return view('banks.edit', compact('banks', 'serviceSubCategories','draftTypes'));
    }

    /**
     * Update the specified Banks in storage.
     */
    public function update($id, UpdateBanksRequest $request)
    {
        $banks = $this->banksRepository->find($id);

        if (empty($banks)) {
            Flash::error('Banks not found');
            return redirect(route('banks.index'));
        }
        $banks = $this->banksRepository->update($request->all(), $id);
        Flash::success('Banks updated successfully.');

        return redirect(route('banks.index'));
    }

    /**
     * Remove the specified Banks from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $banks = $this->banksRepository->find($id);

        if (empty($banks)) {
            Flash::error('Banks not found');

            return redirect(route('banks.index'));
        }

        $this->banksRepository->delete($id);

        Flash::success('Banks deleted successfully.');

        return redirect(route('banks.index'));
    }
    public function getBanksData($subCategoryId){
        // dd($subCategoryId);
        // $banks = $this->banksRepository->all()->pluck('bank_name','bank_id');
        $data = Banks::whereJsonContains('service_sub_cat_id', $subCategoryId)->pluck('bank_name','bank_id');
        return response()->json($data);
    }
}
