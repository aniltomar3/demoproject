<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Controllers\API\BaseController as BaseController;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post= Post::all();
        // return response()->json([
        //     'status' =>true,
        //     'message'=>'All Post Data',
        //     'data'   =>$post
        // ],200);
    return $this->sendResponse($post,'All Post Data');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatePost= Validator::make(
            $request->all(),
            [
                'title'     =>'required',
                'description'=>'required',
                'image'      =>'required|mimes:png,jpg,jpeg,gif'
            ]);
        if($validatePost->fails()){
         return $this->sendError('Validation Errors',$validatePost->errors()->all(),401);    
        }
        
         $img= $request->image;
         $ext= $img->getClientOriginalExtension();
         $imageName= time().'.'.$ext;
         $img->move(public_path('/apimage'),$imageName);

         $post= Post::create([
            'title' =>$request->title,
            'description'=>$request->description,
            'image'=>$imageName
         ]);
    return $this->sendResponse($post,'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post= Post::select('title','description','image')->where(['id'=>$id])->get();
      return $this->sendResponse($post,'Your Single Post');  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validatePost= Validator::make(
            $request->all(),
            [
                'title'     =>'required',
                'description'=>'required',
                'image'      =>'required|mimes:png,jpg,jpeg,gif'
            ]);
        if($validatePost->fails()){
          return $this->sendError('Validation Errors',$validatePost->errors()->all(),401);   
        }
        
         $postData= Post::select('title','description','image')->where(['id'=>$id])->firstOrFail();
         if($request->hasFile('image')){
            $path= public_path('/apimage/');
            if($postData->image !="" && $postData->image!=null){   
                 $old_file= $path.$postData->image;
                 if(file_exists($old_file)){
                    unlink($old_file);
                 }
            }
           
         $img= $request->image;
         $ext= $img->getClientOriginalExtension();
         $imageName= time().'.'.$ext;
         $img->move(public_path('/apimage'),$imageName);
        }else{
         $imageName = $post->image; 
        }

        
        
         $post= Post::where(['id'=>$id])->update([
            'title' =>$request->title,
            'description'=>$request->description,
            'image'=>$imageName
         ]);
      return $this->sendResponse($post,'Post Updated Successfully');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagepath= Post::select('image')->where('id',$id)->get();
        $filepath= public_path().'/apimage/'.$imagepath[0]['image'];
        unlink($filepath);
        $post= Post::where('id',$id)->delete();
     return $this->sendResponse($post,'Your Post has been Removed');     
    }
}
