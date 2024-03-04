<?php
// calc.php - kontroler

include 'calc_view.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kwota = $_POST['kwota'];
    $lata = $_POST['lata'];
    $ileprocent = $_POST['ileprocent'];

    //Obliczenia
    $miesieczna_platnosc = policzMiesecznaPlatnosc($kwota, $lata, $ileprocent);

    //Wyświetlenie wyniku
    echo "Miesięczna rata: $miesieczna_platnosc";
}

function policzMiesecznaPlatnosc($kwota, $lata, $ileprocent) {
    //Obliczenie miesięcznej raty
    $miesieczne_ileprocent = $ileprocent / 100 / 12;
    $miesiace = $lata * 12;
    $miesieczna_platnosc = ($kwota * $miesieczne_ileprocent) / (1 - pow(1 + $miesieczne_ileprocent, -$miesiace));

    return $miesieczna_platnosc;
}
?>
