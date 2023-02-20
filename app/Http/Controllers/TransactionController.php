<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Party;
use Illuminate\Http\Request;
use App\Http\Requests\storeTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->type);
        if($request->type=='sale')
        $transactions=Transaction::where("type","sale")->get();
        else 
        $transactions=Transaction::where("type","purchase")->get();

        return view('transaction.index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->type=='sale')
        $parties=Party::where("type",'customer')->get();
        else
        $parties=Party::where("type",'vendor')->get();

        $productcategories=ProductCategory::all();
        return view("transaction.create",compact(['productcategories','parties']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeTransactionRequest $request)
    {
        // dd($request->all());
        Transaction::create($request->all());
        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $productcategories=ProductCategory::all();
        $products=Product::where("product_category_id",'=',$transaction->product_category_id)->get();
        $parties=Party::all();
        return view('transaction.edit',compact(['productcategories','transaction','products','parties']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // dd($request->all());
        $type=$request->type;
        $transaction->update($request->only(['product_category_id','product_id','party_id','user_id','rate','quantity','amount','type']));
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }

    public function fetchProduct(Request $request)
    {
        $data['products']=Product::where("product_category_id",$request->product_category_id)->get(['id','name']);
        return response()->json($data);
    }
    public function fetchRate(Request $request)
    {
            $data['prices']=Product::where("id",$request->product_id)->first();
            return response()->json($data);
        
    }
}
