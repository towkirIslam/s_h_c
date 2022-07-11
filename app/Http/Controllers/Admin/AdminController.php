<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;



class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('id',  '!=', Auth::id())->paginate(3);
        $total_user = User::count();
        return view('admin.users.index', compact('admins', 'total_user'));
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return back();
    }

    public function profile()
    {
        return view('admin.users.profile');
    }


    public function name(Request $request)
    {
        // print_r($request->all());
        $request->validate([
            'name'=>'required',
        ]);

        $AdminName = User::find(Auth::id());
        $AdminName->name = $request->name;
        $AdminName->updated_at = Carbon::now();
        $AdminName->save();
        return back();
    }

    public function password(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'password'=>'required',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
            'password'=> 'confirmed',
        ]);

        if(Hash::check($request->old_password, Auth::user()->password)){
            if(Hash::check($request->password, Auth::user()->password)){
                return back()->with('same_pass', 'you already use this password');
            }else{
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon::now(),
                ]);
                return back()->with('pass_success', 'Password Change Successfully');;
            }
        }else{
            return back()->with('wrong_pass', 'Old Password Not Correct!');
        }
        return back();
    }


  


}
