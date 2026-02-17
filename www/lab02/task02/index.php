<?php
//2.1
function findDuplicates($arr)
{
    $counts = array_count_values($arr);

    $duplicates = [];
    foreach ($counts as $value => $count) {
        if ($count > 1) {
            $duplicates[] = $value;
        }
    }

    return $duplicates;
}

echo "<h1>2.1</h1>";
$myArr = [1, 2, 3, 2, 4, 4, 5, 3, 6, 1, 7];
$nums = findDuplicates($myArr);
echo "Повторювані елементи: " . implode(", ", $nums);

//2.2
function generatePetName($syllables, $length = 3)
{
    $name = "";

    for ($i = 0; $i < $length; $i++) {
        $rndInt = random_int(0, count($syllables) - 1);
        $name .= $syllables[$rndInt];
    }

    return ucfirst($name);
}

$syllables = ["mi", "la", "ro", "tu", "ki", "pa", "no", "sa", "bo", "chi"];

$catName = generatePetName($syllables, 2);
$dogName = generatePetName($syllables, 4);

echo "<h1>2.2</h1>";
echo "Кішка: <p>$catName</p>";
echo "Собака: <p>$dogName</p>";

//2.3
function createArray(){
    $arrLen = random_int(3,7);
    $arr = [];
    for ($i = 0; $i < $arrLen; $i++) {
        array_push($arr, random_int(10, 20));
    }

    return $arr;
}

function mergeArrays($arr1, $arr2){
    $newArr=[];
    $newArr = array_merge($arr1, $arr2);

    $duplicates = findDuplicates($newArr);

    foreach ($duplicates as $duplicate) {
        foreach ($newArr as $value) {
            if ($duplicate == $value) {
                $key = array_search($value, $newArr);
                if ($key !== false) unset($newArr[$key]);
            }
        }
    }

    sort($newArr);
    return $newArr;

}

$arr1 = createArray();
$arr2 = createArray();
$arr3 = mergeArrays($arr1, $arr2);
echo "<h1>2.3</h1>";
echo "Перший масив: " . implode(", ", $arr1) . "<br>";
echo "Другий масив: " . implode(", ", $arr2) . "<br>";
echo "Отриманий масив: " . implode(", ", $arr3);

//2.4
$users = [
    "Olena" => 25,
    "Ivan"  => 30,
    "Sofia" => 22,
    "Petro" => 28,
    "Anna"  => 27,
    "Ben"  => 777,
];

$params = [
    "Name" => 1,
    "Age" => 2,
];

function sortUsersByParam($users, $paramId){
    switch ($paramId) {
        case 1:
            ksort($users);
            break;

        case 2:
            asort($users);
            break;
    }

    return $users;
}

$sortedUsersByNames = sortUsersByParam($users, $params["Name"]);
$sortedUsersByAges = sortUsersByParam($users, $params["Age"]);
echo "<h1>2.4</h1>";
echo "sortedUsersByNames: " . implode(", ", array_keys($sortedUsersByNames)) . "<br>";
echo "sortedUsersByAges: "  . implode(", ", array_map(fn($name, $age) => "$name($age)",
        array_keys($sortedUsersByAges), $sortedUsersByAges)) . "<br>";