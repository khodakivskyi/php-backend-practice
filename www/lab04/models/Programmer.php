<?php

namespace models;

class Programmer extends Human
{
    private array $languages;
    private int $experience;

    public function __construct(int $height, float $weight, int $age, array $languages, int $experience)
    {
        parent::__construct($height, $weight, $age);
        $this->languages = $languages;
        $this->experience = $experience;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function setLanguages(array $languages): void
    {
        $this->languages = $languages;
    }

    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }

    public function addLanguage(string $language): void
    {
        if (!in_array($language, $this->languages)) {
            $this->languages[] = $language;
        }
    }

    protected function childBirthNotification(): string
    {
        return "Programmer child birth";
    }

    public function roomClean(): string{
        return "Programmer cleaning the room";
    }
    public function kitchenClean(): string{
        return "Programmer cleaning the kitchen";
    }
}