<div class="error404 d-flex flex-column justify-content-center align-items-center">
    <?php if(isset($_SESSION["logged"])): ?>
        <img src="/build/img/error-404.svg" alt="error 404" class="error404-img error404-imgw">
    <?php else: ?>
        <img src="/build/img/error-404.svg" alt="error 404" class="error404-img">
    <?php endif; ?>

    <h1 class="fs-1 my-0">404</h1>
    <p class="fs-4">Página no encontrada</p>

    <a class="btn btn-primary" href="/">Inicio</a>
</div>