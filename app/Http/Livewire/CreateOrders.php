<?php

namespace App\Http\Livewire;

use App\Http\Requests\NewOrderRequest;
use Livewire\Component;

class CreateOrders extends Component
{
    // protected $endpoint = 'https://portal.nepalcanmove.com/api/v1/branches';

    public $branches;
    public $customer = "new";
    public $form = [
        'name' => '',
        'email' => '',
        'address' => '',
        'phone' => '',
        'alt-phone' => '',
        'location' => ''
    ];

    public function newCustomer()
    {
        $this->customer = 'new';
    }

    public function existingCustomer()
    {
        $this->customer = 'existing';
    }

    public function submit(NewOrderRequest $requeest)
    {
        $formFields = $this->request->validateed();

        dd($formFields);

    }

    public function render()
    {
        return view('livewire.create-orders');
    }
}
