<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominateAward extends Model
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
        'award',
        'reason',
        'approved',
        'approvedBy',
        'approvedReason',
        'nominator',
    ];
}
