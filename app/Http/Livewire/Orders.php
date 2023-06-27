<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use PHPUnit\Framework\TestStatus\Success;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class Orders extends Component
{
    
    public $search;
    public array $updated = [];
    public $orders;
    public array $order_status = [];

    public function mount() {
        if($this->search){
            $this->orders = Order::search($this->search)->get();
            foreach($this->orders as $order){
                $this->order_status[$order->id] = $order->order_status;
            }
        } else {
            $this->orders = Order::all();
            foreach($this->orders as $order){
                $this->order_status[$order->id] = $order->order_status;
            }
        }
    }

    public function changeStatus($id) {
        
        $order = Order::findOrFail($id);
        // $this->order_status[$id] = $order->order_status;
        // dd($this->order_status);
        $order->update([
            'order_status' => $this->order_status[$id]
        ]);
        $this->updated[$id] = $id;
    }

    public function render()
    {
        if($this->search){
            $this->orders = Order::search($this->search)->get();
        } else {
            $this->orders = Order::all();
        }
        return view('livewire.orders');
    }

    public function createOrder()
    {
        return view('orders.create');
    }
}
