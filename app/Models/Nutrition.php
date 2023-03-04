<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nutrition extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['fruit_id','carbohydrates','protein','fat','calories','sugar'];

    /**
     * @return BelongsTo
     */
    public function fruit():BelongsTo
    {
        return $this->belongsTo(Fruit::class);
    }

}
