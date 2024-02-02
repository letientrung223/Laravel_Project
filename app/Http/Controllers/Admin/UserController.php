<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Country;

use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        // echo $user;
        $countries = Country::all();
        // dd($countries);
        return view('admin/user/user',['user'=>$user,'countries'=>$countries]);

    }

    public function update(UpdateProfileRequest $request, $id)
    {
    $user = Auth::user();
    $data = $request->all();
    $file = $request->file('avatar');
    $data['phone']= $request -> phone;
    $data['address']= $request -> address;
    
    if (!empty($file)) {
        $data['avatar'] = $file->getClientOriginalName();
    }
    // print_r(isset($data['password']));
    // $data['password'] = bcrypt($data['password']);
    // print_r($data);

     if (($data['password'])) {
         $data['password'] = bcrypt($data['password']);
     } else {
         $data['password'] = $user->password;
     }
     

     if ($user->update($data)) {
        if (!empty($file)) {
            $file->move('upload/user/avatar', $file->getClientOriginalName());
        }
         return redirect()->back()->with('success', __('Update profile success.'));
     } else {
         return redirect()->back()->withErrors(['Update profile error.']);
     }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
