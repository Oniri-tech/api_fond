<?php

namespace App\DAO;
use PDO;
use App\Entities\Recipe;
use App\Interfaces\IDAO_recipe;

class DAO_recipe implements IDAO_recipe{

    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=fond_placard', 'root', '');
    }

    public function addRecipe(string $name, string $category, string $picture, int $score)
    {
        $query = $this->pdo->prepare('INSERT INTO recipe VALUES ('.$name.','.$category.','.$picture.','.$score.')');
        $query->execute();
        if ($query) {
            return 'Recette '.$name.' ajouté avec succès';
        }
        else {
            return 'Echec de l\'ajout de la recette';
        }
    }

    public function getAll(){

        $query = $this->pdo->query('SELECT * FROM recipe');
        $result = $query->fetchAll();
        $liste = [];
        foreach ($result as $line) {
            $recipe = $this->sqlToRecipe($line);
            array_push($liste, $recipe);
        }

        return $liste;
    }

    public function getById(int $id){

        $query = $this->pdo->query('SELECT * FROM recipe WHERE id='.$id);
        $result = $query->fetch();

        if ($result) {
            return $this->sqlToRecipe($result);
        }
    }

    public function getByName(string $name){

        $query = $this->pdo->query('SELECT * FROM recipe WHERE name="'.$name.'"');

        $result = $query->fetch();

        if ($result) {
            return $this->sqlToRecipe($result);
        }
    }

    public function update(int $id, string $name, string $category, string $picture, int $score)
    {
        $query = $this->pdo->prepare('UPDATE ingredient SET name='.$name.',
                                                            category='.$category.',
                                                            picture='.$picture.',
                                                            score='.$score.'
                                                        WHERE id ='.$id);
        $query->execute();

        if ($query) {
            return 'Recette '.$name.' modifiée avec succès';
        }
        else {
            return 'Echec de la modification de la recette';
        }
    }

    public function delete(int $id)
    {
        $requete = $this->pdo->prepare('DELETE FROM recipe WHERE id='.$id);
        $requete->execute();
    }

    public function sqlToRecipe($line) : Recipe 
    {
        return new Recipe($line['id'], $line['name'], $line['category'], $line['picture'], $line['score']);
    }
}

?>