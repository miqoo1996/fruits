<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Fruit extends Model
{
    use HasFactory;

    const FAVORITE = 1;

    const NOT_FAVORITE = 0;

    /**
     * @var array
     */
    protected $fillable = ['genus','name','family','order','ref_id','is_favorite'];


    /**
     * @return HasOne
     */
    public function nutrition():HasOne
    {
        return $this->hasOne(Nutrition::class);
    }

}
