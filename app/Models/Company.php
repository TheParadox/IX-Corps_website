<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = true;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'regiment_id',
        'letter',
        'co_id',
        'firstSgt_id',
        'sgts',
        'cpls',
        'troops',
        'isActive',
        'createdBy',
    ];
}
