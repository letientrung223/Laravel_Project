<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Http\Requests\BlogRequest;


class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::all();
        return view('admin/blogs/blog',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('admin/blogs/create-blog'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertBlog(BlogRequest $request)
    {
        $title= $request -> title;
        $description= $request -> description;
        $content= $request -> txtContent;
        $file = $request->file('image');

        if (!empty($file)) 
        {
            $image = $file->getClientOriginalName();
            $file->move('upload/description/content', $file->getClientOriginalName());
        }
       
        $data= [
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'content' => $content,
            
        ];
        print_r($data);
        Blogs::create($data);

        return redirect()->route('blog');
    }
    public function deleteBlog($id)
    {
        $blog = Blogs::find($id);
        $blog->delete();
        return redirect()->route('blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blogs::find($id);
         return view('admin/blogs/edit-blog',compact('blog'));
        //
    }

    public function update(BlogRequest $request, $id)
     {
    $blog = Blogs::find($id);
    $data= [
            'title' => $request-> title,
            'image' => $request-> image,
            'description' => $request-> description,
            'content' => $request-> txtContent,
            
        ];
    $file = $request->file('image');
    
    if (!empty($file)) {
        $data['image'] = $file->getClientOriginalName();
    }
    // dd($blog);
    // dd($data);
     if ($blog->update($data)) {
        if (!empty($file)) {
            $file->move('upload/description/content', $file->getClientOriginalName());
        }
         return redirect()->back()->with('success', __('Update blog success.'));
     } else {
         return redirect()->back()->withErrors(['Update blog error.']);
     }
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
