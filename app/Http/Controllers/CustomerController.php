<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $customers = Customer::with('department')->get()->toArray();

        return array_reverse($customers);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return response()->json(Department::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gsm_no' => 'required',
            'department_id' => 'required',
            'birthday' => 'required'
        ]);

//        Customer::create($request->all());

        $customer = new Customer($request->all());

        $customer->save();

        return response()->json('New Customer Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return Response
     */
    public function show($id)
    {

        $customer = Customer::find($id);
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function weather()
    {
//        $weatherInfo = Http::get('https://api.openweathermap.org/data/2.5/weather?q=London&appid=375b5b72defecfdfccfa090d50f49db4');
        $url = 'https://api.openweathermap.org/data/2.5/onecall?lat=51.5085&lon=-0.1257&exclude=current,minutely,hourly,alerts&units=metric&appid=1b65d69c6ed3ad3011c9c80219aa4222';
        $weatherInfo = Http::get($url);

        return $weatherInfo->json();
    }
}
