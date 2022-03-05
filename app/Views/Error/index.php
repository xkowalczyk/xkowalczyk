<link rel="stylesheet" href="css/error/style-error.css">

<body>
    <div class="error_view">
        <b>BŁĄD: <?= esc($errorName) ?></b> <br><br>
        <b>Szczegóły:</b> <?= esc($errorDetails) ?><br><br>
        Zaraz zostaniesz przeniesiony na stronę: <?= esc($errorToPage) ?><br><br>
    </div>
</body>

<?php header("Refresh: 5; $errorToPage");  ?>