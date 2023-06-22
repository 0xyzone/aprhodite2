<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class Orders extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.orders', [
            'orders' => Order::where('phone', 'like', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate(5),
        ]);
    }

    public function createOrder()
    {
        return view('orders.create');
    }
}
