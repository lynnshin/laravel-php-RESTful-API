<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    private function makeJson($status, $data, $statusCode)
    {
        //轉 JSON 時確保中文不會變成 Unicode
        return response()->json(['status' => $status, 'data' => $data], $statusCode)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    private function checkRequest($request){
        // 草稿允許標題內空白
        if ($request->status == 'draft'){            
            $request['title'] = $request->title == null ? '' : $request->title;
            $request['content'] = $request->content == null ? '' : $request->content;
        }
        else{
            // 表單驗證
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:50',
                'content' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_FORBIDDEN);
            }           
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit == null ? 10 : $request->limit;
        $catagory = $request->catagory_id;
        $status = $request->status == null ? 'published' : $request->status;

        $query = Post::query();
        
        //如果有選擇文章類別
        if($catagory){
            $query->where('catagory_id','=',$catagory);
        }
        //按照一頁限制筆數分頁
        $post = $query->orderBy('id','desc')->where('status','=',$status)->paginate($limit);

        $data = ['post'=> $post];
        return $this->makeJson('success', $data, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = $this->checkRequest($request);
        if ($check){
            return $check;
        }
        else{
            $post = Post::create($request->all());

            $data = ['post'=> $post];
            return $this->makeJson('success', $data, Response::HTTP_OK);
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
        $post = Post::findOrFail($id);
        
        return $this->makeJson('success', new PostResource($post), Response::HTTP_OK);

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
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $check = $this->checkRequest($request);
        if ($check){
            return $check;
        }
        else{
            $post->update($request->all());
            $post->save();
    
            $data = ['post'=> $post];
            return $this->makeJson('success', $data, Response::HTTP_OK);
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
        $post = Post::findOrFail($id);
        
        $this->authorize('delete', $post);

        $post->delete();

        return $this->makeJson('success', null, Response::HTTP_OK);
    }
}
