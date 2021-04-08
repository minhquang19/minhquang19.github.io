<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\room;
use DB;
use app\Models\booking;
use app\Models\User;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $room = DB::table('rooms')->get()->count();
        $booking = DB::table('bookings')->get()->count();
        $user = DB::table('users')->get()->count();
        $list = DB::table('booking_details')->orderBy('created_at','DESC')->get();
        $blog = DB::table('blogs')->get()->count();
        return view('admins.index',compact('room','booking','user','list','blog'));

    }
    public function store(Request $request)
    {
       if(!Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember')))
       {
            throw ValidationException::withMessages([
                'email'=> 'Invalid email or password'
            ]);
       }
       return redirect()->intended('/admin/home');
    }
    public function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect()->intended('/admin/login');
    }
}
