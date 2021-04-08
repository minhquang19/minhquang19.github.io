<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Models\blog;
use App\Http\Requests\Blog\StorePostRequest;
use App\Http\Requests\Blog\UpdatePostRequest;
use Illuminate\Session\Store;

class blogController extends Controller
{
    private $blog;
    public function __construct(blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->blog->getAllBlog();
        return view('admins.blog.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            $validated = $request->validated();
            $file = $request->image;
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $file_name = time().rand(100,999).$original_name;
            $image_resize = Image::make($file->getRealPath());
//            $image_resize->resize(370,250);
            $image_resize->save('upload/blog/'.$file_name);
            $validated['image'] = $file_name;
            $rs = $this->blog->insertBlog($validated);
            if ($rs){
                return back()->with('success','Thêm mới Blog thành công');
            }else{
                return back()->with('error','Thêm không phòng thành công');
            }
        }catch (\Exception $e){
            dd($e);
            abort(500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            if ($request->image == null){
                $validated['image'] = $this->blog->getByIdBlog($id)->image;
            }else{
                $file = $request->image;
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $file_name = time().rand(100,999).$original_name;
                $image_resize = Image::make($file->getRealPath());
//                $image_resize->resize(370,250);
                $image_resize->save('upload/blog/'.$file_name);
                $validated['image'] = $file_name;
            }
            $rs = $this->blog->updateBlog($validated, $id);
            if($rs)
            {
                return back()->with('success','Chỉnh sửa Blog thành công');
            }else{
                return back()->with('error','Chỉnh sửa Blog khong thành công');
            }

        }catch (\Exception $e){
            dd($e);
            abort(500);
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
        try {
            $rs = $this->blog->deleteBlog($id);
            if($rs)
            {
                return back()->with('success','Xoa Blog thành công');
            }else{
                return back()->with('error','Chỉnh sửa Blog khong thành công');
            }
        }catch (\Exception $e){
            dd($e);
            abort(500);
        }
    }
}
