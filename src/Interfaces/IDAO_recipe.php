<?php

namespace App\Interfaces;

interface IDAO_recipe {

    function addRecipe(string $name, string $category, string $picture, int $score);

    function getAll();
    function getById(int $id);
    function getByName(string $name);

    function update(int $id, string $name, string $category, string $picture, int $score);

    function delete(int $id);
}

?>