<?php

namespace App\Models;

use App\Interfaces\blogDAO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model implements blogDAO
{
    use HasFactory;
    protected $table='blogs';
    protected $primaryKey = 'id';
    protected $fillable = ['title','creator','content','note','image'];

    public function insertBlog(array $request)
    {
        // TODO: Implement inserBlog() method.
        try {
            $this->create($request);
            return true;
        }catch (\Exception $e){
            dd($e);
        }
    }

    public function updateBlog(array $request, $id)
    {
        // TODO: Implement updateBlog() method.
        try {
            $this->find($id)->update($request);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function deleteBlog($id)
    {
        // TODO: Implement deleteBlog() method.
        try {
            $this->find($id)->delete($id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getAllBlog()
    {
        // TODO: Implement getAllBlog() method.
        try {
            return $this->all();
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }

    public function getByIdBlog($id)
    {
        // TODO: Implement getByIdBlog() method.
        try {
            return $this->find($id);
        }catch (\Exception $e){
            return new \Exception('Server error');
        }
    }
}
