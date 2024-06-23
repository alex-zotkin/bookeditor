<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function characters(){
        return $this->hasMany(Character::class)->latest();
    }

    public function colors(){
        return $this->hasMany(Color::class)->latest();
    }

    public function links(){
        return $this->hasMany(Link::class)->latest();
    }

    public function chapters(){
        return $this->hasMany(Chapter::class)->orderBy('sort');
    }

}
