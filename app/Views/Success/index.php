<link rel="stylesheet" href="css/error/style-error.css">

<body>
<div class="error_view">
    <b>SUKCES: <?= esc($successName) ?></b> <br><br>
    <b>Szczegóły:</b> <?= esc($successDetails) ?><br><br>
    Zaraz zostaniesz przeniesiony na stronę: <?= esc($successToPage) ?><br><br>
</div>
</body>

<?php header("Refresh: 5; $successToPage");  ?>