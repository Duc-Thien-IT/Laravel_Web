<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Laravel\Ui\Presets\React;

use function Pest\Laravel\delete;

class AdminController extends Controller
{
    //Page Category and show category
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    //Add Category
    public function add_category(Request $request){
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        
        //flash()->success('Category add successfully.');
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category added successfully');
        return redirect()->back();
    }

    //Delete Category
    public function delete_category($id){
        $data = Category::find($id);
        $data -> delete();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category delete successfully');
        return redirect()->back();
    }

    //Turn page edit
    public function edit_category($id){
        $data = Category::find($id);

        return view('admin.edit_category', compact('data'));
    }

    //Update category
    public function update_category(Request $request ,$id){
        $data = Category::find($id);
        $data -> category_name = $request->category;
        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category update successfully');
        return redirect('/view_category');
    }

    //Manage product
    //add product
    public function add_product(){
        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }

    //upload product
    public function upload_product(Request $request){
        $data = new Product();
        $data -> title = $request->title;
        $data -> description = $request->description;
        $data -> price = $request->price;
        $data -> quantity = $request->quantity;
        $data -> category = $request->category;
        $data -> title = $request->title;

        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back();
    }

    //View product
    public function view_product(){
        //$product = Product::all();
        //Pagination
        $product = Product::paginate(3);
        return view('admin.view_product', compact('product'));
    }

    //delete product
    public function delete_product($id){
        $data = Product::find($id);

        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        $data -> delete();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category delete successfully');
        return redirect()->back();
    }

    //Turn page edit product
    public function edit_product($id){
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.edit_product', compact('data','category'));
    }

    //update product
    public function update_product(Request $request, $id){
        $data = Product::find($id);
        $data -> title = $request->title;
        $data -> description = $request->description;
        $data -> price = $request->price;
        $data -> quantity = $request->quantity;
        $data -> category = $request->category;
        $data -> title = $request->title;

        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }

        $data->save();


        toastr()->timeOut(10000)->closeButton()->addSuccess('Category update successfully');
        return redirect('/view_product');        
    }

    public function product_search(Request $request){
        $search = $request->search;

        $product = Product::where('title', 'LIKE', '%'.$search.'%')->paginate(3);
        return view('admin.view_product', compact('product'));
    }

}
