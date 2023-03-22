<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Category ListPage
    public function listPage(){

        $key = request('searchKey');

        $categories = Category::when($key,function($query){

            $key = request('searchKey');

            $query->where('name','like','%'. $key .'%');

        })->orderBy('created_at','desc')->paginate(4);

        $categories->appends(request()->query());

        return view('admin.category.categoryList',compact('categories'));
    }

    // Category createPage
    public function createPage(){
        return view('admin.category.categoryCreate');
    }

    // Category Create
    public function create(Request $request){
        $this->checkCategoryValidation($request);
        $data = $this->createCategoryData($request);
        Category::create($data);

        return redirect()->route('category#listPage');
    }

    // Category EditPage
    public function editPage($id){
        $categories = Category::where('id',$id)->get();
        return view('admin.category.categoryEdit',compact('categories'));
    }

    // Category Update
    public function update(Request $request){
        $this->checkCategoryValidation($request);
        $data = $this->createCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#listPage');
    }

    // Category Delete
    public function delete($id){
        Category::find($id)->delete();
        return redirect()->route('category#listPage');
    }

    // Check Category Validation
    private function checkCategoryValidation($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    // Category Data
    private function createCategoryData($request){
        return[
            'name'=>$request->categoryName
        ];
    }
}
