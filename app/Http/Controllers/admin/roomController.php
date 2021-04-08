<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StorePostRequest;
use App\Http\Requests\Room\UpdatePostRequest;
use App\Models\category;
use App\Models\room;
use App\Models\tag;
use App\Models\roomPrice;
use App\Models\roomImage;
use App\Models\facility;
use App\Models\facility_room;
use App\Models\tag_room;
use Illuminate\Http\Request;
use Image;
use DB;


class roomController extends Controller
{
    private $room;
    private $tag;
    private $category;
    private $roomPrice;
    private $roomImage;
    private $facility;
    public function __construct(room $room, category $category,tag $tag,roomPrice $roomPrice,roomImage $roomImage,facility $facility,facility_room $facility_room,tag_room $tag_room)
    {
        $this->room = $room;
        $this->category = $category;
        $this->tag = $tag;
        $this->roomPrice = $roomPrice;
        $this->roomImage = $roomImage;
        $this->facility = $facility;
        $this->facility_room = $facility_room;
        $this->tag_room = $tag_room;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->room->getALlRoom();
            $category = $this->category->getALlCategory();
            return view('admins.Room.index', compact('data','category'));
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
            $validated['visibility']=($request->visibility == null)?0:1;
            $file = $request->image;
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $file_name = time().rand(100,999).$original_name;
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(370,250);
            $image_resize->save('upload/cover/'.$file_name);
            $validated['image'] = $file_name;
            $rs = $this->room->insertRoom($validated);
            if ($rs){
                return back()->with('success','Thêm mới phòng thành công');
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
        try {
            $obj = $this->room->getByIdRoom($id);
            $roomimages = $this->roomImage->getByIdImages($id);
            $roomPrice = $this->roomPrice->getByIdPrices($id);
            $facility_room = $this->facility_room->getByIdFacility_room($id);
            $tag_room = $this->tag_room->getByIdTag_room($id);
            $facility = $this->facility->getAllFacility();
            $tag = $this->tag->getAllTag();
            $temp           = DB::table('booking_details')->where('room_id',$id)->get();
            return view('admins.Room.detail', compact('obj','roomimages','roomPrice','facility','facility_room','tag','tag_room','temp'));
        }catch (\Exception $e){
            dd($e);
        }
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
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $validated['visibility']=($request->visibility == null)?0:1;

            if ($request->image == null){
                $validated['image'] = $this->room->getByIdRoom($id)->image;
            }else{
                $file = $request->image;
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $file_name = time().rand(100,999).$original_name;
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(370,250);
                $image_resize->save('upload/cover/'.$file_name);
                $validated['image'] = $file_name;
            }
            $this->room->updateRoom($validated, $id);
            return back()->with('success','Chỉnh sửa phòng thành công');
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
            $this->room->deleteRoom($id);
            return back()->with('success','Xóa phòng thành công');
        }catch (\Exception $e){
            dd($e);
            abort(500);
        }
    }
    public function search(Request $request)
    {
    }
}
