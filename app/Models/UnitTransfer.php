<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitTransfer extends Model
{
    use HasFactory;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transferee',

        'currentCompany',
        'currentRegiment',
        'currentCO',
        'currentApproval',
        'currentReason',

        'nextCompany',
        'nextRegiment',
        'nextCO',
        'nextApproval',
        'nextReason',

        'requester',
        'reason',
    ];
}
