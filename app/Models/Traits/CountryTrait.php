<?php

namespace App\Models\Traits;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait CountryTrait
{
    /**
     *  Get the first record matching the attributes. If the record is not found, create it.
     */
    public static function freshUpdateOrCreate(mixed $hfModel, string $primaryKey = 'external_id'): Model
    {
        $replace = [
            'external_id' => 'id',
            'external_created_at' => 'created_at',
            'external_updated_at' => 'updated_at',
        ];

        if (static::class == Recipe::class) {
            $replace['description'] = 'description_markdown';
        }

        /* @var \NormanHuth\HellofreshScraper\Models\AbstractModel $hfModel */
        $columns = (new static())->getFillable();
        $data = $hfModel->data();

        $columns = Arr::mapWithKeys(
            $columns,
            fn (string $column) => [$column => data_get(
                $data,
                Str::camel(str_replace(array_keys($replace), array_values($replace), $column))
            )]
        );

        return static::firstOrCreate(
            ['external_id' => $columns[$primaryKey]],
            Arr::except($columns, $primaryKey)
        );
    }

    protected function freshKey(string $column): string
    {
        return str_replace(
            ['external_created_at', 'external_updated_at'],
            ['created_at', 'updated_at'],
            $column
        );
    }
}
