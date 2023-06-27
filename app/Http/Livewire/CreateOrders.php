<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewOrderRequest;
use App\Models\Customer;
use App\Models\OrderItems;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrders extends Component
{
    // protected $endpoint = 'https://portal.nepalcanmove.com/api/v1/branches';

    public $models;
    public $selected_item;
    public $branches;
    public $customer = "new";
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


    protected $listeners = [
        'selected_select2_item'
    ];

    public $orderCreated = "";

    public function hydrate()  // hydrate the select2 element on every re-render
    {
        $this->emit('select2');
        // $this->emit('products');
    }

    public function mount()
    {
        $this->models = Order::all();
        $this->userId = Auth::user()->id;
        $this->products = Product::search($this->search_items)->get();
        foreach ($this->products as $product) {
            $this->quantity[$product->id] = 1;
        }
    }

    public $form = [
        'user_id' => '',
        'name' => '',
        'email' => '',
        'address' => '',
        'phone' => '',
        'alt-phone' => null,
        'location' => '',
        'order_status' => 'pending',
        'delivery_status' => 'pending'
    ];
    public function selected_select2_item($value)  // function load from listener
    {
        $this->form['location'] = $value;
    }

    protected $rules = [
        'form.user_id' => ['integer', 'min:3'],
        'form.name' => ['required', 'string', 'min:3'],
        'form.address' => ['required'],
        'form.email' => ['required', 'email'],
        'form.phone' => ['required', 'digits:10'],
        'form.alt-phone' => ['digits:10', 'nullable'],
        'form.location' => ['required'],
        'form.delivery_status' => [''],
        'form.order_status' => [''],
    ];

    protected $messages = [
        'form.name.required' => 'Customer name is required.',
        'form.location.required' => 'Location field is required.',
    ];

    protected $validationAttributes = [
        'form.name' => 'customer name',
        'form.email' => 'customer email',
        'form.address' => 'address',
        'form.phone' => 'phone number',
        'form.alt-phone' => 'alternative phone number',
        'form.location' => 'inside or outside valley',
    ];


    public function newCustomer()
    {
        $this->customer = 'new';
    }

    public function existingCustomer()
    {
        $this->customer = 'existing';
    }

    public function submit()
    {
        $formFields = $this->validate();
        $formFields['form']['user_id'] = $this->userId;
        $formFields['form']['fullName'] = $formFields['form']['name'];
        $existingCustomer = Customer::where('email', $formFields['form']['email'])->get();


        if ($existingCustomer->count() < 1) {
            Customer::create($formFields['form']);
            $formFields['form']['discount'] = $this->discount;
            $formFields['form']['advance'] = $this->adv;
            $formFields['form']['total_price'] = $this->grandTotal;
            $formFields['form']['gateway'] = $this->gateway;
            $formFields['form']['payment_status'] = $this->payment_status;
            $formFields['form']['note'] = $this->note;
            Order::create($formFields['form']);
            $latest_order = Order::orderBy('id', 'desc')->first();
            foreach($this->cart as $item) {
                OrderItems::create([
                    'order_id' => $latest_order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'] * $item['qty']
                ]);
            }
        } else {
            $formFields['form']['discount'] = $this->discount;
            $formFields['form']['advance'] = $this->adv;
            $formFields['form']['total_price'] = $this->grandTotal;
            $formFields['form']['gateway'] = $this->gateway;
            $formFields['form']['payment_status'] = $this->payment_status;
            $formFields['form']['note'] = $this->note;
            Order::create($formFields['form']);
            $latest_order = Order::orderBy('id', 'desc')->first();
            foreach($this->cart as $item) {
                OrderItems::create([
                    'order_id' => $latest_order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'] * $item['qty']
                ]);
            }
        }
            Cart::destroy();

        return redirect(route('orders.index'))->with('success', 'Order created successfully');
    }

    public function addNewItem($product_id)
    {
        $product = Product::findOrFail($product_id);
        Cart::add(
            $product->id,
            $product->name,
            1,
            $product->price,
        );
        $this->search_items = "";
    }

    public function clearCart() {
        Cart::destroy();
        $this->search_items = "";
    }

    public function increament($rowId)
    {
        $cart = Cart::get($rowId);
        $newQty = $cart->qty + 1;
        Cart::update($rowId, $newQty);
    }

    public function decreament($rowId)
    {
        $cart = Cart::get($rowId);
        if ($cart->qty != 1) {
            $newQty = $cart->qty - 1;
            Cart::update($rowId, $newQty);
        } else {
            return;
        }
    }

    public function render()
    {
        // Cart::destroy();
        if ($this->discount == "") {
            $this->discount = 0;
        }
        if ($this->adv == "") {
            $this->adv = 0;
        }
        $this->products = Product::search($this->search_items)->get();
        $this->cart = Cart::content();
        foreach ($this->cart as $item) {
            $this->quantity[$item->id] = $item->qty;
        }
        if ($this->form['location'] == 'inside') {
            $this->deliveryRate = 100;
        } elseif ($this->form['location'] == 'outside') {
            $this->deliveryRate = 150;
        }
        $this->subtotal = Cart::subtotal();
        $this->total = $this->subtotal - $this->discount + $this->deliveryRate;
        $this->grandTotal = $this->total - $this->adv;
        if($this->adv != 0){
            $diff = $this->total - $this->adv;
            if($diff != 0){
                $this->payment_status = "partially paid";
            } else {
                $this->payment_status = "paid";
            }
        } else {
            $this->payment_status = "pending";
        }
        // dd($this->cart);
        return view('livewire.create-orders');
    }

    public function removeItem($rowId) {
        Cart::remove($rowId);
    }
}
