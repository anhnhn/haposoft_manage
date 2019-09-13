<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(Config('variables.paginate'));
        $data = [
            'customers' => $customers,
        ];
        return view('admin.customer.index', $data);
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(CustomerRequest $request)
    {
        $customer = $request->all();
        $customer['password'] = \Hash::make($request->password);
        Customer::create($customer);
        return redirect()->route('customers.index')->with('message', __('messages.create_message'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $data = [
            'customer' => $customer
        ];
        return view('admin.customer.show', $data);
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $data = [
            'customer' => $customer
        ];
        return view('admin.customer.update', $data);
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id)->delete();
        return redirect()->route('customers.index')->with('message', __('messages.delete_message'));
    }

    public function search(Request $request)
    {
        if($request->customer_name == null)
        {
            return redirect()->route('customers.index');
        }
        else
        {
            $customer_name = $request->customer_name;
            $customers = Customer::where('name', 'like', '%' . $customer_name . '%')->orderByDesc('id')->paginate(config('variables.paginate'));
            $data = [
                'customers' => $customers,
                'customerName' => $customer_name
            ];
            return view('admin.customer.index', $data);
        }
    }
}
