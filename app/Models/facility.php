<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\facilityDAO;

class facility extends Model implements facilityDAO
{
    use HasFactory;
    protected $table='facilities';
    protected $fillable=['name'];
    protected $primaryKey = 'id';

    public function insertFacility(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateFacility(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteFacility($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }


    public function getALlFacility()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdFacility($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this->find($id);
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }
    public function getById($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this->find($id);
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }
    public function rooms()
    {
    	return $this->belongsToMany(room::class,'facility_rooms');
    }
}
