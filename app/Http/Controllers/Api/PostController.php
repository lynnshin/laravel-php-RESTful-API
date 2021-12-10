<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
// use Response;

class PostController extends Controller
{

    private function makeJson($status, $data, $msg)
    {
        //轉 JSON 時確保中文不會變成 Unicode
        return response()->json(['status' => $status, 'data' => $data, 'message' => $msg])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit == null ? 10 : $request->limit;

        //按照一頁限制筆數分頁
        $post = Post::orderBy('id','desc')->paginate($limit);

        if($post){
            return $this->makeJson(1, $post, '以上為全部文章');
        }
        else{
            return $this->makeJson(0, null, '找不到任何文章');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = ['title'=> $request->title, 'content'=> $request->content];

        $post = Post::create($request->all());

        if($post){
            //$data = ['post'=> $post];
            return $this->makeJson(1, $post, '新增成功');
        }
        else{
            return $this->makeJson(0, null, '新增失敗');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if($post){
            return $this->makeJson(1, $post, '文章'.$id);
        }
        else{
            return $this->makeJson(0, null, '查無此文章');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $post = Post::findOrFail($id);
            // $post->title = $request->title;
            // $post->content = $request->content;
            $post->update($request->all());
            $post->save();
        }
        catch(Exception $e){
            return $this->makeJson(0, null, '更新失敗');
        }
        return $this->makeJson(1, $post, '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $post = Post::findOrFail($id);
            $post->delete();
        }
        catch(Exception $e){
            return $this->makeJson(0, null, '刪除失敗');
        }
        return $this->makeJson(1, null, '刪除成功');
    }
}
