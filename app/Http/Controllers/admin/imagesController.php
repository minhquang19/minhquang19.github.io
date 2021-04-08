<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Images\StorePostRequest;
use App\Http\Requests\Images\UpdatePostRequest;
use App\Models\roomImage;
use App\Models\room;
use Image;

class imagesController extends Controller
{
    private $roomImage;
    private $room;

    public function __construct(roomImage $roomImage,room $room)
    {
        $this->roomImage = $roomImage;
        $this->room = $room;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $image=array();
            if ($files = $request->file('name')){
                 foreach ($files as $file){
                      $original_name = strtolower(trim($file->getClientOriginalName()));
                      $room = $this->room->getByIdRoom($request->room_id);
                      $room_name = $room->name;
                      $file_name = $room_name.'-'.time().rand(100,999).$original_name;
                      $image_resize = Image::make($file->getRealPath());
                      $image_resize->resize(770,430);
                      $image_resize->save('upload/image/'.$file_name);
                      $validated['name'] = $file_name;
                      $this->roomImage->insertImages($validated);
                 }
             return  back()->with('success','Thêm ảnh chi tiết phòng thành công');

            }
        }catch (\Exception $e){
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
            $this->roomImage->deleteImages($id);
            return  back()->with('success','Xoá ảnh chi tiết phòng thành công');
        }catch (\Exception $e){
            dd($e);
            abort(500);
        }
    }
}
