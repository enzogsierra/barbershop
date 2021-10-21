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
    <h2 class="my-0 mb-4">Registro</h2>

    <form method="POST" class="text-start">
        <div class="border-bottom mb-3">
            <input name="email" type="email" class="form-control mb-3"          value="<?php echo s($user->email); ?>" placeholder="Correo electrónico" required autofocus>
            <input name="password" type="password" class="form-control mb-3"    placeholder="Contraseña" required autocomplete="new-password">
        </div>
    
        <div class="input-group gap-2 mb-3">
            <input name="name" type="text" class="form-control rounded"         value="<?php echo s($user->name); ?>" placeholder="Nombre" required>
            <input name="surname" type="text" class="form-control rounded"      value="<?php echo s($user->surname); ?>" placeholder="Apellido" required>
        </div>

        <div class="mb-3">
            <input name="tel" type="tel" class="form-control" value="<?php echo s($user->tel); ?>" placeholder="Número de teléfono">
            <p class="form-text">Ejemplo: 0011456789</p>
        </div>

        <button type="submit" class="btn btn-success w-100">Crear cuenta</button>
    </form>

    <div class="border-bottom my-3">
        
    </div>

    <div class="my-2">¿Ya tienes una cuenta? <a href="/">Inicia sesión</a></div>
</div>
