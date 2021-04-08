<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface imagesDAO{
    public function getALlImages();
    public function getByIdImages($id);
    public function insertImages(array $request);
    public function updateImages(array $request, $id);
    public function deleteImages($id);
}
