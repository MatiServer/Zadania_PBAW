<?php
// wybor.php

$action = isset($_GET['action']) ? $_GET['action'] : '';
$calcNum = isset($_GET['calcNum']) ? $_GET['calcNum'] : '';

if ($action === 'calc' && $calcNum === '1') {
    header('Location: kalkk\calc.php');
} elseif ($action === 'calc' && $calcNum === '2') {
    header('Location: kalkz\index.php');
} else {
    echo "Wybierz opcję:<br>";
    echo "<form action='wybor.php' method='get'>";
    echo "<input type='hidden' name='action' value='calc'>";
    echo "1 - kalkulator kredytowy 2 - kalkulator zwykly:<br><input type='number' name='calcNum' min='1' max='2'><br>";
    echo "<input type='submit' value='Wybierz'>";
    echo "</form>";
}
?>
