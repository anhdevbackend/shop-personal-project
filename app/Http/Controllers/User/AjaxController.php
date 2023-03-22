<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //Filter Category
    public function filterCategory(Request $request){
        if($request->value == 'all'){

            $data = Product::orderBy('created_at','desc')->get();

        }else{
            $data = Product::where('category_id',$request->value)->orderBy('created_at','desc')->get();
        }

        return $data;
    }

    //Product Sorting
    public function productsSortingList(Request $request){
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }

    //Add To Cart
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getAddToCartData($request);
        Cart::create($data);
        return [
            'status' => 'success'
        ];
    }

    // Proceed to Order
    public function proceedToOrder(Request $request){
        // logger($request->all());
        // Loop ပတ်ပြီးယူလာသောကြောင့်  Loopပတ်ပြီးတစ်ခါတည်းထည့်ရမည်
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['userId'],
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'total_price'  => $item['total'],
                'final_total_price' => $item['finalTotal'],
                'order_code' => $item['orderCode']
            ]);
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'final_total_price' => $data->final_total_price
        ]);

        return [
            'status' => 'true'
        ];
    }

    // Product View Count
    public function productViewCount(Request $request){
        Product::where('id',$request->productId)->update([
            'view_count' => $request->productViewCount + 1
        ]);
    }

    // getAddToCartData
    private function getAddToCartData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->countValue
        ];
    }

}
