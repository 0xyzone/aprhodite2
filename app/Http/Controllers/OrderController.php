<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\NewOrderRequest;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $endpoint = 'http://portal.nepalcanmove.com/api/v1/branches';
        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('GET', $endpoint);
        // $content = json_decode($response->getBody(), true);
        // $branches = $content;
        
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewOrderRequest $request)
    {
        $formFields = $request->validated();
        dd($formFields);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully');
    }
}
