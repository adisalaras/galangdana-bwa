<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fundraising extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'target_amount',
        'about',
        'thumbnail',
        'is_active',
        'has_finished',
        'fundraiser_id',
        'category_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function fundraiser(){ //dimiliki oleh fundraiser
        return $this->belongsTo(Fundraiser::class);
    }
    public function donaturs(){ //punya banyak donatur
        return $this->hasMany(Donatur::class)->where('is_paid', 1);
    }
    public function totalReachedAmount(){
        return $this->donaturs()->sum('total_amount');
    }
    public function widrawals(){
        return $this->hasMany(FundraishingWidrawal::class);
    }
    

    // public function phases(){
    //     return $this->belongsTo(FundraishingPhase::class);
    // }
    
    
}
