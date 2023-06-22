<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewOrderRequest;
use App\Models\Customer;
use App\Models\Product;

class CreateOrders extends Component
{
    // protected $endpoint = 'https://portal.nepalcanmove.com/api/v1/branches';

    public $models;
    public $selected_item;
    public $branches;
    public $customer = "new";
    public $orderStatus;
    public $userId;
    public $products;
    protected $listeners = ['selected_select2_item'];

    public $orderCreated = "";

    public function hydrate()  // hydrate the select2 element on every re-render
    {
        $this->emit('select2');
        $this->emit('products');
    }

    public function mount()
    {
        $this->models = Order::all();
        $this->products = Product::all();
        $this->userId = Auth::user()->id;
    }

    public $form = [
        'user_id' => '',
        'name' => '',
        'email' => '',
        'address' => '',
        'phone' => '',
        'alt-phone' => '',
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
        // dd($formFields);
        $existingCustomer = Customer::where('email', $formFields['form']['email'])->get();

        Order::create($formFields['form']);
        if($existingCustomer->count() < 1) {
            Customer::create($formFields['form']);
        }
        
        return redirect(route('orders.index'))->with('success', 'Order created successfully');
    }

    public function render()
    {
        return view('livewire.create-orders');
    }

}
