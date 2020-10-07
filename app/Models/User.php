<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'level',
        'points',
        'referrer_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    // ACCESSORS

    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
    }

    public function getLeftPointsAttribute()
    {
       // $leftPoints = 0;
        
        // $referred = $this->referrals->where('level', 1)->first();
        // if($referred !== null) {
        //     $leftPoints += $referred ? $referred->points : 0;

        //     // Somar todos os level 1 do usuario referido à esquerda
        //     while($referred->referrals->where('level', 1)->count() > 0) {
        //         foreach ($referred->referrals as $key => $r) {
        //             $leftPoints += $r->points;
        //         }
        //         $referred = $referred->referrals->where('level', 1)->first();
        //     }

        //     $referred = $this->referrals->where('level', 1)->first();
        //     if($referred !== null) {
        //         // Somar todos os level 2 do usuario referido à esquerda
        //         while($referred->referrals->where('level', 2)->count() > 0) {
        //             foreach ($referred->referrals as $key => $r) {
        //                 $leftPoints += $r->points;
        //             }
        //             $referred = $referred->referrals->where('level', 2)->first();
        //         }
        //     }
        // }

        return $this->left_points = $this->tree->where('level', 1)->sum('points');
    }

    public function getRightPointsAttribute() {
        return $this->right_points = $this->tree->where('level', 2)->sum('points');
    }

    // METHODS

    /**
     * Retorna o usuário que indicou este usuário
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * Retorna os usuários que receberam indicação
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }

    public function tree()
    {
        return $this->referrals()->with('tree');
    }
}
