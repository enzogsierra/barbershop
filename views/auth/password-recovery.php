<!-- Alerta de errores -->
<?php if(!empty($errors)): ?>
    <div class="login-rc alert alert-danger text-start py-2" role="alert">
        <?php foreach($errors as $error): ?>
                <span class="my-1">&CenterDot; <?php echo $error; ?></span><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Card -->
<div class="auth-card p-3 border text-center">
    <h1 class="my-1">Recuperar contraseña</h1>
    <p class="mb-4">Introduce tu correo electrónico, te enviaremos un enlace para que puedas recuperar tu contraseña</p>
    
    <form method="POST">
        <input name="email" type="email" placeholder="Correo electrónico" class="form-control" required autofocus>
        
        <button type="submit" class="btn btn-primary w-100 mt-2">Enviar</button>
    </form>

    <!--  -->
    <div class="border-bottom my-3">
        
    </div>

    <div class="d-flex justify-content-evenly gap-2">
        <a href="/" class="btn btn-outline-secondary w-100">Iniciar sesión</a>
        <a href="/signup" class="btn btn-success w-100">Crear cuenta</a>
    </div>
</div>
