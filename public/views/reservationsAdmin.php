<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
    <link rel="stylesheet" type="text/css" href="public/css/reservations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1ff2c7e106.js" crossorigin="anonymous"></script>
    <script src="public/js/reservationsAdmin.js" defer></script>
    <title>Reservations</title>
</head>
<body>
<div class="base-container">
    <?php include_once __DIR__.'/shared/nav.php'; ?>
    <main>
        <h1>Pending Reservations</h1>
        <section class="books-container">
            <?php if (empty($reservations)): ?>
                <h2>No pending reservations</h2>
            <?php else: ?>
            <?php foreach ($reservations as $reservation): ?>
                <div class="reservation-box" id="<?= $reservation->getReservationId()?>">
                    <div class="top-box">
                        <img src="public/img/uploads/<?= $reservation->getPhoto()?>">
                        <div class="description">
                            <p class="bold">Reservation start:</p> <?= $reservation->getReservationStart()?><br>
                            <p class="bold">Reservation end:</p> <?= $reservation->getReservationEnd()?><br>
                            <p class="bold">User email:</p> <?= $reservation->getUserEmail()?>
                        </div>
                    </div>
                    <h2 class="book-title koho-title"><?= $reservation->getBookTitle()?></h2>
                    <div class="bottom-box">
                        <p class="book-author"><?= $reservation->getAuthorName()?></p>
                        <div class="button_wrapper">
                            <button class="cancel" name="cancelled">
                                <i class="fa-solid fa-rectangle-xmark"></i>
                            </button>
                            <button class="confirm" name="confirmed">
                                <i class="fa-regular fa-square-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</div>
</body>
</html>