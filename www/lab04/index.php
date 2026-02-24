<?php
require_once('utils/autoload.php');

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

echo "X: " . $circle->getX() . PHP_EOL;
echo "Y: " . $circle->getY() . PHP_EOL;
echo "Radius: " . $circle->getRadius() . PHP_EOL;

$circle->setX(20);
$circle->setY(25);
$circle->setRadius(10);

echo "Нові координати X: " . $circle->getX() . PHP_EOL;
echo "Нові координати Y: " . $circle->getY() . PHP_EOL;
echo "Новий радіус: " . $circle->getRadius() . PHP_EOL;

echo $circle . PHP_EOL;
