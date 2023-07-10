<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use PHPUnit\Framework\TestStatus\Success;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class Orders extends Component
{
    use WithPagination;
    public $search = "";
    public array $updated;
    protected $orders;
    public $orderBy = "desc";
    public array $order_status = [];
    public $orderStatus = null;
    public array $orderItems = [];
    public array $subTotal = [];
    public $paginate = 5;
    public $placedBy = null;
    public $users;
    public $userId = null;
    public array $bgColor = [
        'pending' => 'bg-yellow-500',
        'confirmed' => 'bg-sky-500',
        'ncm' => 'bg-red-500',
        'delivered' => 'bg-lime-500',
        'dispatched' => 'bg-gray-500',
        'canceled' => 'bg-rose-500',
    ];

    public function mount()
    {
        
    }

    public function changeStatus($id)
    {
        $arder = Order::findOrFail($id);
        // $this->order_status[$id] = $order->order_status;
        // dd($this->order_status);
        $arder->update([
            'order_status' => $this->order_status[$id]
        ]);
        // $this->updated[$id] = 1;
        // dd($this->updated);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        
        $this->users = User::all();
        // if ($this->search != "") {
        //     $orders = Order::when($this->orderStatus, function ($query) {
        //         $query->where('order_status', $this->orderStatus);
        //     })->when($this->userId, function ($query) {
        //         $query->where('user_id', $this->userId);
        //     })->orderBy('id', $this->orderBy)->search($this->search)->paginate(3);
        // } else {
        //     $orders = Order::when($this->orderStatus, function ($query) {
        //         $query->where('order_status', $this->orderStatus);
        //     })->when($this->userId, function ($query) {
        //         $query->where('user_id', $this->userId);
        //     })->orderBy('id', $this->orderBy)->paginate($this->paginate);
        // }
        $orders = Order::when($this->orderStatus, function ($query) {
            $query->where('order_status', $this->orderStatus);
        })->when($this->userId, function ($query) {
            $query->where('user_id', $this->userId);
        })->orderBy('id', $this->orderBy)->paginate($this->paginate);
        foreach ($orders as $order) {
            $this->order_status[$order->id] = $order->order_status;
            $this->orderItems[$order->id] = $order->getItems()->get();
        }
        return view('livewire.orders', compact('orders'));
    }

    public function createOrder()
    {
        return view('orders.create');
    }
}
