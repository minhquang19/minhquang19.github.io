<?php

namespace App\Models;

use App\Models\User;
use App\Models\bookingDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table='bookings';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','totalPrice'];

    public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function bookingDetail()
    {
        return $this->hasMany(bookingDetail::class);
    }

}
