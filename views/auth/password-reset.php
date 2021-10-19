<div class="login">
    <div class="login-l">
        
    </div>

    <div class="login-r">
        <!-- Alerta de errores -->
        <?php if(!empty($errors)): ?>
            <div class="login-rc alert alert-danger text-start py-2" role="alert">
                <?php foreach($errors as $error): ?>
                        <span class="my-1">&CenterDot; <?php echo $error; ?></span><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <div class="p-3 border login-rc text-center">
            <h1 class="my-0">Reestablecer contraseña</h1>
            <p class="mb-4">Introduce tu nueva contraseña</p>
            
            <form method="POST">
                <input name="password" type="password" placeholder="Nueva contraseña" class="form-control my-2" required autofocus autocomplete="new-password">
                <input name="password-2" type="password" placeholder="Confirmar contraseña" class="form-control my-2" required autocomplete="new-password">
                
                <button type="submit" class="btn btn-primary w-100 mt-2">Reestablecer</button>
            </form>

            <div class="border-bottom my-3">
                
            </div>

            <div class="d-flex justify-content-evenly gap-2">
                <a href="/" class="btn btn-outline-secondary w-100">Iniciar sesión</a>
                <a href="/signup" class="btn btn-success w-100">Crear cuenta</a>
            </div>
        </div>
    </div>
</div>
