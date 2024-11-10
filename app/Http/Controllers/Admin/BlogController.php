<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
      $blogs=  Blog::orderBy('id','DESC')->get();
      
      return view('backEnd.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        return view('backEnd.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate(
            [
                'blog_title' => 'required|string',
                'blog_short_desc' => 'string',
                'blog_long_desc' => 'string',
//                'blog_image' => 'required|image',
                'blog_author' => 'string',

                
            ]
        );
        
        
        $blog= new Blog();
        $blog->blog_title = $request->blog_title;
        $blog->slug = Str::slug($request->blog_title);
        
        $blog->blog_short_desc = $request->blog_short_desc;
        $blog->blog_long_desc = $request->blog_long_desc;
        $blog->blog_author = $request->blog_author;
        $blog->blog_date = today();



        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');
            $filename = time() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/blog/'), $filename);
            $blog->blog_image = 'public/uploads/blog/'.$filename;
        }


        $blog->save();

        Toastr::success('Success','Data insert successfully');
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('backEnd.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
//        dd($request->all());
        
        $request->validate(
            [
                'blog_title' => 'required|string',
                'blog_short_desc' => 'string',
                'blog_long_desc' => 'string',
                'blog_author' => 'string',

            ]
        );


//        $blog= new Blog();
        $blog->blog_title = $request->blog_title;
        $blog->blog_short_desc = $request->blog_short_desc;
        $blog->blog_long_desc = $request->blog_long_desc;
        $blog->blog_author = $request->blog_author;
        $blog->blog_date = today();



        if ($request->hasFile('blog_image')) 
        {
            if ($blog->blog_image && file_exists($blog->blog_image)) {
                unlink($blog->blog_image);
            }
            $file = $request->file('blog_image');
            $filename = time() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/blog/'), $filename);
            $blog->blog_image = 'public/uploads/blog/'.$filename;
        }
        


        $blog->save();

        Toastr::success('Success','Data update successfully');
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->route('blogs.index');
    }


    public function inactive(Request $request)
    {
        $inactive = Blog::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Blog::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    
    
    
}
