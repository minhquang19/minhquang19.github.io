<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface roomDAO{
    public function getAllRoom();
    public function getByIdRoom($id);
    public function insertRoom(array $request);
    public function updateRoom(array $request, $id);
    public function deleteRoom($id);
}
