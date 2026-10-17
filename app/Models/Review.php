<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function books()
    {
        return $this->belongsTo(Book::class);
    }

        public function likedReviews()
    {
        return $this->belongsToMany(
            User::class,
            'review_user',
            'review_id',
            'user_id'
        )->withTimestamps();
    }

}
