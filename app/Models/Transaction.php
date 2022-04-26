<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Many to one relationship
     */
    public function member(){
        return $this->belongsTo(Member::class);
    }

    /**
     * Many to many relationship
     */
    public function packages() {
        return $this->belongsToMany(Package::class, 'detail_transactions')->withPivot(['id', 'qty', 'total','description'])->withTimestamps();
    }
}
