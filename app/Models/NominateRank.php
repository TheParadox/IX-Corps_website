<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominateRank extends Model
{
    use HasFactory;
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nominee',

        'regimentID',
        'companyID',

        'rankID',
        'approved',
        'reviewed',
        'coReason',

        'nominator',
        'reason',
        'requiredApprovalPermission',
    ];
}
