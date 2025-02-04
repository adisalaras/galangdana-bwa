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
        'fundraiser_id',
        'category_id',
        'thumbnail',
        'about',
        'has_finished',
        'is_active',
        'target_amount',
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
        return $this->hasMany(FundraisingWithdrawal::class);
    }
    public function fundraising_phases(){
        return $this->hasMany(FundraisingPhase::class);
    }
    
    public function getPercentageAttribute(){
        $totalDonations = $this->totalReachedAmount();
        if($this->target_amount > 0){
            $percentage = ($totalDonations/ $this->target_amount) *100;
            return $percentage > 100 ? 100 : $percentage;
            //return jika pecentage lebih dri 100= nilainya akan tetap 100, jika kurang maka akan menampilkan jumlah percentage
        }
        return 0;
    }
    
    
}
