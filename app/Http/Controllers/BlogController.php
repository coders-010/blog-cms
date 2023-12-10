<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    public function index(){
        return view ('blog.index');
    }
    public function loginForm()
    {

        return view('blog.login');
    }

    public function register()
    {

        return view('blog.register');
    }
    public function registerStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $blog = new User();
        $blog->name = $request->name;
        $blog->email = $request->email;
        $blog->password = $request->password;

        if ($blog->save()) {
            return redirect()->route('blog.loginForm');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            return redirect()->route('blog.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
