<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function guest()
    {
        return view('welcome', ['blogs' => Blog::latest()->paginate(5)]);
    }
    public function home_blog()
    {
        return view('dashboard/user/home', ['blogs' => Blog::latest()->paginate(5)]);
    }
    public function myBlog()
    {
        $user = Auth::user();
        $blog = Blog::where('email', $user->email)->get();
        return view('blogs.myBlog', ['blogs' => $blog]);
    }
    public function create()
    {
        return view('blogs.create');
    }
    //Save blogs
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png,gif'
        ]);
        //Upload and Image Naming
        $imageName = time() . '.' . $request->image->extension();
        //Move to Public folder
        $request->image->move(public_path('blogs'), $imageName);

        //Save blogs to database
        $blog = new Blog();
        $blog->name = $request->name;
        $blog->email = $request->email;
        $blog->description = $request->description;
        $blog->image = $imageName;
        $blog->save();
        return redirect()->to('user/dashboard/user/home')->with('Success', 'Blog added successfully!');
    }
    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('blogs.edit', ['blog' => $blog]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable | mimes:jpeg,jpg,png,gif'
        ]);

        $blog = Blog::where('id', $id)->first();

        if (isset($request->image)) {
            //Upload and Image Naming
            $imageName = time() . '.' . $request->image->extension();
            //Move to Public folder
            $request->image->move(public_path('blogs'), $imageName);
            $blog->image = $imageName;
        }
        //Save blogs to database
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->save();
        return redirect()->to('user/dashboard/user/home')->with('Success', 'Blog updated successfully!');
    }
    public function delete($id)
    {
        $blog = Blog::where('id', $id)->first();
        $blog->delete();
        return redirect()->to('user/dashboard/user/home')->with('Success', 'Blog deleted successfully!');
    }
    public function show($id)
    {
        $blog = Blog::where('id', $id)->first();

        return view('blogs.show', ['blog' => $blog]);
    }
}
