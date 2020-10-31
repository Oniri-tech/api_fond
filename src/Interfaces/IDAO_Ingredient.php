<?php
namespace App\Interfaces;

use App\Entities\Ingredient;

interface IDAO_Ingredient {

    function addIngredient(string $name);


    function getAll();

    function getById(int $id);

    function getByName(string $name);


    function update(int $id, string $name);


    function delete(int $id);

}

?>