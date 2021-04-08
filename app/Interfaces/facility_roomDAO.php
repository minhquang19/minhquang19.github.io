<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface facility_roomDAO{
    public function getAllFacility_room();
    public function getByIdFacility_room($id);
    public function insertFacility_room(array $request);
    public function updateFacility_room(array $request, $id);
    public function deleteFacility_room($id);
}
