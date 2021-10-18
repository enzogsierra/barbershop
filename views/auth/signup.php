<div class="login">
    <div class="login-l">
        
    </div>

    <div class="login-r">
        <div class="login-rc text-center">
            <h2 class="my-0 mb-4">Registro</h2>
            <form method="POST" action="/signup" class="text-start mb-1" novalidate>
                <input name="name" type="text" class="form-control mb-3"            value="<?php echo s($user->name); ?>" placeholder="Nombre" required>
                <input name="surname" type="text" class="form-control mb-3"         value="<?php echo s($user->surname); ?>" placeholder="Apellido" required>
                <input name="email" type="email" class="form-control mb-3"          value="<?php echo s($user->email); ?>" placeholder="Correo electrónico" required>
                <input name="password" type="password" class="form-control mb-3"    value="" placeholder="Contraseña" required>
                
                <input name="tel" type="tel" class="form-control"               value="<?php echo s($user->tel); ?>" placeholder="Número de teléfono" required>
                <p class="form-text mb-3">Ejemplo: 0123-456789</p>

                <button type="submit" class="btn btn-success w-100">Crear cuenta</button>
            </form>

            <div class="login-rc-separador my-3">
                
            </div>

            <div class="my-2">¿Ya tienes una cuenta? <a href="/">Inicia sesión</a></div>
        </div>  
    </div>
</div>