<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Customers extends Component
{
    public function render()
    {
        return view('livewire.customers', [
            'customers' => Customer::paginate(10)
        ]);
    }
}
