<main class="main d-flex justify-content-between text-white">
    <div class="header container">
        <a href="/" class="text-decoration-none">
            <h1 class="m-0 p-4 text-white">
                <i class="fas fa-cut"></i>arber<span class="text-primary">Shop</span>
            </h1>
        </a>
    </div>

    <div class="app p-4">
        <nav class="nav d-flex gap-2">
            <button class="col btn btn-outline-light" tab-id="1">Servicios</button>
            <button class="col btn btn-outline-light" tab-id="2">Reserva</button>
            <button class="col btn btn-outline-light" tab-id="3">Resumen</button>
        </nav>

        <!-- Servicios -->
        <div class="tab my-4 text-center" tab-id="1">
            <h2 class="my-0">Servicios</h2>
            <h5 class="my-0">Selecciona tus servicios a continuación</h5>
        
            <div class="tab-services my-4 text-black text-start">

            </div>
        </div>

        <!-- Reservacion -->
        <div class="tab" tab-id="2">
            <div class="my-4 text-center">
                <h2 class="my-0">Haz tu reservación</h2>
                <h5 class="my-0">Coloca tus datos y fecha de cita</h5>
            </div>

            <!-- Form -->
            <div class="d-flex flex-column gap-3 mx-auto w-100">
                <div class="">
                    <label class="form-label">Cliente</label>
                    <input 
                        type="text" 
                        class="form-control pe-not-allowed"
                        id="date-name"
                        value="<?php echo $_SESSION["name"] . " " . $_SESSION["surname"]; ?>"
                        disabled
                    />
                </div>

                <div class="">
                    <label class="form-label" for="date">Fecha</label>
                    <input 
                        type="date" 
                        id="date" 
                        class="form-control"
                        min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>"
                        max="<?php echo date("Y-m-d", strtotime("+1 month")); ?>"
                    />
                    <p class="my-0">De lunes a viernes</p>
                </div>

                <div class="">
                    <label class="form-label" for="time">Hora</label>
                    <input 
                        type="time" 
                        id="time" 
                        class="form-control"
                    />
                    <p class="my-0">Horarios de atención: 8:00am a 10pm</p>
                </div>
            </div>

            <!-- Alertas -->
            <div class="form-alert alert alert-danger p-2 text-center d-none" role="alert">
            </div>
        </div>

        <!-- Resumen -->
        <div class="tab" tab-id="3">
            <div class="my-4 summary-default d-none text-center">
                <h2 class="my-0">Resumen</h2>
                <h5 class="my-0">(Faltan datos de servicios, fecha y/u hora)</h5>
            </div>

            <div class="summary d-none my-4 text-center">

            </div>
        </div>
    </div>
</main>

<?php 
    $loadBundlejs = true; 
?>