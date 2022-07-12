<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Image; // run this code (composer require intervention/image)  and add (Intervention\Image\ImageServiceProvider::class) in config/app.php in providers array
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


  public function photo(Request $request)
  {
    $request->validate([
        'profile_photo'=> 'image',     //'mimes:jpg,bmp,png,jpeg'
        'profile_photo' => 'file|max:5000',
    ]);

    $uploaded_photo = $request->profile_photo;
    $extension = $uploaded_photo->getClientOriginalExtension();
    $filename = Auth::id().'.'.$extension;
    if(Auth::user()->profile_photo == 'default_user.png'){
        Image::make($uploaded_photo)->save(public_path('/uploads/admin/'.$filename));
        $admin_photo = User::find(Auth::id());
        $admin_photo->profile_photo = $filename;
        $admin_photo->save();

    }else{
        $delete_from = public_path('/uploads/admin/'.Auth::user()->profile_photo);
        unlink($delete_from);
        Image::make($uploaded_photo)->save(public_path('/uploads/admin/'.$filename));
        $admin_photo = User::find(Auth::id());
        $admin_photo->profile_photo = $filename;
        $admin_photo->save();

    }
    return back();
  }


}
