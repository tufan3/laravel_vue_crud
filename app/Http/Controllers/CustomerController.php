<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        // $customer = Customer::all();
        // return view('customer.index', compact('customers'));

        $customer = DB::table('customers')
                ->leftJoin('transactions', 'customers.id', '=', 'transactions.customer_id')
                ->select('customers.id', 'customers.full_name', 'customers.age', 'customers.email', 'customers.phone',
                DB::raw('COALESCE(SUM(transactions.amount), 0) as total_amount'),
                DB::raw('MAX(transactions.created) as last_transaction_date'),
                )
                ->groupBy('customers.id', 'customers.full_name', 'customers.age', 'customers.email', 'customers.phone')
                ->get();

        return response()->json(['message'=>'All customer list','customers'=>$customer],200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|min:11|max:11',
        ]);

        $customer = new Customer();
        $customer->full_name = $request->full_name;
        $customer->age = $request->age;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();
        return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 200);
    }
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json(['message' => 'Customer found', 'customer' => $customer], 200);
    }

    //--update--//
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|min:11|max:11',
        ]);

        $customer = Customer::find($id);
        $customer->full_name = $request->full_name;
        $customer->age = $request->age;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();
        return response()->json(['message' => 'Customer updated successfully', 'customer' => $customer], 200);
    }


    //--delete--//
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }



    //--- transaction create---//
    public function createTransaction($id)
    {
        return response()->json(['message'=>'Customer list by id','customer_id'=>$id],200);

    }
    //--- transaction create---//

    //--- transaction store---//
    public function storeTransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'invoice_no' => 'required|string',
            'created' => 'required|date',
        ]);

        $transaction = new Transaction();
        $transaction->customer_id = $request->customer_id;
        $transaction->amount = $request->amount;
        $transaction->invoice_no = $request->invoice_no;
        $transaction->created = $request->created;
        $transaction->save();
        return response()->json(['message' => 'Transaction created successfully', 'transaction' => $transaction], 200);
    }
    //--- transaction store---//
}
