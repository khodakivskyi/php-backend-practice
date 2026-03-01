<?php
require_once('utils/autoload.php');
require_once('utils/printLine.php');

/*
use views\UserView;
use models\UserModel;
$obj1 = new UserModel();
$obj2 = new UserView();
$obj1->index();
$obj2->index();
*/

use models\Circle;

$circle = new Circle(10, 15, 5);

printLine("X: " . $circle->getX());
printLine("Y: " . $circle->getY());
printLine("Radius: " . $circle->getRadius());

$circle->setX(20);
$circle->setY(25);
$circle->setRadius(10);

printLine("Нові координати X: " . $circle->getX());
printLine("Нові координати Y: " . $circle->getY());
printLine("Новий радіус: " . $circle->getRadius());

printLine($circle);

//6
$circle2 = new Circle(28, 25, 10);
printLine(var_export($circle->circlesIntersect($circle2), true));

$circle3 = new Circle(50, 25, 10);
printLine(var_export($circle->circlesIntersect($circle3), true));

//7
use utils\FileReader;

$files = [
    'file1.txt',
    'file2.txt',
    'file3.txt',
];

foreach ($files as $file) {
    printLine("Читання $file:");
    printLine(fileReader::ReadFile($file));
}

foreach ($files as $i => $file) {
    $text = "Тестовий рядок для $file";
    fileReader::UpdateFile($file, $text);
    printLine("Після UpdateFile($file):");
    printLine(fileReader::ReadFile($file));
}

foreach ($files as $file) {
    fileReader::DeleteFile($file);
    printLine("Після DeleteFile($file):");
    printLine(fileReader::ReadFile($file));
}

//8
use models\Human;
use models\Student;
use models\Programmer;

printLine("- Student:");

$student = new Student(165, 60, 19, "KNU", 1);

printLine($student->getUniversityName());
printLine($student->getCourse());
printLine($student->getHeight());
printLine($student->getWeight());

$student->setHeight(168);
$student->setWeight(62);
$student->increaseCourse();

printLine($student->getHeight());
printLine($student->getWeight());
printLine($student->getCourse());
printLine("");

printLine("- Programmer:");

$programmer = new Programmer(180, 75.5, 25, ['PHP', 'JavaScript'], 3);

printLine(print_r($programmer->getLanguages(), true));
printLine($programmer->getExperience());
printLine($programmer->getHeight());
printLine($programmer->getWeight());

$programmer->addLanguage('Python');
$programmer->setHeight(182);
$programmer->setWeight(78);

printLine(print_r($programmer->getLanguages(), true));
printLine($programmer->getHeight());
printLine($programmer->getWeight());

//9
printLine($student->birthChild());
printLine($programmer->birthChild());

//10
printLine($student->roomClean());
printLine($student->kitchenClean());

printLine($programmer->roomClean());
printLine($programmer->kitchenClean());