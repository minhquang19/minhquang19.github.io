<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\imagesDAO;
use Illuminate\Http\Request;

class roomImage extends Model
{
    use HasFactory;
    protected $table ='room_images';
    protected $primaryKey = 'id';
    protected $fillable =['room_id','name'];


    public function insertImages(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateImages(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteImages($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getAllImages()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdImages($id)
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
