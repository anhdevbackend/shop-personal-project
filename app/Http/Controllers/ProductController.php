<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Storage;

class ProductController extends Controller
{
    // Products List Page
    public function productsListPage(){

        $key = request('searchKey');

        $products = Product::when($key,function($query){

                        $key = request('searchKey');

                        $query->where('products.name','like','%' . $key .'%');

                    })
                    ->select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.created_at','desc')
                    ->paginate(3);

        $products->appends(request()->query());

        return view('admin.products.productsListPage',compact('products'));
    }

    // Products Create Page
    public function productsCreatePage(){
        $categories = Category::orderBy('created_at','desc')->get();
        return view('admin.products.productsCreatePage',compact('categories'));
    }

    // Products Create
    public function productsCreate(Request $request){

        $this->ValidationForProductCreating($request);
        $productData = $this->createProductData($request);

        $imageName = uniqid() . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public',$imageName);
        $productData['image'] = $imageName;

        Product::create($productData);
        return redirect()->route('products#productsListPage');
    }

    // Products Delete
    public function delete(Request $request){
        // Delete image in project
        $imageName = Product::select('image')->where('id',$request->id)->get()->toArray();
        $imageName = $imageName[0]['image'];

        if($imageName != null){
            Storage::delete('public/'. $imageName);
        }

        // Delete in database
        Product::where('id',$request->id)->delete();
        return redirect()->route('products#productsListPage');
    }

      // Products View Page
      public function productsViewPage(Request $request){
        $productData = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$request->id)->get();
        return view('admin.products.productsViewPage',compact('productData'));
    }

      // Products Edit Page
      public function productsEditPage(Request $request,$id){
        $productData = Product::where('id',$request->id)->get();
        $categoriesData = Category::orderBy('created_at','desc')->get();
        $ThisProductCategoryId = Product::select('category_id')->where('id',$id)->first();
        // dd($ThisProductCategoryId->category_id);
        return view('admin.products.productsEditPage',compact('productData','categoriesData','ThisProductCategoryId'));
    }

    // Products Update
    public function productsUpdate(Request $request){

        $this->ValidationForProductCreating($request);
        $productData = $this->createProductData($request);

        if($request->hasfile('productImage')){

            $oldImageName = Product::select('image')->where('id',$request->productId)->get()->toArray();
            $oldImageName = $oldImageName[0]['image'];

            if($oldImageName != null){
                Storage::delete('public/'. $oldImageName);
            }

            $newImageName =uniqid() .  $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$newImageName);
            $productData['image'] = $newImageName;
            Product::where('id',$request->productId)->update($productData);
        }else{
            Product::where('id',$request->productId)->update([
                'category_id' => $request->categoryForProducts,
                'name' => $request->productName,
                'description' => $request->productDescription,
                'price' => $request->productPrice
            ]);
        }
        return redirect()->route('products#productsListPage');
    }

    // Validation For ProductCreating
    private function ValidationForProductCreating($request){
        Validator::make($request->all(),[
            'productImage' => 'mimes:jpeg,jpg,webp,png',
            'productName' => 'required',
            'productDescription' => 'required|min:10',
            'productPrice' => 'required',
            // 'selectValidation' => 'required'
        ])->validate();
    }

    // Create Product Data
    private function createProductData($request){
        return[
            'category_id' => $request->categoryForProducts,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'image' => $request->productImage,
            'price' => $request->productPrice
        ];
    }
}
