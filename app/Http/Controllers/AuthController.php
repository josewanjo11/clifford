<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\travel_agents;
use App\Models\adminusers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    
    public function getLoginSession()
    {
    

        if (auth()->check()) {
           
           return response()->json(['agentId'=>session('agentId')]);
        } else if(session()->has('admin')){
            return response()->json(['admin'=>'admin']);
        }
        else
        {
            return response()->json(['guest'=>'hjj']);
        }
        
    }

         public function addAgent(Request $request)
    {
        travel_agents::create([
            'name'         => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'password'        => Hash::make($request->password),
        ]);

        return response()->json('successfully registered!');
    }


    public function addAdmin(Request $request)
    {
        adminusers::create([
            'name'         => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'password'        => Hash::make($request->password),
        ]);

        return response()->json('successfully registered!');
    }

    public function loginAgent(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Authentication passed
           
            return response()->json(['message'=>'success','agentId'=>auth()->user()->id]);
        }

        return response()->json(['error'=>'check your crediatials']);
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            // Authentication passed
           
            return response()->json(['message'=>'success','agentId'=>'null']);
        }

        return response()->json(['error'=>'check your crediatials']);
    }
}
