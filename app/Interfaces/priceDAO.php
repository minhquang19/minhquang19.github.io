<?php
namespace App\Interfaces;

interface priceDAO{
    public function getALlPrices();
    public function getByIdPrices($id);
    public function insertPrices(array $request);
    public function updatePrices(array $request, $id);
    public function deletePrices($id);
}
