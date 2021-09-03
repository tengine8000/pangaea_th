<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'message',
        'topic_id',
    ];

    /**
     * Get the topic that owns the message.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
