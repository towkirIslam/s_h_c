<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
