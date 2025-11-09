<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{
    protected $primaryKey = 'attachment_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'message_id',
        'attachment_path',
        'attachment_type',
        'mime_type',
        'thumbnail_path',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'message_id');
    }

    public function getRouteKeyName()
    {
        return 'attachment_id';
    }
}
