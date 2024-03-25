<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator</title>
</head>
<body>
<h1>Kalkulator kredytowy</h1>
<form method="post" action="<?php print(_APP_URL);?>/app/calc.php">
    Kwota kredytu: <input type="number" name="kwota" required><br>
    Ilość lat: <input type="number" name="lata" required><br>
    Oprocentowanie: <input type="number" name="ileprocent" step="0.01" required><br>
    <button type="submit">Oblicz</button>
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesieczna rata: '.$result; ?>
</div>
<?php } ?>

</body>
</html>