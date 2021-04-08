<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface tagDAO{
    public function getAllTag();
    public function getByIdTag($id);
    public function insertTag(array $request);
    public function updateTag(array $request, $id);
    public function deleteTag($id);
}
