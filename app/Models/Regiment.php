<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'abrv',
        'type',
        'descriptor',
        'co_id',
        'xo_id',
        'sgtMaj_id',
        'advisors',
        'companies',
        'regimentalColors',
        'createdBy',
    ];
}
