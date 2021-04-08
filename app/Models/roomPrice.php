<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hamcrest\Thingy;
use App\Interfaces\priceDAO;
use Illuminate\Http\Request;

class roomPrice extends Model implements priceDAO
{
    use HasFactory;
    protected $table='room_prices';
    protected $primaryKey = 'id';
    protected $fillable =['room_id','Weekends','Weekly','Mothly','Nightly'];

    public function insertPrices(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updatePrices(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deletePrices($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getAllPrices()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdPrices($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this::whereroom_id($id)->get();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function room()
    {
    	return $this->belongsTo(room::class);
    }
}
