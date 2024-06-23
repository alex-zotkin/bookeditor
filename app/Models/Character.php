<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'first_name',
        'last_name',
        'age',
        'info',
        'image',
        'x',
        'y'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->links()->get()->each->delete();
        });
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function links(){
        return $this->hasMany(Link::class);
    }
}
