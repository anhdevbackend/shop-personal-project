<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class userOrderController extends Controller
{
    //Order History Page Page
    public function OrderHistoryPage(){
        $myOrderList = Order::where('user_id',Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->paginate(6);

        $myOrderList->appends(request()->query());

        return view('user.order.OrderHistoryPage',compact('myOrderList'));
    }

    // User Order Product History List Page
    public function OrderProductHistoryListPage($OrderCode){
        $orderProducts = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image')
                                    ->leftJoin('products','products.id','order_lists.product_id')
                                    ->where('order_lists.order_code',$OrderCode)
                                    ->paginate(5);

        $orderProducts->appends(request()->query());

        return view('user.order.OrderProductHistoryListPage',compact('orderProducts'));
    }
}
