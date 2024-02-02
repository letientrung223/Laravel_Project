<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Rate;
use App\Models\Comment;
use Auth;



class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = Blogs::paginate(3);
        // dd($blogPosts);
        return view('frontend.blogs.blogs-list',compact('blogPosts'));
    }

    public function showBlogDetail($id)
    {
        $blog= Blogs::find($id);
        // dd($blog);
        // lấy id bài viết trước và sau 
        $previousBlogId = Blogs::where('id', '<', $id)->max('id');
        $nextBlogId = Blogs::where('id', '>', $id)->min('id');

        $blogRates = Rate::where('id_blog', $id)->get();
        if(!$blogRates->isEmpty())
        {
            $totalRate = $blogRates->sum('rate');
            $averageRate = round($totalRate / $blogRates->count());
        }
        else 
        {
            $averageRate = '';
        }
        
        // echo $averageRate;

        $comments = Comment::where('id_blog', $id)->get();

        return view('frontend.blogs.blog',compact('blog','previousBlogId','nextBlogId','averageRate','comments'));
        
    }
    
    public function handleRate(Request $request)
    {
        $data = [
            'id_user' => $request->input('id_user'),
            'rate' => $request->input('rate'),
            'id_blog' => $request->input('id_blog'),
        ];
        Rate::create($data);
        return response()->json(['message' => 'Rate handled successfully','rate' => $data['rate']]);
    }

    public function handleComment(Request $request)
    {

        $id_user =  Auth::id() ;
        $name =  Auth::user()->name  ;
        $avatar =Auth::user()->avatar  ;

        $cmt = $request->cmt;
        $id_blog = $request->id_blog;
        $level = $request->level;

        $data = [
            'cmt'=> $cmt,
            'id_blog' =>$id_blog,
            'id_user'=>$id_user,
            'avatar'=>$avatar,
            'name'=>$name,
            'level'=>$level,
        ];

        $cmt = Comment::create($data);
        $cmtId = $cmt->id;
        $data['id'] = $cmtId;
    return response()->json(['message' => 'Post comment  successfully','data' => $data]);        
    }
    

}
