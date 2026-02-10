<?php
echo "<p>Task02</p>";
echo "<pre>
    Полину в мріях в купель океану,
    Відчую <b>шовковистість</b> глибини,
     Чарівні мушлі з дна собі дістану,
        Щоб <b><i>взимку</i></b>
          <u>тішили</u>
              мене
                 вони…
    </pre>";

echo "<p>Task03</p>";
$uah_count = 1500;
$change = 45;
$result_count = floor($uah_count / $change);
echo "$uah_count грн. можна обміняти на $result_count доларів";

echo "<p>Task04</p>";
$seasons = ["winter", "spring", "summer", "autumn"];
$month = 4;
if ($month == 12 || $month <= 2) echo "Зараз $seasons[0]";
elseif ($month <= 5) echo "Зараз $seasons[1]";
elseif ($month <= 8) echo "Зараз $seasons[2]";
elseif ($month <= 11) echo "Зараз $seasons[3]";
else echo "Невірний місяць";

echo "<p>Task05</p>";
$char = 'g';
$var1 = "Голосний";
$var2 = "Приголосний";
switch (strtolower($char)) {
    case "a":
    case "o":
    case "i":
    case "y":
    case "u":
    case "e":
        echo $var1;
        break;
    default:
        echo $var2;
}

echo "<p>Task06</p>";
$number = mt_rand(100, 999);
echo "Число: {$number}<br>";

$number1 = intdiv($number, 100);
$number2 = intdiv($number % 100, 10);
$number3 = $number % 10;

$sum = $number1 + $number2 + $number3;
echo "<p>Сума цифр: $sum</p>";

$reversed = $number3 * 100 + $number2 * 10 + $number1;
echo "<p>Зворотне число: $reversed</p>";

$digits = [$number1, $number2, $number3];
rsort($digits);

$maxNumber = $digits[0] * 100 + $digits[1] * 10 + $digits[2];
echo "<p>Найбільше можливе число: $maxNumber</p>";

echo "<p>Task07</p>";

echo "<p>Task07.1</p>";
function drawTable($rows, $cols)
{
    if ($rows <= 0 || $cols <= 0) {
        echo "Введіть інші розміри";
        return;
    }
    $px_count = "40px";

    echo "<table border='1' style='border-collapse: collapse;'>";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $r = mt_rand(0, 255);
            $g = mt_rand(0, 255);
            $b = mt_rand(0, 255);
            $color = "rgb($r, $g, $b)";
            echo "<td style='background-color:$color; width: $px_count; height: $px_count'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

drawTable(4, 10);

echo "<p>Task07.2</p>";
function drawSquare($count){
    if($count <= 0){
        echo "Введіть іншу к-сть квадратів";
        return;
    }

    echo "<div style='position: relative; width: 100%; height: 800px; background-color: black;'>";
    for ($i = 0; $i < $count; $i++) {
        $size = mt_rand(20, 100);
        $top = mt_rand(0, 300);
        $left = mt_rand(0, 80);
        echo "<div style='
            position: absolute;
            width: {$size}px;
            height: {$size}px;
            background-color: red;
            top: {$top}px;
            left: {$left}%;
            border: 1px solid white;
        '></div>";
    }
    echo "</div>";
}

drawSquare(7);
