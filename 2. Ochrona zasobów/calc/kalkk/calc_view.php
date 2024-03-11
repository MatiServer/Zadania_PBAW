<?php
require_once dirname(__FILE__).'/../kalkz/config.php';
// Ochrona widoku
include _ROOT_PATH.'/app/security/check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator kredytowy</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
<div style="width:90%; margin: 2em auto;">
    <a href="<?php print(_APP_ROOT); ?>/../kalkk/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
    <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">
    <h1>Kalkulator kredytowy</h1>
    <form method="post" action="calc.php">
        Kwota kredytu: <input type="number" name="kwota" required><br>
        Ilość lat: <input type="number" name="lata" required><br>
        Oprocentowanie: <input type="number" name="ileprocent" step="0.01" required><br>
        <button type="submit">Oblicz</button>
    </form>
</div>
</body>
</html>
