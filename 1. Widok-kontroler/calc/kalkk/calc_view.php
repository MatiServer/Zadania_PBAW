<!-- calc_view.php - widok -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator kredytowy</title>
</head>
<body>
    <h1>Kalkulator kredytowy</h1>
    <form method="post" action="calc.php">
        Kwota kredytu: <input type="number" name="kwota" required><br>
        Ilość lat: <input type="number" name="lata" required><br>
        Oprocentowanie: <input type="number" name="ileprocent" step="0.01" required><br>
        <button type="submit">Oblicz</button>
    </form>
</body>
</html>
