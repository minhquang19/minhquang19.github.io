<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\room;
use App\Models\booking;
use App\Models\bookingDetail;
use App\Models\roomPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use Card;
use Session;

class bookingController extends Controller
{
    private $roomprice;
    private $room;
    private $booking;
    function __construct(room $room,roomPrice $roomPrice,booking $booking)
    {
        $this->room = $room;
        $this->roomPrice = $roomPrice;
        $this->booking = $booking;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Session::get('cart');
        $totalPrice = 0;
        if($items) {
            foreach ($items as $key => $cart) {
                $totalPrice = $totalPrice+ $cart['price'];
            }
        }
        $booked = booking::where('user_id',Auth::user()->id)->get();
        $book = DB::table('booking_details')->get();
        $blog = blog::all()->random(2);
        return view('frontEnd.booking',compact('items','totalPrice','book','blog','booked'));

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
    public function store(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        $price = roomPrice::with('room')->where('room_id', $data['id'])->get();
        $priceweekly = (float)$price[0]->Weekends;
        $date = abs(strtotime($data['checkin']) - strtotime($data['checkout']));
        $dateiff = (float)floor($date / (60 * 60 * 24));
        $price = $priceweekly*$dateiff;
        $room = room::find($data['id']);
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['room_id'] == $data['id']) {
                    $is_avaiable++;
                    return back()->with('error','You have booked this room');
                }
            }
                if ($is_avaiable == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'room_name' => $data['name'],
                        'room_id' => $data['id'],
                        'image' => $room->image,
                        'area' => $room->area,
                        'checkin' => $data['checkin'],
                        'checkout' => $data['checkout'],
                        'date' => $dateiff,
                        'unit_price' => $priceweekly,
                        'price'=>$price,
                        'amount' => $data['amount_people'],
                    );
                    Session::put('cart', $cart);
                    return redirect()->route('booking.index')->with('success','Add Room Success');
                }
            } else {
                $cart[] = array(
                    'session_id' => $session_id,
                    'room_name' => $data['name'],
                    'room_id' => $data['id'],
                    'image' => $room->image,
                    'area' => $room->area,
                    'checkin' => $data['checkin'],
                    'checkout' => $data['checkout'],
                    'date' => $dateiff,
                    'unit_price' => $priceweekly,
                    'price'=>$price,
                    'amount' => $data['amount_people'],
                );
                Session::put('cart', $cart);
            return redirect()->route('booking.index')->with('success','Add Room Success');;
            }
            Session::save();
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $totalPrice = 0;
        $items = Session::get('cart');
        $booking = new booking;
        $booking->user_id = Auth::user()->id;
        $booking->save();
        if($items)
        {
            foreach ($items as $key =>$cart)
            {
                $booking_details = new bookingDetail;
                $booking_details->room_id =$cart['room_id'];
                $booking_details->room_name =$cart['room_name'];
                $booking_details->booking_id = $booking->id;
                $time_checkin = strtotime($cart['checkin']);
                $time_checkout = strtotime($cart['checkout']);
                $checkin = date('Y-m-d',$time_checkin);
                $checkout = date('Y-m-d',$time_checkout);
                $booking_details->checkin = $checkin;
                $booking_details->checkout = $checkout;
                $booking_details->amount_date = $cart['date'];
                $booking_details->amount = $cart['amount'];
                $booking_details->unit_price = $cart['unit_price'];
                $booking_details->price = $cart['price'];
                $totalPrice = $totalPrice + $cart['price'];
                $booking_details->save();
            }

        }
        $total = DB::table('bookings')
            ->where('id',$booking->id)
            ->update(['totalPrice' => $totalPrice]);

        Session::forget('cart');
        return back()->with('success','Đặt phòng thành công');

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
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('success','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('error','Xóa sản phẩm thất bại');
        }

    }
}
