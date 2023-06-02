<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class Orders extends Component
{

    public function render()
    {
        return view('livewire.orders', [
            'orders' => Order::paginate(10),
        ]);
    }

    public function createOrder()
    {
        return view('orders.create');
    }
}
