<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Country;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart()
    {
        $cartList = Session::get('cart', []);
        $totalAll = array_reduce($cartList, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);

        return view('frontend.cart.cart',compact('cartList','totalAll'));
    }
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $qty = $request->input('qty');
        // Lấy thông tin sản phẩm từ database hoặc bất kỳ nguồn dữ liệu nào khác
        $productData = Product::find($productId);
        $userId = Auth::id();
        $productImg =json_decode($productData->images, true);

        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            // Nếu đã tồn tại, tăng số lượng sản phẩm
            if ($qty==0){
                $cart[$productId]['quantity']++;
                $cart[$productId]['total']= $cart[$productId]['total']+ ($cart[$productId]['price'] - $cart[$productId]['price']*$cart[$productId]['sale']/100);


            }else {
                $cart[$productId]['quantity']+=$qty;
                $cart[$productId]['total']= $cart[$productId]['total']+ ($cart[$productId]['price']*$cart[$productId]['sale']/100)*$cart[$productId]['quantity'];

            }

        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $cart[$productId] = [
                'id_product' => $productId,
                'id_user'=>$userId,
                'name' => $productData->name, 
                'price' => $productData->price,
                'sale'=> $productData->sale, 
                'image'=> $productImg[0],
                'quantity' => ($qty==0)?1:$qty,

            ];
            $total = ($cart[$productId]['price'] - $cart[$productId]['price']*$cart[$productId]['sale']/100)*$cart[$productId]['quantity'];
            $cart[$productId]['total']=$total;
        }

        Session::put('cart', $cart);


        $cartCount = 0;
        foreach ($cart as $item) {
        $cartCount += $item['quantity'];
        }

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart_count' => $cartCount,
        ]);
    
    }
    public function handleCart(Request $request)
    {

        $idProduct = $request->idProduct;
        $handle =$request->cart;

        // session()->get('cart')
        $cartList = Session::get('cart', []);

        $productData = $cartList[$idProduct];
        if ($handle == 1 ) {
            $productData['quantity']++;
            $productData['total'] =  $productData['total'] + ($productData['price']-$productData['price']*$productData['sale']/100);
            $cartList[$idProduct] =  $productData;
            Session::put('cart', $cartList);
            $totalAll = array_reduce($cartList, function ($carry, $item) {
            return $carry + $item['total'];
            }, 0);
            $cartCount = 0;
            foreach ($cartList as $item) {
                $cartCount += $item['quantity'];
            }
            return response()->json([
                'message' => 'Product added to cart successfully',
                'total' => $productData['total'],
                'qty' => $productData['quantity'],
                'totalAll'=> $totalAll,
                'cartCount'=>$cartCount
            ]); 
        }
        else if ($handle == 2) {
            $productData['quantity']--;
            if ($productData['quantity']==0){
                unset($cartList[$idProduct]);
                Session::put('cart', $cartList);
                $totalAll = array_reduce($cartList, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
                $cartCount = 0;
            foreach ($cartList as $item) {
                $cartCount += $item['quantity'];
            }
                 return response()->json([
                'message' => 'successfully',
                'reload' => 'true',
                'totalAll'=> $totalAll,
                'cartCount'=>$cartCount     
            ]);
            } else {
                $productData['total'] =  $productData['total'] - ($productData['price']-$productData['price']*$productData['sale']/100);
                $cartList[$idProduct] =  $productData;
                Session::put('cart', $cartList);
                $totalAll = array_reduce($cartList, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
                $cartCount = 0;
            foreach ($cartList as $item) {
                $cartCount += $item['quantity'];
            }
                 return response()->json([
                'message' => 'Product added to cart successfully',
                'total' => $productData['total'],
                'qty' => $productData['quantity'],
                'totalAll'=> $totalAll,
                'cartCount'=>$cartCount
            ]);
            }
        } else {
            unset($cartList[$idProduct]);
            Session::put('cart', $cartList);
            $totalAll = array_reduce($cartList, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
            $cartCount = 0;
            foreach ($cartList as $item) {
                $cartCount += $item['quantity'];
            }

             return response()->json([
                'message' => 'successfully',
                'reload' => 'true',
                'totalAll'=> $totalAll,
                'cartCount'=>$cartCount               
            ]);
            //totalAll

        }
    }

    
    public function showCheckout()
    {
        $countries = Country::all();
        $cartList = Session::get('cart', []);
        $totalAll = array_reduce($cartList, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
        $cartList = Session::get('cart', []);

        return view('frontend.checkout.checkout',compact('cartList','totalAll','countries'));
        
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
