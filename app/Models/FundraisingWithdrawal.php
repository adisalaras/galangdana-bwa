<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundraisingWithdrawal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'has_received',
        'has_set',
        'amount_requested',
        'amount_received',
        'proof',
        'fundraising_id',
        'fundraiser_id'
    ];

    public function fundraiser(){
        return $this->belongsTo(Fundraiser::class);
    }
    public function fundraising(){
        return $this->belongsTo(Fundraising::class);
    }
}
