<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable=[
        'book_id',
        'name',
        'value'
    ];

    public function book(){
        return $this->hasOne(Book::class);
    }
}
