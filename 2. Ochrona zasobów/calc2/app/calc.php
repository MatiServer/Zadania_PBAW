<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$kwota,&$lata,&$ileprocent){
	$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$lata = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
	$ileprocent = isset($_REQUEST['ileprocent']) ? $_REQUEST['ileprocent'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota,&$lata,&$ileprocent,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($kwota) && isset($lata) && isset($ileprocent))) {
		// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		// teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $kwota == "") {
		$messages [] = 'Nie podano kwoty';
	}
	if ( $lata == "") {
		$messages [] = 'Nie podano liczby lat';
	}
    if ( $ileprocent == "") {
        $messages [] = 'Nie podano oprocentowania';
    }

	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $messages ) != 0) return false;
	
	// sprawdzenie, czy $kwota i $y są liczbami całkowitymi
	if (! is_numeric( $kwota )) {
		$messages [] = 'Wartość kwoty nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $lata )) {
		$messages [] = 'Wartość lat nie jest liczbą całkowitą';
	}

    if (! is_numeric( $ileprocent )) {
        $messages [] = 'Wartość oprocentowania nie jest liczbą całkowitą';
    }

    if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$kwota,&$lata,&$ileprocent,&$messages,&$result){
	global $role;
	
	//konwersja parametrów na int
	$kwota = intval($kwota);
	$lata = intval($lata);
    $ileprocent = intval($ileprocent);

	//wykonanie operacji
    if($ileprocent <= 10 ){
        $result = round(policzMiesecznaPlatnosc($kwota, $lata, $ileprocent));
    }
    if ($ileprocent > 10 && $role == 'employee'){
        $messages [] = 'Tylko menadżer może ustawić tak wysokie oprocentowanie!';
    } else{
        $result = round(policzMiesecznaPlatnosc($kwota, $lata, $ileprocent));
    }
}

function policzMiesecznaPlatnosc($kwota, $lata, $ileprocent) {
    //Obliczenie miesięcznej raty
    $miesieczne_ileprocent = $ileprocent / 100 / 12;
    $miesiace = $lata * 12;
    return ($kwota * $miesieczne_ileprocent) / (1 - pow(1 + $miesieczne_ileprocent, -$miesiace));
}

//definicja zmiennych kontrolera
$kwota = null;
$lata = null;
$ileprocent = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($kwota,$lata,$ileprocent);
if ( validate($kwota,$lata,$ileprocent,$messages) ) { // gdy brak błędów
	process($kwota,$lata,$ileprocent,$messages,$result);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$kwota,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';