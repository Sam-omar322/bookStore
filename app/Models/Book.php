<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'publish_id', 'title', 'isbn', 'description', 
        'publish_year', 'number_of_pages', 'number_of_copies', 
        'price', 'cover_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publish_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user')->withPivot('number_of_copies', 'bought', 'price');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
