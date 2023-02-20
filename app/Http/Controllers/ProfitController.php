<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        // dd($request->all());
        $productcategories=ProductCategory::all();

        $purchase=Transaction::where(function($query)use($request)
        {
            if($request->product_category_id)
                $query->where('product_category_id',$request->product_category_id);
            if($request->product_id)
                $query->where('product_id',$request->product_id);
        })->where('type','purchase')->sum('amount');

        $sale=Transaction::where(function($query)use($request)
        {
            if($request->product_category_id)
                $query->where('product_category_id',$request->product_category_id);
            if($request->product_id)
                $query->where('product_id',$request->product_id);
        })->where('type','sale')->sum('amount');

        // $purchase=Transaction::where('type','purchase')->sum('amount');
        // $sale=Transaction::where('type','sale')->sum('amount');
        // return $purchase;
        // return $sale;
        return view('profit.index',compact(['productcategories','purchase','sale']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
    public function fetchProduct(Request $request)
    {
        $data['products']=Product::where("product_category_id",$request->product_category_id)->get(['id','name']);
        return response()->json($data);
    }
    // public function fetchRate(Request $request)
    // {
    //         $data['prices']=Product::where("id",$request->product_id)->first();
    //         return response()->json($data);
        
    // }
}
