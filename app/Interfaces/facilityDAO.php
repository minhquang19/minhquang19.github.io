<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface facilityDAO{
    public function getAllFacility();
    public function getByIdFacility($id);
    public function insertFacility(array $request);
    public function updateFacility(array $request, $id);
    public function deleteFacility($id);
}
