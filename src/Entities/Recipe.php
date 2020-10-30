<?php
namespace App\Entities;

use JsonSerializable;

class Recipe implements JsonSerializable {

    private $id;
    private $name;
    private $category;
    private $picture;
    private $score;
    
    public function __construct(int $id, string $name, string $category, string $picture, int $score)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->picture = $picture;
        $this->score = $score;
    }

    public function jsonSerialize()
    {
        return ['id'=>$this->id,'name'=>$this->name,'category'=>$this->category,'picture'=>$this->picture,'score'=>$this->score];
    }
}

?>