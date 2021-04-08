<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Price\StorePostRequest;
use App\Http\Requests\Price\UpdatePostRequest;
use App\Models\room;
use App\Models\roomPrice;


class priceController extends Controller
{
    private $roomPrice;
    function __construct(roomPrice $roomPrice)
    {
        $this->roomPrice = $roomPrice;
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
            $this->roomPrice->insertPrices($validated);
            return back()->with('success','Thêm Thành Công');
            if ($rs) {
                 return back()->with('success','Thêm Thành Công');
            }
            else
            {
                return back()->with('error','khong thanh cong');
            }
           
        } catch (Exception $e) {
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
        $validated = $request->validated();
        $this->roomPrice->updatePrices($validated,$id);
        return back()->with('success','Sua thanh cong');

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
