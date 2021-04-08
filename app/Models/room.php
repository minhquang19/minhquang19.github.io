<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hamcrest\Thingy;
use App\Interfaces\roomDAO;
use Illuminate\Http\Request;

class room extends Model implements roomDAO
{
    use HasFactory;
    protected $table='rooms';
    protected $primaryKey = 'id';
    protected $fillable = ['name','image','description','status','visibility','area','category_id'];

    public function insertRoom(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateRoom(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteRoom($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getAllRoom()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdRoom($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this->find($id);
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }


    public function categories()
    {
    	return $this->hasOne(category::class,'id','category_id');
    }
    public function facilities()
    {
        return $this->belongsToMany(facility::class,'facility_rooms');
    }
    public function tags()
    {
        return $this->belongsToMany(tag::class,'tag_rooms');
    }
    public function room_prices() 
    {   
        return $this->hasMany(roomPrice::class);
    }
    public function room_images()
    {
        return $this->hasMany(roomImages::class);
    }
}
