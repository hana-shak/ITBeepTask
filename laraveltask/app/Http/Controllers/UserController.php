<?php

namespace App\Http\Controllers;

use App\Intrest;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $intrests = Intrest::all();
        $services = Service::all();
        return view('IT_Beep_Form',compact('services','intrests'));
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

    public function validation($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required | Digits:14 |numeric'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validation($request);
        $user = new User();
        $user->name =$request->input('name');
        $user->mobile =$request->input('mobile');
        $user->email =$request->input('email');
        $user->service1 =$request->input('service1');
        $user->service2 =$request->input('service2');
        $user->service3 =$request->input('service3');
        $user->intrest =$request->input('intreset');
        $user->save();
        $s1 = "";
        $s2 = "";
        $s3 = "";
        if ($request->input('service1') == 1){
            $s1 = 'service one';
        }
        if ($request->input('service2') == 1){
            $s2 = 'service two';
        }
        if ($request->input('service3') == 1){
            $s3 = 'service three';
        }
        $data = ['name'=>$request->input('name'), 'service_one'=>$s1, 'service_two'=>$s2,'service_three'=>$s3, 'interest_level'=>$request->input('intreset')];
//        $this->mail($request);
        \Mail::to($request->input('email'))->send(new \App\Mail\MyTestMail($data));
//        dd("Successfully Sent.");
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
    public function sendEmail($request)
    {
        $details = [
            'title' => 'Mail from Mohammed Alshatnawi',
            'body' => 'This is for testing email using smtp'
        ];
        $email = $request->input('email');
        \Mail::to($email)->send(new \App\Mail\MyTestMail($request));
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
