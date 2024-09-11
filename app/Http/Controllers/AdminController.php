<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;

use function Pest\Laravel\delete;

class AdminController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $userRepository;
    
    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    //Page Category and show category
    public function view_category()
    {
        //$data = Category::all();
        $data = $this->categoryRepository->all();
        return view('admin.category', compact('data'));
    }

    //Add Category
    public function add_category(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $data = [
            'category_name' => $request->category,
        ];

        $this->categoryRepository->create($data);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category added successfully');
        return redirect()->back();
    }


    // //Delete Category
    public function delete_category($id){
        $this->categoryRepository->delete($id);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category delete successfully');
        return redirect()->back();
    }

    // //Turn page edit
    public function edit_category($id){
        $data = $this->categoryRepository->find($id);

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
        //$category = Category::all();
        $category = $this->productRepository->all();
        return view('admin.add_product', compact('category'));
    }

    //upload product
    public function upload_product(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category, 
        ];

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data['image'] = $imagename;
        }

        $this->productRepository->create($data);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product added successfully');
        return redirect()->back();
    }

    //View product
    public function view_product(){
        //$product = Product::all();
        //Pagination
        //$product = Product::paginate(3);
        $product = $this->productRepository->paginate(3);
        return view('admin.view_product', compact('product'));
    }

    //delete product
    public function delete_product($id)
    {
        $product = $this->productRepository->find($id);
        if ($product->image) {
            $image_path = public_path('products/' . $product->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $this->productRepository->delete($id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category delete successfully');
        return redirect()->back();
    }

    //Turn page edit product
    public function edit_product($id){
        $data = $this->productRepository->find($id);
        $category = $this->categoryRepository->all();
        return view('admin.edit_product', compact('data', 'category'));
    }

    //update product
    public function update_product(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category,
        ];

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data['image'] = $imagename;

            // Remove old image
            $oldProduct = $this->productRepository->find($id);
            if ($oldProduct->image) {
                $oldImagePath = public_path('products/' . $oldProduct->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $this->productRepository->update($data, $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category update successfully');
        return redirect('/view_product');        
    }

    public function product_search(Request $request){
        // $search = $request->search;

        // $product = Product::where('title', 'LIKE', '%'.$search.'%')->paginate(3);
        $search = $request->search;
        $product = $this->productRepository->search('title', $search, 3);
        return view('admin.view_product', compact('product'));
    }   


    //CRUD User
    public function addUser() {
        $user = $this->userRepository->all();
        return view('admin.add_user', compact('user'));
    }

    public function uploadUser(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'userType' => 'required|string',
            'phone' => 'required|integer',
            'address' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'userType' => $request->userType,
            'phone' => $request->phone,
            'address' => $request->address, 
        ];

        $this->userRepository->create($data);

        toastr()->timeOut(10000)->closeButton()->addSuccess('User added successfully');
        return redirect()->back();
    }

    public function viewUser() {
        $user = $this->userRepository->paginate(3);
        return view('admin.user', compact('user'));
    }

    //delete product
    public function delete_user($id)
    {
        $user = $this->userRepository->find($id);
        
        $this->userRepository->delete($id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('User delete successfully');
        return redirect()->back();
    }

    //Turn page edit product
    public function edit_user($id){
        $data = $this->userRepository->find($id);
        return view('admin.edit_user', compact('data'));
    }

    //update product
    public function update_user(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'userType' => 'required|string',
            'phone' => 'required|integer',
            'address' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'userType' => $request->userType,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $this->userRepository->update($data, $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('User update successfully');
        return redirect('/user');        
    }

    public function user_search(Request $request){
        // $search = $request->search;

        // $product = Product::where('title', 'LIKE', '%'.$search.'%')->paginate(3);
        $search = $request->search;
        $user = $this->userRepository->search('name', $search, 3);
        return view('admin.user', compact('user'));
    }  
}
