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
        <div class="border p-3 login-rc text-center">
            <h2 class="my-0 mb-4">Iniciar sesión</h2>

            <form method="POST" class="mb-1">
                <input name="email" type="email" class="form-control mb-3" value="<?php echo $email; ?>" placeholder="Correo electrónico" required>
                <input name="password" type="text" class="form-control mb-3" placeholder="Contraseña" required>
                
                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            </form>

            <a href="/recover">¿Olvidate tu contraseña?</a>

            <div class="border-bottom my-3">
                
            </div>

            <p>¿No tienes una cuenta? ¡Regístrate gratis!</p>
            <a href="/signup" class="btn btn-success">Crear cuenta</a>
        </div>  
    </div>
</div>