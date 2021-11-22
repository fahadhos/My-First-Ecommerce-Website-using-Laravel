<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->session()->has('ADMIN_LOGIN'))
        {
            return redirect('admin/dashboard');
                  
        }
 // echo "Hello Admin";
   else{
        return view('admin.login') ; 
   }  
    }

  
public function auth(Request $request)
{
    $email=$request->post('email');
    $password= $request->post('password');
    // $result =Admin::where(['email'=>$email,'password'=>$password])->get();
    $result=Admin:: where(['email'=>$email])->first();
    if($result)
    {
        if(Hash::check($request->post('password'),$result->password ))
        {
          $request->session()->put('ADMIN_LOGIN',true);
        $request->session()->put('ADMIN_ID',$result->id);
        return redirect('admin/dashboard');
   
        }
        else{
            $request->session()->flash('error','The password you entered is wrong');
            return redirect('admin');
        
        }
     
    }
else{
    $request->session()->flash('error','Please enter your valid Login information');
    return redirect('admin');

}
   
} 
 public function dashboard()
    {
        return view('admin.dashboard');
    }


    // public function updatepass()
    // {
    //     $r=Admin::find(1);
    //     $r->password=Hash::make('1234');
    //     $r->save();
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @ return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @ param  \Illuminate\Http\Request  $request
     * @ return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @ param  \App\Models\Admin  $admin
     * @ return \Illuminate\Http\Response
     */
    // public function show(Admin $admin)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @ param  \App\Models\Admin  $admin
     * @ return \Illuminate\Http\Response
     */
    // public function edit(Admin $admin)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @ param  \Illuminate\Http\Request  $request
     * @ param  \App\Models\Admin  $admin
     * @ return \Illuminate\Http\Response
     */
    // public function update(Request $request, Admin $admin)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @ param  \App\Models\Admin  $admin
     * @ return \Illuminate\Http\Response
     */
    // public function destroy(Admin $admin)
    // {
    //     //
    // }
}
