<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    // Get Products Data
    public function productList(Request $request){
        $products = Product::get();
        $users = Product::get();

        $data = [
            "products" => $products,
            "users" => $users
        ];

        return response()->json($data, 200);
    }

    // Create Data
    public function createData(Request $request){
        Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'Create Success'
        ], 200);
    }

    // Delete Data by Post Method
    public function deleteDataPost(Request $request){
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            Category::where('id',$request->id)->delete();
            return response()->json([
                'status' => 'Delete Success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'Id not find'
            ], 500);
        }
    }
    // Delete Data by Get Method
    public function deleteDataGet($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json([
                'status' => 'Delete Success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'Id not find'
            ], 500);
        }
    }

    // Update Data
    public function updateData(Request $request){
        $data = Category::where('id',$request->id)->first();

        if(isset($data)){
            Category::where('id',$request->id)->update([
                'name' => $request->name
            ]);
            return response()->json([
                'status' => 'Update Success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'Id not find'
            ], 500);
        }
    }
}
