<?php

namespace models;

class Circle
{
    private int $x;
    private int $y;
    private int $radius;

    public function __construct($x, $y, $radius)
    {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function getX(): int
    {
        return $this->x;
    }
    public function getY(): int
    {
        return $this->y;
    }
    public function getRadius(): int
    {
        return $this->radius;
    }
    public function setX(int $x): void
    {
        $this->x = $x;
    }
    public function setY(int $y): void
    {
        $this->y = $y;
    }
    public function setRadius(int $radius): void
    {
        if ($radius > 0) {
            $this->radius = $radius;
        }
    }

    public function __toString(): string
    {
        return "Коло з центром в ($this->x, $this->y) і радіусом $this->radius";
    }

    public function circlesIntersect(Circle $other): bool
    {
        $dx = $other->x - $this->x;
        $dy = $other->y - $this->y;

        return ($dx * $dx + $dy * $dy) <= (($this->radius + $other->radius) * ($this->radius + $other->radius));
    }
}