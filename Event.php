<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'image',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class)
                    ->withPivot('topic')
                    ->withTimestamps();
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class)
                    ->withPivot('registered_at');
    }
}
