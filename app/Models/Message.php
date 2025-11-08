<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'message_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'content', 
        'attachment_path',
        'attachment_type',
        'read_at'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class, 'message_id', 'message_id');
    }
}
