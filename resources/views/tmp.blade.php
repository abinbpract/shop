// $purchase=Transaction::where(function($query)use($request)
        // {
        //     if($request->product_category_id)
        //         $query->where('product_category_id',$request->product_category_id && 'type','purchase')->sum('amount');
        //     if($request->product_id)
        //         $query->where('product_id',$request->product_id && 'type','purchase')->sum('amount');
        // })->with('transactions')->get();

        // $sale=Transaction::where(function($query)use($request)
        // {
        //     if($request->product_category_id)
        //         $query->where('product_category_id',$request->product_category_id && 'type','sale')->sum('amount');
        //     if($request->product_id)
        //         $query->where('product_id',$request->product_id && 'type','sale')->sum('amount');
        // })->with('transactions')->get();