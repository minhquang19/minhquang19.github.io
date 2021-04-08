@extends('layouts.base')
@section('title', 'Booking')
@section('active_home', 'active-page')
@section('style')
    <link rel="stylesheet" href="/assets/css/ticket.css">
@endsection
@section('content')
	<section class="rooms-warp list-view section-bg ">
    <div class="container-fluid pl-0 pr-0">
        <div class="row">
            <div class="col-lg-3">
                 <div class="sidebar-wrap">
                    <div class="widget fillter-widget">
                        <h4 class="widget-title">InforMation</h4>
                        <form action="" method="GET">
                            <div class="input-wrap">
                            	<label for="arrive-date">Name</label>
                               <input type="text" placeholder="Name"  value="{{ Auth::user()->name }}" />
                            </div>
                            <div class="input-wrap">
                            	<label for="arrive-date">Emails</label>
                               <input type="text" placeholder="Name"  value="{{ Auth::user()->email }}"/>
                            </div>
                            <div class="input-wrap">
                               <input type="hidden" placeholder="Name"  value="{{ Auth::user()->address }}"/>
                            </div>
                            <div class="input-wrap">
                            	<label for="arrive-date">Address</label>
                               <input type="text" placeholder="Name"  value="{{ Auth::user()->address }}"/>
                            </div>
                            <div class="input-wrap">
                            	<label for="arrive-date">Phone Number</label>
                               <input type="text" placeholder="Name"  value="{{ Auth::user()->phonenumber }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="sidebar-wrap">
                    <div class="widget fillter-widget">
                        <h4 class="widget-title">Your Booking</h4>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Room Name</th>
                                    <th>Image</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Date</th>
                                    <th>People</th>
                                    <th>Area</th>
                                    <th>Unit Price</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($items == null)
                                <p>No room booked</p>
                            @else
                            @foreach($items as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item['room_name']}}</td>
                                <td><img class="img-thumbnail" style="max-width: 120px !important;" src="upload/cover/{{$item['image']}}"></img></td>
                                <td>{{$item['checkin']}}</td>
                                <td>{{$item['checkout']}}</td>
                                <td>{{$item['date']}}</td>
                                <td>{{$item['amount']}}</td>
                                <td>{{$item['area']}}</td>
                                <th>{{$item['unit_price']}}</th>
                                <th>{{$item['price']}}</th>
                                <td>
                                    <form id="deleteForm" action="{{ route('booking.destroy',$item['session_id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="item delete_btn" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form></td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-3 float-right h-25">
                    <div class="input-wrap">
                        <p>Total Price : {{$totalPrice}}</p>
                            <a href="/booking/add" onclick="return confirm('Are you sure?')" type="submit" style="height: 50px;line-height: 50px;" class="btn filled-btn btn-block">Booking <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-wrap" style="height: 100%;">
                    <div class="widget fillter-widget" style="height: 100%;">
                        <h4 class="widget-title">Your Booked Room</h4>
                        @if($booked == null)
                            <p>You no book any room</p>
                        @else
                        @foreach($booked as $test)
                            <div class="cardWrap ">
                                <div class="card cardLeft">
                                    <h1>Booked Room </h1>
                                    <table class="table" style="margin-top: 50px">
                                        <thead class="thead">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Date</th>
                                            <th>Amount People</th>
                                            <th>Unit Price</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($book->where('booking_id',$test->id) as $item)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$item->room_name}}</td>
                                                <td>{{$item->checkin}}</td>
                                                <td>{{$item->checkout}}</td>
                                                <td>{{$item->amount_date}}</td>
                                                <td>{{$item->amount}}</td>
                                                <th>{{$item->unit_price}}</th>
                                                <th>{{$item->price}}</th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card cardRight">
                                    <div class="eye"></div>
                                    <div class="number">
                                        <h3>{{$book->where('booking_id',$test->id)->count()}}</h3>
                                        <span>Room</span>
                                    </div>
                                    <span class="title_book">Total Price  : {{$test->totalPrice}}</span>
                                    <span class="title_book">Booked At    : {{$test->created_at}}</span>
                                    <span class="title_book">Booking Id   : {{$test->id}}</span>
                                    <div class="barcode"></div>
                                </div>

                            </div>
                        @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    @if(Session::has('success'))
        <script>
            toastr.success("{{ session("success") }}")
        </script>
    @endif
    @if(Session::has('error'))
        <script>
            toastr.error("{{ session("error") }}")
        </script>
    @endif
@endsection

