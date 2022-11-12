<?php include('keDatabase.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pencarian Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- fontawesome icon cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.css">

</head>

<body>
    <div>
        <h1 align="center" class="mt-5" >Pencarian Rekam Medis</h1>
        <div class="d-flex align-items-center justify-content-center flex-column gap-4 mt-4">
            <form class="d-flex">
                <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
        </div>
    </div>
</body>

</html>