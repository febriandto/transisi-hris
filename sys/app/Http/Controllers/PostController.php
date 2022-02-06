<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use DB;
use Auth;

class PostController extends Controller
{
    
    public function index()
    {

        $post = DB::select("
            SELECT * 
            FROM hris_post 
            where is_delete = 'N'
            ORDER BY post_id DESC 
        ");

        return view('post.index', compact('post'));
    }

    public function add()
    {

        $post_id = DB::select(" SELECT count(*)+1 as 'a'  FROM hris_post ");
        $post_id = $post_id[0]->a;
        $post_id = sprintf('%04s', $post_id);

        $post_cat = DB::select(" SELECT * FROM hris_post_cat ");

        return view('post.add', compact('post_id', 'post_cat'));
    }

    protected function save( Request $request )
    {

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('post_file');
 
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images/upload/post';
 
        // upload file
        $file->move($tujuan_upload, $request->post_id.".".$file->getClientOriginalExtension());


        $post = new Post;
        $post->post_id    = $request->post_id;
        $post->post_title = $request->post_title;
        $post->post_desc  = $request->post_desc;
        $post->post_exerp = $request->post_exerp;
        $post->cat_id     = $request->cat_id;
        $post->post_img   = $request->post_id.".".$file->getClientOriginalExtension();
        $post->input_by   = Auth::user()->name;
        $post->input_date = date('Y-m-d');
        $post->edit_by    = Auth::user()->name;
        $post->edit_date  = date('Y-m-d');
        $post->save();

        return redirect(route('post.index'))->with('success', 'success');

    }

    public function edit(Post $post)
    {

        $post_img_v = DB::select("
            SELECT 
                (post_img_v)+1 as 'a',
                post_id,
                post_title,
                post_img,
                post_img_v
            FROM hris_post
            WHERE hris_post.post_id = '".$post->post_id."'
        ");

        $post_cat = DB::select("SELECT * FROM hris_post_cat");

        return view('post.edit', compact('post', 'post_cat', 'post_img_v'));

    }

    protected function update( Request $request )
    {

        Post::where('post_id', $request->post_id)->update([

            'post_title' => $request->post_title,  
            'post_desc' => $request->post_desc,  
            'post_exerp' => $request->post_exerp,  
            'cat_id' => $request->cat_id,

        ]);

        return redirect(route('post.index'))->with('updated', 'updated');
    }

    protected function ganti_gambar(Request $request)
    {

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('post_file');
 
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images/upload/post';
 
        // upload file
        $file->move($tujuan_upload, $request->post_id.".".$file->getClientOriginalExtension());

        Post::where('post_id', $request->post_id)->update([
            'post_img' => $request->post_id.".".$file->getClientOriginalExtension(),
            'post_img_v' => $request->post_img_v,
        ]);

        return redirect()->back();

    }

    protected function delete(Post $post)
    {
        Post::where('post_id', $post->post_id)->update(['is_delete' => 'Y']);

       return redirect(route('post.index'))->with('deleted', 'deleted');
    }

}
