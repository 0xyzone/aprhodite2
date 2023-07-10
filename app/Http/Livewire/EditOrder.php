<?php

namespace App\Http\Livewire;

use App\Models\OrderItems;
use App\Models\Product;
use Livewire\Component;

class EditOrder extends Component
{
    public $order;
    public $location;
    public $orderId;
    public $orderItems;
    public $models;
    public $selected_item;
    public $branches;
    public $customer = "new";
    public $customers = "";
    public $orderStatus;
    public $userId;
    public $products = "";
    public $search_items = "";

    public array $quantity = [];

    public $cart;
    public $subtotal;
    public $discount;
    public $deliveryRate = 0;
    public $total;
    public $adv = 0;
    public $grandTotal;
    public $gateway = null;
    public $payment_status = "pending";
    public $note;
    public $searchCustomer;
    public $cus = "";
    public $customa = "";

    public array $form = [];

    // public function hydrate()  // hydrate the select2 element on every re-render
    // {
    //     $this->emit('select2');
    // }

    // public function selected_select2_item($value)  // function load from listener
    // {
    //     $this->form['location'] = $value;
    // }

    public function mount() {
        $this->form['name'] = $this->order->fullName;
        $this->form['address'] = $this->order->address;
        $this->form['email'] = $this->order->email;
        $this->form['phone'] = $this->order->phone;
        $this->form['alt-phone'] = $this->order['alt-phone'];
        $this->location = $this->order->location;
        $this->grandTotal = $this->order->total_price;
        $this->adv = $this->order->advance;
        $this->gateway = $this->order->gateway;
        $this->payment_status = $this->order->payment_status;
    }

    public function updateOrder() {
        $this->order['fullName'] = $this->form['name'];
        $this->order['address'] = $this->form['address'];
        $this->order['email'] = $this->form['email'];
        $this->order['phone'] = $this->form['phone'];
        $this->order['alt-phone'] = $this->form['alt-phone'];
        $this->order['location'] = $this->form['location'] ;
    }
    public function render()
    {
        $this->products = Product::search($this->search_items)->get();
        $this->orderId = $this->order['id'];
        $this->orderItems = $this->order->getItems;
        $this->grandTotal = $this->order->total_price;
        if($this->location == 'inside'){
            $this->deliveryRate = 100;
        } else {
            $this->deliveryRate = 150;
        }
        return view('livewire.edit-order');
    }
}
