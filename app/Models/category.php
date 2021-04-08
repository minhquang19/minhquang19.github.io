<?php

namespace App\Models;

use App\Interfaces\categoryDAO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class category extends Model implements categoryDAO
{
    use HasFactory;
	protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','max_people','description'];

    public function insertCategory(array $request)
    {
        // TODO: Implement insertCategory() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function updateCategory(array $request, $id)
    {
        // TODO: Implement updateCategory() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteCategory($id)
    {
        // TODO: Implement deleteCategory() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getALlCategory()
    {
        // TODO: Implement getALlCategory() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdCategory($id)
    {
        // TODO: Implement getByIdCategory() method.
        try {
            return $this->find($id);
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function rooms(){
        return $this->hasMany(room::class,'category_id','id');
    }
}

