<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemAlert extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'message', 'name', 'email', 'subject', 'is_read', 'user_id'];

    

    /**
     * Relationship to User model.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * Accessor for 'status' attribute based on is_read boolean.
     */
    public function getStatusAttribute()
    {
        return $this->is_read ? 'read' : 'new';
    }
}
