<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userProductController extends Controller
{
    // Products View Page
    public function userProductsViewPage($productId){

        $productData = Product::where('id',$productId)->first();

        $productList = Product::orderBy('products.created_at','desc')->get();

        $productReviews = Review::select('reviews.*','users.name as userName','users.image as userImage')
                            ->leftJoin('users','reviews.user_id','users.id')
                            ->where('reviews.product_id',$productId)
                            ->orderBy('reviews.created_at','desc')
                            ->paginate(4);

        $productReviews->appends(request()->query());

        return view('user.products.productsViewPage',compact('productData','productList','productReviews'));
    }

    //CartList Page
    public function userProductsCartListPage(Request $request){

        $cartList = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->orderBy('carts.created_at','desc')
                    ->get();

        // Cartdata များမရှိတော့လျှင် Final Total Price =0 ဖြစ်ရန်
        $cartDataCount = Cart::where('user_id',Auth::user()->id)->get();

        $totalPrice = 0;

        foreach($cartList as $list){
            $totalPrice += $list->product_price*$list->qty;
        }

        return view('user.products.productsCartList',compact('cartList','totalPrice','cartDataCount'));
    }

    //Cart Data Clear
    public function userProductsCartDataClear($id){

        $cartData = Cart::where('id',$id)->delete();

        $cartList = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->orderBy('carts.created_at','desc')
                    ->get();

        // Cartdata များမရှိတော့လျှင် Final Total Price =0 ဖြစ်ရန်
        $cartDataCount = Cart::where('user_id',Auth::user()->id)->get();

        $totalPrice = 0;

        foreach($cartList as $list){
            $totalPrice += $list->product_price*$list->qty;
        }

        return view('user.products.productsCartList',compact('cartList','totalPrice','cartDataCount'));
    }

    //Product Reviews
    public function productReviews(Request $request){
        $this->ValidationForProductReviews($request);
        $data = $this->createProductReviewsData($request);

        Review::create($data);

        return back();
    }

    // Validation For Product Reviews
    private function ValidationForProductReviews($request){
        Validator::make($request->all(),[
            'review' => 'required|min:5|max:200'
        ])->validate();
    }

    // Create Product Reviews Data
    private function createProductReviewsData($request){
        return[
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'reviews' => $request->review
        ];
    }
}
