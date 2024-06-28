<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequestDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
        foreach ($messages as $index => $data) {
            if ($data->message) {
                $data->message = Crypt::decryptString($data->message);
            }
        }

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        // dd($request);
        $request->validate([
            'draft_id' => 'required|exists:customer_drafts,id',
            'receiver_id' => 'required|exists:users,user_id',
            'message' => 'nullable|string',
            'attachment' => 'nullable|mimes:pdf,docx,jpeg,png,gif|max:5120',
        ]);
        $created_by = Auth::user()->user_id;

        if ($request->hasFile('attachment')) {
            $attachmentFile = $request->file('attachment');
            $attachmentOriginalName = $attachmentFile->getClientOriginalName();
            $attachmentPath = $attachmentFile->storeAs('public/chatAttachments', $attachmentOriginalName);
            $attachmentPath = str_replace('public/', '', $attachmentPath);
        } else {
            $attachmentPath = null;
        }
        if ($request->has('message')) {
            $encryptedMessage = Crypt::encryptString($request->message);
        }
        $send = ChangeRequestDraft::create([
            'draft_id' => $request->draft_id,
            'sender_id' => Auth::user()->user_id,
            'receiver_id' => $request->receiver_id,
            'message' => $encryptedMessage,
            'attachment' => $attachmentPath,
            'created_by' => $created_by,
            'updated-by' => '',
        ]);


        return response()->json(['status' => 'Message sent!']);
    }
}
