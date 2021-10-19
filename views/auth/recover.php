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
            <h1 class="my-0">Recuperar contraseña</h1>
            <p class="mb-4">Introduce tu correo electrónico, te enviaremos un enlace para que puedas recuperar tu contraseña</p>
            
            <form method="POST">
                <input name="email" type="email" placeholder="Correo electrónico" class="form-control my-0" required autofocus>
                
                <button type="submit" class="btn btn-primary w-100 mt-2">Enviar</button>
            </form>
        </div>
    </div>
</div>