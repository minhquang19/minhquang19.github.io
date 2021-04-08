<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use App\Models\service;
use Illuminate\Http\Request;
use App\Models\room;
use  App\Models\blog;
use App\Models\category;
use App\Models\roomPrice;
use DB;

class homeController extends Controller
{
    function __construct(room $room,category $category,roomPrice $roomPrice)
    {
        $this->room = $room;
        $this->category = $category;
        $this->roomPrice = $roomPrice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $room_data = $this->room->getAllRoom();
            $category_data = $this->category->getAllCategory();
            $roomPrice_data = roomPrice::with('room')->get();
            $bad_number =DB::table('facility_rooms')->where('facility_name','Bad')->get();
            $bath_number =DB::table('facility_rooms')->where('facility_name','Bath')->get();
            $blog = blog::all()->random(2);
            $service =  service::all()->random(6);
            return view('frontEnd.index',compact('room_data','category_data','roomPrice_data','bad_number','bath_number','blog','service'));
        } catch (Exception $e) {

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
        //
    }
}
