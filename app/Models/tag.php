<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    protected $table='tags';
    protected $fillable = ['tagname'];

    public function insertTag(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateTag(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteTag($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getALlTag()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdTag($id)
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
    	return $this->belongsToMany(room::class,'tag_rooms');
    }
}
