<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BarberShop</title>

        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <script src="https://kit.fontawesome.com/5fd77854ec.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/build/css/bootstrap.min.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>

    <body class="w-100 d-flex justify-content-between">
        <main class="app-start w-100">
            <h1 class="h1 m-4 fs-1">
                <a href="/" class="m-0 p-0 text-white text-decoration-none">
                    <i class="fas fa-cut"></i>arber<span class="text-primary">Shop</span>
                </a>
            </h1>
        </main>

        <?php if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true): ?>
            <div class="app-end w-100 p-4 pt-3 text-white">
                <?php echo $content; ?>
            </div>

        <?php else: ?>
            <div class="w-100 p-4 d-flex flex-column justify-content-center align-items-center bg-white">
                <?php echo $content; ?>
            </div>

        <?php endif; ?>
    </body>

    <!--  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php if(isset($loadJS)): ?>
        <script src="build/js/app.js"></script>
    <?php endif; ?>
</html>