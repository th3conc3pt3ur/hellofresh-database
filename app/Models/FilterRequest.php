<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class FilterRequest extends Model
{
    //use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use HasUlids;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['data'];

    public static function requestGet(string $id)
    {
        if ($request = self::find($id)) {
            /* @var \App\Models\FilterRequest $request */
            return unserialize($request->data);
        }

        return null;
    }

    public static function requestSet(array $data): ?FilterRequest
    {
        $data = array_filter($data);
        $data = serialize(Arr::sortRecursive($data));

        return self::firstOrCreate(['data' => $data]);
    }
}
