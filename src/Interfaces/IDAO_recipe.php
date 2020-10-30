<?php

namespace App\Interfaces;
use App\Entities\Recipe;
    interface IDAO_recipe {

        function addRecipe(string $name, string $category, string $picture, int $score);

        function getAll();
        function getById(int $id);
        function getByName(string $name);

        function update(Recipe $recipe);

        function delete(int $id);
    }

?>