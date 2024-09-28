<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(Request $request){
        $categories = Category::with('parent')->paginate(10);
       
        return view('seller/categories',compact('categories'));
    }

    public function fetchCategories(Request $request,$id = null){
       
        $res = ($id === null) ? Category::get() : Category::find($id);
        
        return response()->json($res);
        
    }

    public function addCategory(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;

        if($request->has('parent_id')){
            $category->parent_id = $request->parent_id;
        }

        $res = $category->save();

        if($res) return redirect()->back()->with('success','Category Added Successfully!!');
        else return redirect()->back()->with('error','Category Not Added!!');

    }

    public function getCategoryById(Request $request,$id){

        $catagory = Category::find($id);

        return response()->json($catagory);

    }

    public function update(Request $request, $id){

        $category = Category::find($id);

        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);

        $category->name = $request->name;
        $category->description = $request->description;

        if($request->has('parent_id')){
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->back()->with('success',"Category Updated Successfully !!");
    }

    public function delete(Request $request,$id){

        $res = Category::where('id',$id)->delete();

        if($res) return redirect()->back()->with('success',"Category Deleted Successfully");
        else return redirect()->back()->with('error',"Category Deletion Failed");

    }
}
