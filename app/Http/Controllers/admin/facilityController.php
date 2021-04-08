<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Facility\StorePostRequest;
use App\Http\Requests\Facility\UpdatePostRequest;
use App\Models\facility;

class facilityController extends Controller
{
    private $facility;
    function __construct(facility  $facility)
    {
        $this->facility = $facility;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->facility->getALlFacility();
            return view('admins.facility', compact('data'));
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
            $this->facility->insertFacility($validated);
            return back()->with('success','Thêm CSVC Thành Công');
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
    public function update(StorePostRequest $request, $id)
    {
         try {
            $validated = $request->validated();
            $this->facility->updateFacility($validated, $id);
            return back()->with('success','Sửa CSVC Thành Công');
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
            $this->facility->deleteFacility($id);
            return back()->with('success','Xóa CSVC Thành Công');;
        }catch (\Exception $e){
            abort(500);
        }
    }
    public function rooms()
    {
        return $this->belongsToMany(room::class,'facility_rooms');
    }
}
