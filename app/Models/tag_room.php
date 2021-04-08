<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag_room extends Model
{
    use HasFactory;
    protected $table ='tag_rooms';
    protected $fillable=['room_id','tag_id','tag_name'];
    protected $primaryKey = 'id';

     public function insertTag_room(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateTag_room(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteTag_room($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getALlTag_room()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdTag_room($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this->whereroom_id($id)->get();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }
}
