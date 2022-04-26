<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'package_name',
        'price'
    ];


    /**
     * Many to many relationship
     */
    public function transactions() {
        return $this->belongsToMany(Transaction::class, 'detail_transactions')->withPivot(['id', 'qty', 'total', 'description'])->withTimestamps();
    }
}
