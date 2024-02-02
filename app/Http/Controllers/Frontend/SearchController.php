<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\View; 
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByPrice(Request $request)
    {
        $brands= Brand::all()->toArray();
        $categories=Category::all()->toArray();
        $data = $request->input('data');
        $decodedData = json_decode(urldecode($data), true);
        return view('frontend.search.search',['results' => $decodedData,'categories'=>$categories,'brands'=>$brands]);


    }
    public function search(Request $request)
    {
         $query = $request->input('query');
        
        // Perform your search logic on the Product model
        $results = Product::where('name', 'like', '%' . $query . '%')->get()->toArray();
        // dd($results);

        foreach ($results as &$product) {
        // Convert the 'images' column from JSON to an array
        $product['images'] = json_decode($product['images'], true);
        }

        $brands= Brand::all()->toArray();
        $categories=Category::all()->toArray();
        return view('frontend.search.search',['results' => $results,'categories'=>$categories,'brands'=>$brands]);
        // return view('frontend.search.search', ['results' => $results]);
    }

    public function searchCondition(Request $request)
    {
        $name = $request->input('name');
        $priceOption = $request->input('price');
        $category = $request->input('category');
        $brand = $request->input('brand');
        $status = $request->input('status');
        // dd($data);
        if ($name !== null) {

        // Lấy giá trị minPrice và maxPrice từ giá trị priceOption
        $priceRangeArray = explode("-", $priceOption);
        $minPrice = $priceRangeArray[0];
        $maxPrice = $priceRangeArray[1];
        // Thực hiện câu truy vấn
        $results = Product::where('name', 'like', '%' . $name . '%')
            ->when($category != 0, function ($query) use ($category) {
                return $query->where('id_category', $category);
            })
            ->when($brand != "", function ($query) use ($brand) {
                return $query->where('brand_name', $brand);
            })
            ->when($status != 'active', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->get()
            ->toArray();

        // Convert 'images' column from JSON to an array
        foreach ($results as &$product) {
            $product['images'] = json_decode($product['images'], true);
        }

        // Trả về kết quả
        // dd($results);
        // Truy vấn categories và brands
        $categories = Category::all()->toArray();
        $brands = Brand::all()->toArray();

        // Trả về kết quả
        return view('frontend.search.search', [
            'results' => $results,
            'categories' => $categories,
            'brands' => $brands,
        ]);
        } else {
            // Ngược lại, nếu name là null, gọi hàm search và trả về kết quả của nó
            return $this->search($request);
        }
    }
    public function searchPrice(Request $request)
    {
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');

        $results = Product::whereBetween('price', [$minPrice, $maxPrice])->get()->toArray();

        
       

        return response()->json(['results' => $results]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function searchByPrice(Request $request)
    // {
    //     $data = $request->input('data');
    //     $decodedData = json_decode(urldecode($data), true);
    //     dd($decodedData);


    // // Xử lý dữ liệu và trả về view
    //     return view('frontend.search.search')->with('results', $decodedData);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
