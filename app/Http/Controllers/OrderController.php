<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //User OrderList Page
    public function userOrderListPage(){
        $userOrderList = Order::select('orders.*','users.name as user_name')
                                ->leftJoin('users','users.id','orders.user_id')
                                ->orderBy('created_at','desc')
                                ->paginate(6);

        $userOrderList->appends(request()->query());

        return view('admin.order.userOrderListPage',compact('userOrderList'));
    }

    // User OrderList Details and Manage Page
    public function userOrderListDetails_ManagePage($Id,$OrderCode){

        $orderInfoData = Order::select('orders.*','users.name as user_name','users.address as user_address','users.phone as user_phone')
                                ->leftJoin('users','users.id','orders.user_id')
                                ->where('orders.id',$Id)->first();

        $orderProducts = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image')
                                    ->leftJoin('products','products.id','order_lists.product_id')
                                    ->where('order_lists.order_code',$OrderCode)
                                    ->get();

        return view('admin.order.userOrderListDetails_ManagePage',compact('orderInfoData','orderProducts'));
    }

    // Manage Order Status
    public function manageOrderStatus(Request $request){
        $data =$this->getManageOrderStatus($request);
        Order::where('order_code',$request->orderCode)->update($data);
        return redirect()->route('order#userOrderListPage');
    }

    //Filter userOrder Status
    public function filterUserOrderStatus(){
        $key = request('filterStatus');

        $userOrderList = Order::select('orders.*','users.name as user_name')
                                ->leftJoin('users','users.id','orders.user_id')
                                ->orderBy('created_at','desc');

                                if(request('filterStatus') == null){
                                    $userOrderList = $userOrderList->paginate(6);
                                }else{
                                    $userOrderList = $userOrderList->where('status',$key)->paginate(6);
                                }

        $userOrderList->appends(request()->query());

        return view('admin.order.userOrderListPage',compact('userOrderList'));
    }

    // Get Manage Order Status Data
    private function getManageOrderStatus($request){
        return [
            'status' => $request->manageStatus
        ];
    }
}
