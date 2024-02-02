<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use Auth;
use App\Models\Country;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginNavigate()
    {
        return view('frontend.login.login');
        
    }
    public function logoutNavigate()
    {
        Auth::logout();
        Session::forget('cart');
        return redirect()->route('memberLogin');
        
    }
    public function registerNavigate()
    {
        $countries = Country::all();

        return view('frontend.register.register',['countries'=>$countries]);
        
    }

    public function loginMember(MemberLoginRequest $request)
    {
        $login = [
            'email'=> $request->email,
            'password'=> $request->password,
            'level'=> 0
        ];
        $remember =false;
        if ($request->remember_me){
            $remember=true;
        }
        // dd($login);

        if( Auth::attempt($login,$remember)){
            return redirect('/homepage');
        }
        else{
            return redirect()->back()->withErrors('Email or password is not correct.');

        }
        

    }

    public function registerMember(MemberRegisterRequest $request)
    {
    $file = $request->file('avatar');

        $member = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'id_country' => $request->id_country,
        ];

        if (!empty($file)) {
        $member['avatar'] = $file->getClientOriginalName();
        $file->move('upload/members/avatar', $file->getClientOriginalName());

        }
        $member['level']= '0';

        $member['password'] =bcrypt($member['password']);
        // dd($member);
        User::create($member);

        return redirect("/member/login");
    }

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
