<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominateUnit extends Model
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

        'currentUnit',
        'currentCO',
        'currentApproval',
        'currentReason',

        'nextUnit',
        'nextCO',
        'nextApproval',
        'nextReason',

        'requester',
        'reason',
    ];
}
