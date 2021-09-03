<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscriber;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'subscriber_id',
        'topic_id',
    ];

    /**
     * Get the subscriber that owns the subscription.
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
