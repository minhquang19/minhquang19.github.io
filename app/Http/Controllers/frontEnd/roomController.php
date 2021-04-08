<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;
use App\Models\room;
use App\Models\category;
use App\Models\roomPrice;
use App\Models\roomImage;
use App\Models\tag;
use DB;

class roomController extends Controller
{
    private $room;
    private $tag;
    private $category;
    private $roomPrice;
    private $roomImage;
    private $facility;
    function __construct(room $room,category $category,roomPrice $roomPrice,roomImage $roomImage,tag $tag)
    {
        $this->room = $room;
        $this->category = $category;
        $this->roomPrice = $roomPrice;
        $this->roomImage = $roomImage;
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
            $room_data= room::where('visibility',1);
            $checkin = date("Y-m-d", strtotime(request()->checkin));
            $checkout = date("Y-m-d", strtotime(request()->checkout));
            if(request()->has('checkin') && request()->has('checkout'))
            {
                $room_data = $room_data->whereNotIn('id', function($query) use ($checkin, $checkout) {
                    $query->from('booking_details')
                        ->select('room_id')
                        ->where('checkin', '<=', $checkin)
                        ->where('checkout', '>=', $checkout);
                });
            }
            $roomPrice_data = roomPrice::with('room')->get();
            if(request()->has('min') && request()->has('max'))
            {
                $price_weekly = DB::table('room_prices')->where('Weekly','>=',request()->min)->where('Weekly','<=',request()->max)->get()->pluck('room_id');
                $room_data = $room_data->whereIn('id', $price_weekly);
            }
            if(request()->has('filtertag'))
            {
                $checked = $_GET['filtertag'];
                $filtertag = DB::table('tag_rooms')->whereIn('tag_id',$checked)->get()->pluck('room_id');
                $room_data = $room_data->whereIn('id', $filtertag);
            }
            if(request()->has('category'))
            {
                $room_data = $room_data->where('category_id',request()->category);
            }


            $room_data = $room_data->paginate(4);
            $category_data = $this->category->getAllCategory();
            $bad_number =DB::table('facility_rooms')->where('facility_name','Bad')->get();
            $bath_number =DB::table('facility_rooms')->where('facility_name','Bath')->get();
            $tag = $this->tag->getAllTag();
            $blog = blog::all()->random(2);
            return view('frontEnd.room-list',compact('room_data','category_data','roomPrice_data','bad_number','bath_number','tag','blog'));

        } catch (Exception $e) {
            dd($e);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room_detail    = $this->room->getByIdRoom($id);
        $roomimages     = $this->roomImage->getByIdImages($id);
        $roomPrice      = roomPrice::with('room')->where('room_id',$id)->get();
        $tag_data       = DB::table('tag_rooms')->where('room_id',$id)->get();
        $fac_data       = DB::table('facility_rooms')->where('room_id',$id)->get();
        $room_3         = room::all()->random(3);
        $bad_number     = DB::table('facility_rooms')->where('facility_name','Bad')->get();
        $bath_number    = DB::table('facility_rooms')->where('facility_name','Bath')->get();
        $temp           = DB::table('booking_details')->where('room_id',$id)->get();
        $blog           = blog::all()->random(2);
        return view('frontEnd.room-details',compact('room_detail','roomimages','bad_number','bath_number','roomPrice','tag_data','fac_data','room_3','bad_number','bath_number','temp','blog'));
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
        //
    }
}
