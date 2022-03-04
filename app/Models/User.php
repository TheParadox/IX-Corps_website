<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Regiment;
use App\Models\Company;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = true;

    public static function getRegimentAbrv()
    {
        $regiment = Regiment::find(auth()->user()->regiment_id);
        if($regiment === null){
            return null;
        }

        return $regiment->abrv;
    }

    public static function getCompanyAbrv() 
    {
        $company = Company::find(auth()->user()->company_id);
        if($company === null){
            return null;
        }

        return $company->letter;
    }

    public static function getRankAbrv()
    {
        $rank = Rank::find(auth()->user()->rank_id);
        if($rank === null){
            return null;
        }

        return $rank->abrv;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'permissions',

        'email',
        'password',

        'discordName',
        'companyToolName',
        'dateJoined',
        'dateDischarged',
        'reasonForDischarge',
        'isDischarged',

        'isLOA',
        'startLOA',
        'endLOA',
        'reasonForLOA',
        'loaGranter',

        'regiment_id',
        'company_id',
        'rank_id',

        'numberDrillsAttended',
        'numberOfEventsAttended',
        'lastDrill',
        'lastEvent',

        'recruiter_id',
        'processor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
