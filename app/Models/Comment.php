<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image_id', 'body', 'approved'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, User $user)
    {
        // Image::whereBelongsTo($user) => where('user_id', $user->id)
        return $query->whereIn('image_id', Image::whereBelongsTo($user)->pluck('id'));
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
}
