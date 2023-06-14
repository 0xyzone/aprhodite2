<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewOrderRequest;
use App\Models\Customer;

class CreateOrders extends Component
{
    // protected $endpoint = 'https://portal.nepalcanmove.com/api/v1/branches';

    public $models;
    public $selected_item;
    public $branches;
    public $customer = "new";
    public $orderStatus;
    public $userId;
    protected $listeners = ['selected_select2_item'];

    public function hydrate()  // hydrate the select2 element on every re-render
    {
        $this->emit('select2');
    }

    public function mount()
    {
        $this->models = Order::all();
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
        'order_status' => '',
        'delivery_status' => ''
    ];

    protected $rules = [
        'form.user_id' => ['integer', 'min:3'],
        'form.name' => ['required', 'string', 'min:3'],
        'form.address' => ['required'],
        'form.email' => ['required', 'email'],
        'form.phone' => ['required', 'digits:10'],
        'form.alt-phone' => ['digits:10', 'nullable'],
        'form.location' => ['required']
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

    public function selected_select2_item($value)  // function load from listener
    {
        $this->form['location'] = $value;
    }

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

        Order::create($formFields['form']);
        Customer::create($formFields['form']);
        
        return back();
    }

    public function render()
    {
        return view('livewire.create-orders');
    }

}
