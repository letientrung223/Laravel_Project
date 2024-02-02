<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProduct()
    {
        $categories = Category::all()->toArray();
        $brands = Brand::all();

        return view('frontend.product.add-product',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertProduct(Request $request)
{
    $images = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $name = $image->getClientOriginalName();
            $name_2 = "2" . $image->getClientOriginalName();
            $name_3 = "3" . $image->getClientOriginalName();

            $path = public_path('upload/product/' . $name);
            $path2 = public_path('upload/product/' . $name_2);
            $path3 = public_path('upload/product/' . $name_3);

            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(50, 70)->save($path2);
            Image::make($image->getRealPath())->resize(200, 300)->save($path3);

            $images[] = $name;
        }
    }

    // $product= new Product();
    $data = $request->all();
    $data['id_user']= Auth::id();
    $data['images']=json_encode($images);
    $data['sale']= ($data['status']==0)?0:$request->sale;
    // dd($data);
    Product::create($data);
    // $product->save();


    

    // Redirect to the product list page
    return redirect()->route('showMyProduct');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProduct($id)
    {
        $categories = Category::all()->toArray();
        $brands = Brand::all();
        $product = Product::find($id);
        // dd($product);
        $product->images = json_decode($product->images, true);
        return view('frontend.product.edit-product',compact('product','categories','brands'));


    }
    public function updateProduct(Request $request, $id)
    {
    $oldImage = Product::find($id)->images; 
    $oldImage=  json_decode($oldImage, true);
    // print_r("Arr cũ ");
    // print_r($oldImage);   
    $selectedImgs = $request->input('selected_images', []);
    $newImages = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $name = $image->getClientOriginalName();
            $name_2 = "2" . $image->getClientOriginalName();
            $name_3 = "3" . $image->getClientOriginalName();

            $path = public_path('upload/product/' . $name);
            $path2 = public_path('upload/product/' . $name_2);
            $path3 = public_path('upload/product/' . $name_3);

            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(50, 70)->save($path2);
            Image::make($image->getRealPath())->resize(200, 300)->save($path3);

            $newImages[] = $name;
        }
    }
    foreach ($selectedImgs as $selectedImg) {
        $index = array_search($selectedImg, $oldImage);
        if ($index !== false) {
            unset($oldImage[$index]);
        }
    }

    // Reset keys after unset
    $oldImage = array_values($oldImage);

    // print_r("Arr mới ");
    // print_r($newImages);
    // print_r("Arr dc check ");
    // print_r($selectedImgs);
    // print_r("Arr da xoa ");
    // print_r($oldImage);
    // print_r($id);
$totalImages = count($oldImage) + count($newImages);

    if ($totalImages > 3) {
        return redirect()->back()->withErrors(['error' => 'Total images exceed the limit of 3.']);
    }else {
         $oldImage = array_merge($oldImage, $newImages);
        $data = $request->except('_token');
        $data['id_user']= Auth::id();
        $data['images']=json_encode($oldImage);
        $data['sale']= ($data['status']==0)?0:$request->sale;
        unset($data['selected_images']);
        unset($data['updateProduct']);

        // dd($data);
        Product::where('id',$id)->update($data);
        return redirect()->route('showMyProduct');
    }

 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {
        
         // Tìm sản phẩm theo ID
        $product = Product::find($id);

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('showMyProduct'); 
    }
    /**
     * Show product detail
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // $categories = Category::all()->toArray();
         // $brands = Brand::all();

        // Retrieve the product from the database using the $id
        $product = Product::find($id)->toArray();
        // $product->images=json_decode($product->images, true);
         $product['images']=json_decode($product['images'], true);
        $category = Category::find($product['id_category']);
        $brands = Brand::find($product['brand_name']);


        // Pass the product data to the view
        return view('frontend.product.product-detail', ['product' => $product,'category'=>$category->category_name,'brands'=>$brands->brand_name]);
    }
}
