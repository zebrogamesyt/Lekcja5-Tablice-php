
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Tablice PHP - zadania</title>
</head>
<body>

<h1>Zadania z tablic w PHP</h1>

<?php


echo "<h2>Zadanie 1</h2>";

$tab1 = array(7, 3, 1, 6, 9, 5, 4, 10, 2, 2);

echo "Tablica tab1: ";
print_r($tab1);

echo "<br>5 komórka: " . $tab1[4];

$tab1[6] = 12;

$tab2 = array();
$tab2 = $tab1;

$tab3 = array();

for ($i = 0; $i < count($tab1); $i++) {
    $tab3[$i] = $tab1[$i] + $tab2[$i];
}

echo "<br>Tablica tab3: ";
print_r($tab3);

$tab2 = array_reverse($tab1);

echo "<br>Tablica tab2 w odwrotnej kolejności: ";
print_r($tab2);



echo "<h2>Zadanie 2 - tablica liczb podanych przez użytkownika</h2>";

?>

<form method="post">
    Podaj liczby oddzielone przecinkami:
    <input type="text" name="liczby">
    <input type="submit" value="Wyślij liczby">
</form>

<?php

if (isset($_POST["liczby"]) && $_POST["liczby"] != "") {

    $tab = explode(",", $_POST["liczby"]);
    $tab = array_map('intval', $tab);

    echo "<br>Tablica: ";
    print_r($tab);

    echo "<br>Najmniejszy element: " . min($tab);
    echo "<br>Największy element: " . max($tab);

    echo "<br>Średnia: " . (array_sum($tab) / count($tab));

    echo "<br>Ilość wystąpień cyfry 3: " .
        substr_count(implode("", $tab), "3");

    sort($tab);

    echo "<br>Tablica posortowana rosnąco: ";
    print_r($tab);

    $ile = count($tab);

    if ($ile % 2 == 0) {
        $mediana = ($tab[$ile / 2 - 1] + $tab[$ile / 2]) / 2;
    } else {
        $mediana = $tab[floor($ile / 2)];
    }

    echo "<br>Mediana: " . $mediana;

    echo "<br>3 najmniejsze liczby: ";
    print_r(array_slice($tab, 0, min(3, $ile)));

    echo "<br>3 największe liczby: ";
    print_r(array_slice($tab, -min(3, $ile)));

    echo "<br>Elementy podniesione do kwadratu: ";

    $kwadraty = array();

    foreach ($tab as $liczba) {
        $kwadraty[] = $liczba * $liczba;
    }

    print_r($kwadraty);

    $parzyste = 0;
    $nieparzyste = 0;
    $podzielne3 = 0;

    foreach ($tab as $liczba) {

        if ($liczba % 2 == 0) {
            $parzyste++;
        } else {
            $nieparzyste++;
        }

        if ($liczba % 3 == 0) {
            $podzielne3++;
        }
    }

    echo "<br>Liczby parzyste: " . $parzyste;
    echo "<br>Liczby nieparzyste: " . $nieparzyste;
    echo "<br>Liczby podzielne przez 3: " . $podzielne3;
}



echo "<h2>Zadanie 3 - litery</h2>";

?>

<form method="post">
    Podaj 10-literowy wyraz:
    <input type="text" name="wyraz" maxlength="10">
    <input type="submit" value="Wyślij">
</form>

<?php

if (isset($_POST["wyraz"]) && $_POST["wyraz"] != "") {

    $wyraz = $_POST["wyraz"];

    if (strlen($wyraz) == 10) {

        $tabLitery = str_split($wyraz);

        echo "<br>Tablica liter: ";
        print_r($tabLitery);

        for ($i = 0; $i < 10; $i++) {

            if (ctype_upper($tabLitery[$i])) {
                $tabLitery[$i] = strtolower($tabLitery[$i]);
            } else {
                $tabLitery[$i] = strtoupper($tabLitery[$i]);
            }
        }

        echo "<br>Zamienione litery: ";
        print_r($tabLitery);

        shuffle($tabLitery);

        echo "<br>Losowa kolejność: ";
        print_r($tabLitery);

    } else {
        echo "Wyraz musi mieć dokładnie 10 liter.";
    }
}



echo "<h2>Zadanie 4 - tablica 100 losowych liczb</h2>";

$A = array();

for ($i = 0; $i < 100; $i++) {
    $A[$i] = rand(1, 100);
}

echo "Tablica A: ";
print_r($A);

$max = max($A);

echo "<br>Największa liczba: " . $max;
echo "<br>Ilość wystąpień największej liczby: " .
    count(array_keys($A, $max));

echo "<br>Liczby nieparzyste: ";

foreach ($A as $liczba) {
    if ($liczba % 2 != 0) {
        echo $liczba . " ";
    }
}

echo "<br><br>Liczby z komórek o nieparzystych indeksach: ";

for ($i = 1; $i < 100; $i += 2) {
    echo $A[$i] . " ";
}

echo "<br><br>Liczby z przedziału <5, 15): ";

$ile = 0;

foreach ($A as $liczba) {
    if ($liczba >= 5 && $liczba < 15) {
        echo $liczba . " ";
        $ile++;
    }
}

echo "<br>Ilość tych liczb: " . $ile;



?>

<h3>Podaj liczbę a</h3>

<form method="post">
    Liczba a:
    <input type="number" name="a">
    <input type="submit" value="Szukaj">
</form>

<?php

if (isset($_POST["a"])) {

    $a = (int)$_POST["a"];
    $najblizsza = $A[0];

    foreach ($A as $liczba) {
        if (abs($liczba - $a) < abs($najblizsza - $a)) {
            $najblizsza = $liczba;
        }
    }

    echo "Liczba najbliższa do " . $a . ": " . $najblizsza;
}



$min = min($A);
$indeks = array_search($min, $A);

echo "<br><br>Najmniejsza liczba: " . $min;

if ($indeks > 0) {
    echo "<br>Poprzednik minimum: " . $A[$indeks - 1];
} else {
    echo "<br>Minimum znajduje się na pierwszej pozycji.";
}

if ($indeks < 99) {
    echo "<br>Następnik minimum: " . $A[$indeks + 1];
} else {
    echo "<br>Minimum znajduje się na ostatniej pozycji.";
}



$B = array();

foreach ($A as $liczba) {
    if ($liczba > 10) {
        $B[] = $liczba;
    }
}

echo "<br><br>Tablica z liczbami większymi od 10: ";
print_r($B);



$C = array();
$suma = 0;

for ($i = 0; $i < 100; $i++) {
    $suma += $A[$i];
    $C[$i] = $suma;
}

echo "<br><br>Tablica sum częściowych: ";
print_r($C);


$D = $A;

rsort($D);

echo "<br><br>Tablica posortowana malejąco: ";
print_r($D);



echo "<br><br>Liczby występujące przynajmniej 3 razy: ";

$czestotliwosc = array_count_values($A);

foreach ($czestotliwosc as $liczba => $ilosc) {
    if ($ilosc >= 3) {
        echo $liczba . " (" . $ilosc . " razy) ";
    }
}



echo "<h2>Zadanie 5 - ciągi liczb</h2>";

$F = array();
$P = array();
$T = array();
$R = array();


$F[0] = 0;
$F[1] = 1;

for ($i = 2; $i < 100; $i++) {
    $F[$i] = $F[$i - 1] + $F[$i - 2];
}

echo "<br><br>Ciąg Fibonacciego: ";
print_r($F);



for ($i = 0; $i < 100; $i++) {
    $P[$i] = pow(2, $i);
}

echo "<br><br>Potęgi liczby 2: ";
print_r($P);


for ($i = 0; $i < 100; $i++) {
    $T[$i] = ($i + 1) * 3;
}

echo "<br><br>Ciąg 3, 6, 9, 12...: ";
print_r($T);



for ($i = 0; $i < 100; $i++) {
    $R[$i] = pow(2, $i + 1);
}

echo "<br><br>Ciąg 2, 4, 8, 16, 32...: ";
print_r($R);

?>

</body>
</html>
