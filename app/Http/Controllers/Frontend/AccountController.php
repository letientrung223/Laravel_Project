<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Product;

use App\Http\Requests\UpdateProfileRequest;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

               return view('frontend.account.account',['countries'=>$countries]);

    }

    public function updateAccount(UpdateProfileRequest $request, $id)
    {
        $user = Auth::user();
        $data = $request->all();
        $file = $request->file('avatar');
        $data['phone']= $request -> phone;
        $data['address']= $request -> address;
    
        if (!empty($file)) {
        $data['avatar'] = $file->getClientOriginalName();
        }

        if (($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } 
        else {
            $data['password'] = $user->password;
        }
     

        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
        return redirect()->back()->with('success', __('Update profile success.'));
        } 
        else {
        return redirect()->back()->withErrors(['Update profile error.']);
        }
    }



   public function showMyProduct()
    {   
       $userId = Auth::id();
        $products = Product::where('id_user', $userId)->get();
        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }
        return view('frontend.product.list-product',['products'=>$products]);

    }

    public function showListProduct()
    {   
        $products = Product::all();
        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }
        return view('frontend.product.list-product',['products'=>$products]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

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
