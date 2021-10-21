<div class="auth-card p-3 border text-center">
    <?php if($msg["id"] === 1): ?>
        <h1 class="my-0">Confirma tu cuenta</h1>
        <p class="my-0 mt-4">Hemos enviado un email de confirmación a <strong><?php echo $msg["email"]; ?></strong></p>
        <p class="my-0">Sigue las instrucciones para iniciar sesión.</p>

    <?php elseif($msg["id"] === 2): ?>
        <h1 class="my-0">Cuenta confirmada</h1>
        <p class="">Tu cuenta ha sido confirmada correctamente</p>
        <a href="/" class="btn btn-primary w-100">Iniciar sesión</a>

    <?php elseif($msg["id"] === 3): ?>
        <h1 class="my-0">Token no válido</h1>
        <p class="my-3">El token indicado no es válido. Verifica que el enlace esté bien escrito, o bien este token ya fue confirmado.</p>
        <a href="/" class="btn btn-primary w-100">Inicio</a>

    <?php elseif($msg["id"] === 4): ?>
        <h1 class="my-0">Email enviado</h1>
        <p class="my-3">Hemos enviado un email para que puedas recuperar tu contraseña. Revisa tu bandeja de entrada o la carpeta de Spam.</p>
        <a href="/" class="btn btn-primary w-100">Inicio</a>
        
    <?php elseif($msg["id"] === 5): ?>
        <h1 class="my-0">Contraseña reestablecida</h1>
        <p class="">Tu contraseña ha sido reestablecida correctamente, ¡no la olvides!</p>
        <a href="/" class="btn btn-primary w-100">Iniciar sesión</a>
    <?php endif; ?>
</div>
