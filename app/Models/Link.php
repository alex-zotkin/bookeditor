<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        "character1_id",
        "color_id",
        "character2_id",
        "book_id"
    ];

    public function character1(){
        return $this->belongsTo(Character::class, 'character1_id');
    }

    public function character2(){
        return $this->belongsTo(Character::class, 'character2_id');
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
