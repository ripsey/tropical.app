<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Customer;
use App\Models\City;
use App\Models\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('firstname', 'asc')->get();
        return view('customer.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !empty($request->email);
                }),
                'regex:/^\S+@\S+\.\S+$/',
            ]
        ]);
        Log::create([
            'userId' => auth()->user()->id,
            'action' => 'Added ' . $request->firstname . ' ' . $request->lastname,
            'action_category' => 'Customer'
        ]);
        $customer = Customer::create($request->all());
        return redirect()->route('customer.show', $customer->id)
            ->with('success', 'Klant succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !empty($request->email);
                }),
                'regex:/^\S+@\S+\.\S+$/',
            ]
        ]);
        Log::create([
            'userId' => auth()->user()->id,
            'action' => 'Updated ' . $customer->firstname . ' ' . $customer->lastname,
            'action_category' => 'Customer'
        ]);
        $customer->update($request->all());
        return redirect()->route('customer.show', $customer->id)
            ->with('success', 'Klant succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Log::create([
            'userId' => auth()->user()->id,
            'action' => 'Deleted ' . $customer->firstname . ' ' . $customer->lastname,
            'action_category' => 'Customer'
        ]);
        $customer->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Klant succesvol verwijderd.');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($customer_id)
    {
        Log::create([
            'userId' => auth()->user()->id,
            'action' => 'Restored userId ' . $customer_id,
            'action_category' => 'Customer'
        ]);
        Customer::withTrashed()->find($customer_id)->restore();
        return redirect()->route('customer.show', $customer_id)
            ->with('success', 'Klant succesvol hersteld.');
    }

    /**
     * Search a city.
     *
     * @return \Illuminate\Http\Response
     */
    public function city($search)
    {
        $city = City::where('zipcode', $search)->first();
        return ($city) ? json_encode($city->up) : json_encode('');
    }

    /**
     * Search a zipcode.
     *
     * @return \Illuminate\Http\Response
     */
    public function zipcode($search)
    {
        $city = City::where('up', strtoupper($search))->first();
        return ($city) ? json_encode($city->zipcode) : json_encode('');
    }
}
