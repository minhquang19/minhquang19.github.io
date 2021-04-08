<?php

namespace App\Models;

use App\Interfaces\serviceDAO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model implements serviceDAO
{
    use HasFactory;
    protected $table='services';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','content','image','icon'];

    public function getAllService()
    {
        // TODO: Implement getAllService() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdService($id)
    {
        // TODO: Implement getByIdService() method.
        try {
            return $this->find($id);
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function insertService(array $request)
    {
        // TODO: Implement insertService() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            dd($e);
        }
    }

    public function updateService(array $request, $id)
    {
        // TODO: Implement updateService() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteService($id)
    {
        // TODO: Implement deleteService() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
}
