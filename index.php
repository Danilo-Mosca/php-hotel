<!DOCTYPE html>

<?php
/* Assegno alla variabile parking il parametro GET (che è una super variabile globale) ricevuto: se spuntato il valore sarà 'true', altrimenti sarà 'false'. Inizialmente, al caricamento dell'immagine, il suo valore sarà sempre false.
        La funzione isset() verifica se una variabile è definita e non è null */
$parking = isset($_GET['parking']) ? $_GET['parking'] : 'false';
// var_dump($parking);
// echo $parking;

// Alla variabile $vote faccio il casting con (int), perchè il valore restituito dal parametro GET (dalla query string) è sempre una stringa
$vote = isset($_GET['vote']) ? (int) $_GET['vote'] : 0;
// var_dump($vote);
// echo $vote;
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Collego bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- COllego il file css -->
    <link rel="stylesheet" href="css/style.css">
    <title>PHP Hotels</title>
</head>

<body>
    <h1 class="h1-title">PHP Hotels</h1>

    <?php
    // Array di hotels
    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    ?>

    <div class="container">
        <div class="row">
            <?php

            /* SE NON HO INSERITO IL FILTRO DI RICERCA DEL PARCHEGGIO E DEL VOTO RESTITUISCO TUTTI GLI HOTEL */
            if ($parking == 'false' && $vote <= 0) {
                foreach ($hotels as $hotel) {
                    // var_dump($hotel);
            ?>

                    <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center my-3">
                        <div class="card">
                            <div class="card-header">
                                Hotel
                            </div>

                            <?php
                            foreach ($hotel as $key => $value) {
                            ?>

                                <ul class="list-group list-group-flush">
                                    <?php
                                    if ($key == 'parking') {
                                        if ($value == true) {
                                            $value = 'true';
                                        } else {
                                            $value = 'false';
                                        }
                                    }
                                    ?>
                                    <li class="list-group-item"><?php echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value;  ?></li>
                                </ul>

                            <?php
                                // * La funzione ucwords trasforma in maiuscolo il primo carattere della parola contenuta in $key
                                //echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value . "<br>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }



            /* SE NON HO INSERITO IL FILTRO DI RICERCA DEL PARCHEGGIO MA HO INSERITO IL FILTRO DI RICERCA DEL VOTO ALLORA VISUALIZZO GLI HOTEL
               FILTRATI SOLTANTO PER IL VOTO */ else if ($parking == 'false' && $vote > 0) {
                foreach ($hotels as $hotel) {
                    if ($hotel['vote'] >= $vote) {


                        // var_dump($hotel);
                    ?>

                        <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center my-3">
                            <div class="card">
                                <div class="card-header">
                                    Hotel
                                </div>

                                <?php
                                foreach ($hotel as $key => $value) {
                                ?>

                                    <ul class="list-group list-group-flush">
                                        <?php
                                        if ($key == 'parking') {
                                            if ($value == true) {
                                                $value = 'true';
                                            } else {
                                                $value = 'false';
                                            }
                                        }
                                        ?>
                                        <li class="list-group-item"><?php echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value;  ?></li>
                                    </ul>

                                <?php
                                    // * La funzione ucwords trasforma in maiuscolo il primo carattere della parola contenuta in $key
                                    //echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    } else if ($vote > 5) {
                        echo '<h2 class="text-center">Non puoi filtrare un punteggio maggiore di 5</h2>';
                        break;
                    }
                }
            }



            /* SE HO INSERITO ENTRAMBI I FILTRI DI RICERCA ALLORA FILTRO SIA PER PARCHEGGIO PRESENTE CHE PER VOTO */ else if ($parking == 'true' && $vote > 0) {
                foreach ($hotels as $hotel) {
                    if ($hotel['vote'] >= $vote && $hotel['parking'] == true) {
                        // var_dump($hotel);
                    ?>

                        <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center my-3">
                            <div class="card">
                                <div class="card-header">
                                    Hotel
                                </div>

                                <?php
                                foreach ($hotel as $key => $value) {
                                ?>

                                    <ul class="list-group list-group-flush">
                                        <?php
                                        if ($key == 'parking') {
                                            if ($value == true) {
                                                $value = 'true';
                                            } else {
                                                $value = 'false';
                                            }
                                        }
                                        ?>
                                        <li class="list-group-item"><?php echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value;  ?></li>
                                    </ul>

                                <?php
                                    // * La funzione ucwords trasforma in maiuscolo il primo carattere della parola contenuta in $key
                                    //echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    } else if ($vote > 5) {
                        echo '<h2 class="text-center">Non puoi filtrare un punteggio maggiore di 5</h2>';
                        break;
                    }
                }
            }



            // ALTRIMENTI RESTITUISCO SOLO GLI HOTEL CHE HANNO IL PARCHEGGIO
            else {
                foreach ($hotels as $hotel) {
                    if ($hotel['parking'] == true) {
                        // var_dump($hotel);
                    ?>

                        <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center my-3">
                            <div class="card">
                                <div class="card-header">
                                    Hotel
                                </div>

                                <?php
                                foreach ($hotel as $key => $value) {
                                ?>

                                    <ul class="list-group list-group-flush">
                                        <?php
                                        if ($key == 'parking') {
                                            if ($value == true) {
                                                $value = 'true';
                                            } else {
                                                $value = 'false';
                                            }
                                        }
                                        ?>
                                        <li class="list-group-item"><?php echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value;  ?></li>
                                    </ul>

                                <?php
                                    // * La funzione ucwords trasforma in maiuscolo il primo carattere della parola contenuta in $key
                                    //echo "<strong>" . ucwords($key) . "</strong>" . ": " . $value . "<br>";
                                }
                                ?>
                            </div>
                        </div>
            <?php
                    }
                }
            }

            ?>
        </div>

        <hr>
        <h2 class="h2-filter-title">Filtered search:</h2>

        <form action="./index.php" method="GET" class="class-form">
            <div class="check-parking">
                <input type="checkbox" name="parking" value="true" id="parking">
                <label for="parking">There is a car park</label>
            </div>
            <label for="vote">Filtered by vote:</label>
            <input type="number" name="vote" id="vote">
            <input type="submit" value="Filter">
        </form>

</body>

</html>