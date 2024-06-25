<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequestDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeRequestDraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(ChangeRequestDraft $changeRequestDraft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChangeRequestDraft $changeRequestDraft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChangeRequestDraft $changeRequestDraft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChangeRequestDraft $changeRequestDraft)
    {
        //
    }

    public function getMessages($draft_id)
    {
        // dd($draft_id);
        $messages = ChangeRequestDraft::where('draft_id', $draft_id)->with(['sender', 'receiver'])->get();
        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $request->validate([
            'draft_id' => 'required|exists:customer_drafts,id',
            'receiver_id' => 'required|exists:users,user_id',
            'message' => 'required|string',
        ]);
        $created_by = Auth::user()->user_id;
        $send = ChangeRequestDraft::create([
            'draft_id' => $request->draft_id,
            'sender_id' => Auth::user()->user_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'created_by' => $created_by,
            'updated-by' => '',
        ]);

        return response()->json(['status' => 'Message sent!']);
    }
}
