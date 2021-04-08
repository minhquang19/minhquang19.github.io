<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class facility_room extends Model
{
    use HasFactory;
    protected $table ='facility_rooms';
    protected $fillable=['room_id','facility_id','facility_name','amount'];
    protected $primaryKey = 'id';

     public function insertFacility_room(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateFacility_room(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteFacility_room($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getALlFacility_room()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdFacility_room($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this->whereroom_id($id)->get();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    
}
