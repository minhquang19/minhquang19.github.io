<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tag_room;
use App\Http\Requests\Tag_room\StorePostRequest;
use App\Http\Requests\Tag_room\UpdatePostRequest;

class tag_roomController extends Controller
{
    private $tag_room;

    function __construct(tag_room $tag_room)
    {
        $this->tag_room = $tag_room;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rs =$this->tag_room->insertTag_room($validated);
        if($rs){
            return back()->with('success','Thêm Tag thành công');
        }else{
            return back()->with('error','Thêm Tag không thành công');
        }
        } catch (Exception $e) {
            dd($e);
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
    public function update(Request $request, $id)
    {
        //
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
            $this->tag_room->deleteTag_room($id);
            return  back()->with('success','Xóa Tag thành công');
        }catch (\Exception $e){
            dd($e);
            abort(500);
        }
    }
}
