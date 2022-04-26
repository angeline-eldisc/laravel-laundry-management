<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'gender',
        'phone_num'
    ];

    /**
     * One to many relationship
     */
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
