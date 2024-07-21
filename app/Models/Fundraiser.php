<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fundraiser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'user_id',
        'is_active',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } //one fundraiser to user
    // public function fundraishings(){
    //     return $this->hasMany(Fundraising::class);
    // } ga pake ini
    // public function fundraishing_widrawals(){
    //     return $this->hasMany(FundraishingWidrawal::class);
    // } ga pake ini
}
