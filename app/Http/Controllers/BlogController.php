<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index');
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
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'designation' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('images'), $imageName);
        }
        $blog = new User();
        $blog->name = $request->name;
        $blog->phone = $request->phone;
        $blog->address = $request->address;
        $blog->image = 'images/' . $imageName;
        $blog->designation = $request->designation;
        $blog->gender = $request->gender;
        $blog->age = $request->age;
        $blog->email = $request->email;
        $blog->password = bcrypt($request->password);

        if ($blog->save()) {
            return redirect()->route('blog.loginForm');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('blog.profileShow');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function profileShow(Request $request)
    {
        $perPage = 2;
        $currentPage = $request->page ?? 0;
        $offset = ($currentPage - 1) * $perPage;

        $user = User::find(Auth::id());
        $blogs = Blog::where('user_id', Auth::id())->offset($offset)->limit($perPage)->get();
        $totalPages = ceil(Blog::where('user_id', Auth::id())->count() / $perPage);
        return view('blog.profile', ['blogs' => $blogs, 'user' => $user, 'currentPage' => $currentPage, 'totalPages' => $totalPages]);
    }

    public function uploadBlog()
    {
        return view('blog.blogUpload');
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'blogtitle' => 'required|string',
            'blogcontent' => 'required|string|max:1000000000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);
        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->blogtitle = $request->blogtitle;
        $blog->blogcontent = $request->blogcontent;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('images'), $imageName);
            $blog->image = 'images/' . $imageName;
        }
        if ($blog->save()) {
            return redirect()->route('blog.profileShow');
        }
    }
    public function destroyBlog($id)
    {
        $blog = Blog::find($id);

        if ($blog->delete()) {
            return redirect()->route('blog.profileShow');
        }
    }
    public function editBlog($id)
    {

        if ($blogs = Blog::find($id)) {

            return view('blog.editBlog', ['blogs' => $blogs]);
        }
    }
    public function updateBlog(Request $request, $id)
    {

        $blog = Blog::find($id);
        $blog->user_id = Auth::id();
        $blog->blogtitle = $request->blogtitle;
        $blog->blogcontent = $request->blogcontent;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('images'), $imageName);
            $blog->image = 'images/' . $imageName;
        }
        if ($blog->save()) {
            return redirect()->route('blog.profileShow');
        }
    }
}
