<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDropdown extends Component
{
    public $vals = '';
 
    public $values;

    public function mount() {
        $this->values = Product::all();
    }

    public function render()
    {
        return view('livewire.product-dropdown')->layout('layouts.app');
    }
}
