<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userMainController extends Controller
{
    //Home Page
    public function homePage(){
        $key = request('searchKey');

        $products = Product::when($key,function($query){

            $key = request('searchKey');

            $query->where('name','like','%' .$key. '%');

        })->orderBy('created_at','desc')->paginate(8);

        $products->appends(request()->query());

        $categories = Category::orderBy('created_at','desc')->get();
        $myCarts = Cart::where('user_id',Auth::user()->id)->get();
        $myOrderHistory = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('products','categories','myCarts','myOrderHistory'));
    }

    //Contact Page
    public function contactPage(){
        return view('user.main.contact');
    }

    // User Contact
    public function userContact(Request $request){

        $this->checkContactValidation($request);
        $data = $this->getContactData($request);
        Contact::create($data);

        return back()->with(['contactToast' => 'Sent your message! Thanks for feedback. . .']);
    }

    // Add to Cart
    public function addToCart($id){
        $product = Product::where('id',$id)->first();
        $productId = ($product->id);

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $productId,
            'qty'=> 1
        ]);
        return back();
    }

    // Check Contact Validation
    private function checkContactValidation($request){
        Validator::make($request->all(),[
            'userName'=>'required|max:100',
            'userEmail'=>'required',
            'userMessage'=>'required|min:10|max:500'
        ])->validate();
    }

    // Get Contact Data
    private function getContactData($request){
        return[
            'name'=>$request->userName,
            'email'=>$request->userEmail,
            'message'=>$request->userMessage
        ];
    }
}
