<?php
namespace App\Interfaces;

interface blogDAO{
    public function getALlBlog();
    public function getByIdBlog($id);
    public function insertBlog(array $request);
    public function updateBlog(array $request, $id);
    public function deleteBlog($id);
}
