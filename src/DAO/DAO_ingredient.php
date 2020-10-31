<?php
namespace App\DAO;

use PDO;
use App\Entities\Ingredient;
use App\Interfaces\IDAO_Ingredient;
class DAO_ingredient implements IDAO_Ingredient{

    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=fond_placard', 'root', '');
    }

    public function addIngredient(string $name)
    {
        $query = $this->pdo->prepare('INSERT INTO ingredient VALUES ('.$name.')');
        $query->execute();
        if ($query) {
            return 'Ingrédient '.$name.' ajouté avec succès';
        }
        else {
            return 'Echec de l\'ajout de l\'ingrédient';
        }
        
    }

    public function getAll()
    {
        $query =$this->pdo->query("SELECT * FROM ingredient");
        $result = $query->fetchAll();
        $liste = [];
        foreach ($result as $line) {
            $recipe = $this->sqlToIngredient($line);
            array_push($liste, $recipe);
        }

        return $liste;

    }

    public function getById(int $id)
    {
        $query = $this->pdo->query('SELECT * FROM ingredient WHERE id='.$id);
        $result = $query->fetch();

        if ($result) {
            return $this->sqlToIngredient($result);
        }

    }

    public function getByName(string $name)
    {
        $query = $this->pdo->query('SELECT * FROM ingredient WHERE name="'.$name.'"');
        $result = $query->fetch();

        if ($result) {
            return $this->sqlToIngredient($result);
        }
    }

    public function update(Ingredient $ingredient)
    {
        $requete = $this->pdo->prepare('UPDATE ingredient SET name='.$ingredient->name.' WHERE id ='.$ingredient->id);
        $requete->execute();
    }

    public function delete(int $id)
    {
        $requete = $this->pdo->prepare('DELETE FROM ingredient WHERE id='.$id);
        $requete->execute();
    }

    public function sqlToIngredient($line) : Ingredient
    {
        return new Ingredient($line['id'], $line['name']);
    }

}

?>