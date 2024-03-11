<?php

include _ROOT_PATH.'/app/security/check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybierz opcję:</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
<div style="width:90%; margin: 2em auto;">
    <a href="<?php print(_APP_ROOT); ?>/../kalkk/calc.php" class="pure-button">Kalkulator kredytowy</a>
    <a href="<?php print(_APP_ROOT); ?>/index.php" class="pure-button">Kalkulator zwykły</a>
</div>
</body>
</html>
