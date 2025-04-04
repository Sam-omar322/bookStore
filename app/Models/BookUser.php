<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    use HasFactory;

    protected $table = 'book_user';
    protected $fillable = ['user_id', 'book_id', 'number_of_copies', 'bought', 'price'];

}
