<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$kwota = $_REQUEST ['kwota'];
$lata = $_REQUEST ['lata'];
$ileprocent = $_REQUEST ['ileprocent'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($kwota) && isset($lata) && isset($ileprocent))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $kwota == "") {
	$messages [] = 'Nie podano liczby 1';
}
if ( $lata == "") {
	$messages [] = 'Nie podano liczby 2';
}
if ( $ileprocent == "") {
    $messages [] = 'Nie podano oprocentowania';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $kwota i $y są liczbami całkowitymi
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $lata )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}

    if (! is_numeric( $ileprocent )) {
        $messages [] = 'Trzecia wartość nie jest liczbą całkowitą';
    }

}

if (empty( $messages )) {

    // sprawdzenie, czy $kwota i $y są liczbami całkowitymi
    if ($kwota<=0) {
        $messages [] = 'Pierwsza wartość nie może być liczbą ujemną';
    }

    if ($lata<=0) {
        $messages [] = 'Druga wartość nie może być liczbą ujemną';
    }

    if ($ileprocent<=0) {
        $messages [] = 'Trzecia wartość nie może być liczbą ujemną';
    }

}
// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów

    //konwersja parametrów na int
    $kwota = intval($kwota);
    $lata = intval($lata);
    $result = round(policzMiesecznaPlatnosc($kwota, $lata, $ileprocent));
}

function policzMiesecznaPlatnosc($kwota, $lata, $ileprocent) {
    //Obliczenie miesięcznej raty
    $miesieczne_ileprocent = $ileprocent / 100 / 12;
    $miesiace = $lata * 12;
    return ($kwota * $miesieczne_ileprocent) / (1 - pow(1 + $miesieczne_ileprocent, -$miesiace));
}
// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$kwota,$lata,$ileprocent,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';