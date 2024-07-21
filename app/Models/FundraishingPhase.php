<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundraishingPhase extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'name',
        'notes',
        'photo',
        'fundraising_id'
    ];

    // public function fundraising(){
    //     return $this->belongsTo(Fundraising::class);
    // } ga pake ini
}
