<?php
namespace App\Entities;

use JsonSerializable;

class Ingredient implements JsonSerializable {

    private $id;
    private $name;
    
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function jsonSerialize()
    {
        return ['id'=>$this->id,'name'=>$this->name];
    }
}


?>