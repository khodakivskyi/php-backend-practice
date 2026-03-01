<?php

namespace models;

class Student extends Human
{
    private string $universityName;
    private int $course;

    public function __construct($height, $weight, $age, $universityName, $course)
    {
        parent::__construct($height, $weight, $age);
        $this->universityName = $universityName;
        $this->course = $course;
    }

    public function getUniversityName(): string
    {
        return $this->universityName;
    }

    public function getCourse(): int
    {
        return $this->course;
    }

    public function setUniversityName(int $universityName): void
    {
        $this->universityName = $universityName;
    }

    public function setCourse(float $course): void
    {
        $this->course = $course;
    }

    public function increaseCourse(): void
    {
        $this->course++;
    }

    protected function childBirthNotification(): string
    {
        return "Student child birth";
    }

    public function roomClean(): string{
        return "Student cleaning the room";
    }
    public function kitchenClean(): string{
        return "Student cleaning the kitchen";
    }
}