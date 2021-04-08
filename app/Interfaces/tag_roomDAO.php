<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface tag_roomDAO{
    public function getAllTag_room();
    public function getByIdTag_room($id);
    public function insertTag_room(array $request);
    public function updateTag_room(array $request, $id);
    public function deleteTag_room($id);
}
