<?php

namespace App\Models\Traits;

trait UseHelloFreshIdTrait
{
    /**
     * Initialize the trait.
     */
    protected function initializeUseHelloFreshIdTrait(): void
    {
        $this->incrementing = false;
        $this->mergeFillable(['id']);
        $this->mergeCasts(['id' => 'string']);
    }
}
