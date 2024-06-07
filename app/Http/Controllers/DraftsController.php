<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDraftsRequest;
use App\Http\Requests\UpdateDraftsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DraftsRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Service_Category;
use App\Models\Service_Sub_Category;
use App\Models\ServiceSubSubCategory;
use Illuminate\Support\Facades\DB;  

class DraftsController extends AppBaseController
{
    /** @var DraftsRepository $draftsRepository*/
    private $draftsRepository;

    public function __construct(DraftsRepository $draftsRepo)
    {
        $this->draftsRepository = $draftsRepo;
    }

    /**
     * Display a listing of the Drafts.
     */
    public function index(Request $request)
    {
        $drafts = $this->draftsRepository->paginate(10);

        return view('drafts.index')
            ->with('drafts', $drafts);
    }

    /**
     * Show the form for creating a new Drafts.
     */
    public function create(Request $request)
    {
        // dd($request);
        $serviceCats = Service_Category::all();
        $drafts_types = DB::table('draft_types')->select('*')->get();

        return view('drafts.create', compact('serviceCats','drafts_types'));
    }

    /**
     * Store a newly created Drafts in storage.
     */
    public function store(CreateDraftsRequest $request)
    {
        $input = $request->all();

        $drafts = $this->draftsRepository->create($input);

        Flash::success('Drafts saved successfully.');

        return redirect(route('drafts.index'));
    }

    /**
     * Display the specified Drafts.
     */
    public function show($id)
    {
        $drafts = $this->draftsRepository->find($id);

        if (empty($drafts)) {
            Flash::error('Drafts not found');

            return redirect(route('drafts.index'));
        }

        return view('drafts.show')->with('drafts', $drafts);
    }

    /**
     * Show the form for editing the specified Drafts.
     */
    public function edit($id)
    {
        $drafts = $this->draftsRepository->find($id);

        if (empty($drafts)) {
            Flash::error('Drafts not found');

            return redirect(route('drafts.index'));
        }

        return view('drafts.edit')->with('drafts', $drafts);
    }

    /**
     * Update the specified Drafts in storage.
     */
    public function update($id, UpdateDraftsRequest $request)
    {
        $drafts = $this->draftsRepository->find($id);

        if (empty($drafts)) {
            Flash::error('Drafts not found');

            return redirect(route('drafts.index'));
        }

        $drafts = $this->draftsRepository->update($request->all(), $id);

        Flash::success('Drafts updated successfully.');

        return redirect(route('drafts.index'));
    }

    /**
     * Remove the specified Drafts from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $drafts = $this->draftsRepository->find($id);

        if (empty($drafts)) {
            Flash::error('Drafts not found');

            return redirect(route('drafts.index'));
        }

        $this->draftsRepository->delete($id);

        Flash::success('Drafts deleted successfully.');

        return redirect(route('drafts.index'));
    }
}
