<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StorePostRequest;
use App\Http\Requests\Tag\UpdatePostRequest;
use App\Models\tag;

class tagController extends Controller
{
    private $tag;
    function __construct(tag  $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->tag->getALlTag();
            return view('admins.tag', compact('data'));
        }catch (\Exception $e){
            abort(500);
        }
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
            $rs = $this->tag->insertTag($validated);
            if($rs)
            { return back()->with('success','Thêm Tag Thành Công');}
            else{
                return back()->with('error','Xóa Tag thành công');
            }

        }catch (\Exception $e){
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
            $rs = $this->tag->updateTag($validated, $id);
            if($rs){
                return back()->with('success','Sửa Tag Thành Công');
            }
            else{
                return back()->with('error','Sửa Tag không Thành Công');
            }
        }catch (\Exception $e){
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
            // if ($this->category->getByIdCategory($id)->rooms->count() > 0){
            //     return back()->with('error','Không thể xóa danh mục có chứa phòng');
            // }
            $this->tag->deleteTag($id);
            return back()->with('success','Xóa Thành Công');;
        }catch (\Exception $e){
            abort(500);
        }
    }
}
