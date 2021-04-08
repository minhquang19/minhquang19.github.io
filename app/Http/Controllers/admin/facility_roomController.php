<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\facility_room;
use App\Http\Requests\Facility_room\StorePostRequest;
use App\Http\Requests\Facility_room\UpdatePostRequest;
use Illuminate\Http\Request;

class facility_roomController extends Controller
{
    private $facility_room;
    private $facility;
    function __construct(facility_room $facility_room)
    {
        $this->facility_room = $facility_room;
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
        $rs =$this->facility_room->insertFacility_room($validated);
            if($rs){
                return back()->with('success','Thêm CSVC thành công');
            }else{
                return back()->with('error','Thêm  CSVC không thành công');
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
            $this->facility_room->deleteFacility_room($id);
            return  back()->with('success','Xóa CSVC thành công');
        }catch (\Exception $e){
            dd($e);
            abort(500);
        }
    }


}
