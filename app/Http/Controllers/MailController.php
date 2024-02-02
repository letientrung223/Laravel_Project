<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Mail;
use App\Models\History;

use Illuminate\Support\Facades\Redirect;
class MailController extends Controller
{
    public function sendEmail()
    {
        $data = [
            'subject'=> "Cambo Tutorial Mail",
            'body'=> 'Hello This is my email delivery!'
        ];

        // Get user information from the authenticated user
        $user = auth()->user()->toArray();

        // Get cart information from the session
        $cart = session('cart');
        $data['user'] = $user;
        $data['cart'] = $cart;
        $totalAmount = 0;

        foreach ($data['cart'] as $item) {
            $totalAmount += $item['total'];
        }

        $data['totalAmount'] = $totalAmount;
        // dd($data);
    
        try {
            Mail::to ('khanhky245@gmail.com')
            ->send(new MailNotify($data));
            $history = [
                'id_user'=> $data['user']['id'], 
                'name' => $data['user']['name'],
                'email' => $data['user']['email'],
                'phone' => $data['user']['phone'],
                'price'=> $data['totalAmount'] 
            ];
            History::create($history);
           return Redirect::route('home')->with('success', 'Great! Check your email inbox.');
        }
        catch(Extension $th){
            return response()->json(['sorry']);
        }
    }
}
