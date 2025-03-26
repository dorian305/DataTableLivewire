<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DataTableComponent;
use Tests\TestCase;

class DataTableTest extends TestCase
{
    public function component_exists_on_the_page()
    {
        $this->get('/')->assertSeeLivewire(DataTableComponent::class);
    }
}