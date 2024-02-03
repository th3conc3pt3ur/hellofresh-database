<?php

namespace App\Models;

use App\Models\Traits\CountryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    //use \Illuminate\Database\Eloquent\Factories\HasFactory; // Todo
    use CountryTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'external_id',
        'uuid',
        'slug',
        'type',
        'country',
        'image_link',
        'image_path',
        'name',
        'internal_name',
        'shipped',
        'description',
        'usage',
        'has_duplicated_name',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'shipped' => 'bool',
        'usage' => 'int',
    ];

    /**
     * The recipes that belong to the ingredient.
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }
}
