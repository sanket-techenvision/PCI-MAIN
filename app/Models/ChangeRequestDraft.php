<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequestDraft extends Model
{
    use HasFactory;
    protected $fillable = [
        'draft_id',
        'sender_id',
        'receiver_id',
        'message',
        'attachment',
        'sent_at',
        'created_by',
        'updated_by'
    ];
    public function draft()
    {
        return $this->belongsTo(CustomerDrafts::class, 'draft_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
