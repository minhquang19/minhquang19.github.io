<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\category\StorePostRequest;
use App\Http\Requests\category\UpdatePostRequest;
use App\Models\category;

class categoryController extends Controller
{
    private $category;

    public function __construct(category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {
            $data = $this->category->getALlCategory();
            return view('admins.category', compact('data'));
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
            $this->category->insertCategory($validated);
            return back()->with('success','Thêm loại phòng thành Công');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
         try {
            $validated = $request->validated();
            $this->category->updateCategory($validated, $id);
            return back()->with('success','Sửa loại phòng thành Công');
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
            if ($this->category->getByIdCategory($id)->rooms->count() > 0){
                return back()->with('error','Không thể xóa loại phòng đang chứa phòng');
            }
            $this->category->deleteCategory($id);
            return back()->with('success','Xóa loại phòng thành Công');;
        }catch (\Exception $e){
            abort(500);
        }
    }
}
