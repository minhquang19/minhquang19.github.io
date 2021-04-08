<?php
namespace App\Interfaces;

interface categoryDAO{
    public function getALlCategory();
    public function getByIdCategory($id);
    public function insertCategory(array $request);
    public function updateCategory(array $request, $id);
    public function deleteCategory($id);
}
