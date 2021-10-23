<div class="my-2 text-center">
    <h2>Panel de administración</h2>
</div>

<nav class="mt-4 d-flex gap-2 flex-wrap pb-4 border-bottom">
    <a href="/admin" class="col btn btn-primary">Citas</a>
    <a href="/admin/services" class="col btn btn-primary">Servicios</a>
</nav>


<?php if(count($dates)): ?>
    <div class="mt-4 mb-2 input-group">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
        <input type="date" class="form-control" id="date-filter" value="<?php echo $filterDate ?? date("Y-m-d"); ?>">
    </div>

    <h3 class="m-0 text-center">
        <i class="far fa-calendar" title="Fecha"></i>
        <?php echo $filterDate; ?>
    </h3>
    <p class="my-0 text-center"><?php echo count($dates); ?> cita/s</p>


    <!-- Card -->
    <?php foreach($dates as $date): ?>
        <h3 class="mt-5 mb-1 text-center">
            <i class="far fa-clock text-info" title="Horario"></i>
            <?php echo substr($date["time"], 0, 5); ?>
        </h3>

        <div class="text-start p-2 rounded bg-secondary bg-opacity-75">
            <div class="mb-2 d-flex justify-content-center flex-wrap gap-2 text-center">
                <h5 class="my-0 p-2 rounded col bg-black bg-opacity-25">
                    <i class="d-block fa fa-user text-info" title="Horario"></i>
                    <?php echo $date["client"]; ?>
                </h5>
                <h5 class="my-0 p-2 rounded col bg-black bg-opacity-25" title="Correo electrónico">
                    <i class="d-block far fa-envelope text-info" title="Correo electrónico"></i>
                    <a href="mailto:<?php echo $date["email"]; ?>" class="text-light"> <?php echo $date["email"]; ?></a>
                </h5>
                <h5 class="my-0 p-2 rounded col bg-black bg-opacity-25" title="Teléfono">
                    <i class="d-block fas fa-phone-alt text-info" title="Teléfono"></i>
                    <a href="tel:<?php echo $date["email"]; ?>" class="text-light"> <?php echo $date["tel"]; ?></a>
                </h5>
            </div>

            <table class="table table-success table-striped mb-0">
                <thead>
                    <tr>
                        <th>Servicios</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0;

                        foreach(explode(",", $date["services"]) as $clientServices): 
                        $total += $services[$clientServices]->price ?? 0.0;
                    ?>
                        <tr>
                            <th class="fw-normal"><?php echo $services[$clientServices]->text ?? "null-text"; ?></th>
                            <th class="fw-normal">&dollar;<?php echo intval($services[$clientServices]->price); ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td>Total</td>
                        <td>&dollar;<?php echo intval($total); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="mt-4 mb-2 input-group">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
        <input type="date" class="form-control" id="date-filter" value="<?php echo $filterDate ?? date("Y-m-d"); ?>">
    </div>

    <h3 class="m-0 text-center">
        <i class="far fa-calendar" title="Fecha"></i>
        <?php echo $filterDate; ?>
    </h3>
    <p class="my-0 text-center">No hay citas en esta fecha</p>
<?php endif; ?>

<script src="build/js/admin.js"></script>