<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface serviceDAO{
    public function getAllService();
    public function getByIdService($id);
    public function insertService(array $request);
    public function updateService(array $request, $id);
    public function deleteService($id);
}
