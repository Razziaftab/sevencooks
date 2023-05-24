<?php

namespace src;

class Starship
{
    private $name;
    private $model;
    private $cargoCapacity;
    private $maxAtmospheringSpeed;
    private $crewSize;
    private $pilots;

    public function __construct($name, $model, $cargoCapacity, $maxAtmospheringSpeed, $crewSize, $pilots)
    {
        $this->name = $name;
        $this->model = $model;
        $this->cargoCapacity = $cargoCapacity;
        $this->maxAtmospheringSpeed = $maxAtmospheringSpeed;
        $this->crewSize = $crewSize;
        $this->pilots = $pilots;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getCargoCapacity()
    {
        return $this->cargoCapacity;
    }

    public function getSpeed()
    {
        return $this->maxAtmospheringSpeed;
    }

    public function getCrewSize()
    {
        return $this->crewSize;
    }

    public function getPilots()
    {
        return $this->pilots;
    }

    /**
     * Cargo Reduces Cargo Capacity
     *
     * @param $cargo
     * @return void
     */
    public function addCargo($cargo)
    {
        $this->cargoCapacity -= $cargo;
    }
}
