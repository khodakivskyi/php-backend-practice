<?php

namespace models;

use interfaces\IHouseClean;

abstract class Human implements IHouseClean
{
    private int $height;
    private float $weight;
    private int $age;

    public function __construct($height, $weight, $age)
    {
        $this->height = $height;
        $this->weight = $weight;
        $this->age = $age;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function birthChild(): string
    {
        return $this->childBirthNotification();
    }

    abstract protected function childBirthNotification(): string;
    abstract public function roomClean(): string;
    abstract public function kitchenClean(): string;
}