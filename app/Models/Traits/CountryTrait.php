<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

trait CountryTrait
{
    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        $this->table = App::getCountryPrefix() . Str::snake(Str::pluralStudly(class_basename($this)));

        return $this->table;
    }

    /**
     * Get the table associated with the model and specific prefix.
     */
    public function getCountryTable(string $prefix): string
    {
        return $prefix . Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /**
     * Get the joining table name for a many-to-many relation.
     */
    public function joiningTable($related, $instance = null): string
    {
        return $this->getTable();
    }

    /**
     *  Get the first record matching the attributes. If the record is not found, create it.
     */
    public static function freshUpdateOrCreate(mixed $hfModel, string $primaryKey = 'id'): Model
    {
        /* @var \NormanHuth\HellofreshScraper\Models\AbstractModel $hfModel */
        $columns = (new static())->getFillable();
        $data = $hfModel->data();
        $columns = Arr::mapWithKeys($columns, fn (string $column) => [$column => data_get($data, Str::camel($column))]);

        // Todo: external_created_at, external_updated_at
        return static::firstOrCreate(
            ['external_id' => $columns[$primaryKey]],
            Arr::except($columns, $primaryKey)
        );
    }
}
