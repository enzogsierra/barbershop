<div class="my-2 text-center">
    <h2>Panel de administración</h2>
</div>

<nav class="mt-4 d-flex gap-2 flex-wrap pb-4 border-bottom">
    <a href="/admin" class="col btn btn-primary">Citas</a>
    <a href="/admin/services" class="col btn btn-primary">Servicios</a>
</nav>

<div class="my-4 p-3 rounded bg-dark bg-gradient">
    <h2 class="m-0 mb-3">Nuevo servicio</h2>

    <form class="form" id="service-form-new">
        <div class="input-group mt-2">
            <span class="input-group-text"><i class="far fa-file-alt"></i></span>
            <input type="text" class="form-control" id="service-new-text" placeholder="Corte de cabello para mujeres" maxlength="64" required>
        </div>
        <p class="form-text text-light mb-2">El texto debe tener entre 5 y 64 caracteres</p>
        
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            <input type="number" class="form-control" id="service-new-price" placeholder="Precio" min="0" required>
        </div>
        
        <button type="submit" class="btn btn-success" id="service-btn-new"><i class="fas fa-plus-circle"></i> Añadir</button>
    </form>
</div>

<h2 class="text-center">Servicios</h2>
<table class="table table-sm bg-light table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Texto</th>
            <th scope="col">Precio</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="services">
        <?php 
        $count = 0;
        foreach($services as $service): 
            $count++;
        ?>
            <tr service-id="<?php echo $service->id; ?>">
                <th scope="row"><?php echo $count; ?></th>
                <td id="service-text"><?php echo $service->text; ?></td>
                <td id="service-price">&dollar;<?php echo $service->price; ?></td>
                
                <td class="text-center text-nowrap">
                    <button class="btn btn-secondary col" id="service-btn-edit" title="Editar"><i class="far fa-edit btn-child"></i></button>
                    <button class="btn btn-outline-danger col" id="service-btn-delete" title="Eliminar"><i class="far fa-trash-alt btn-child"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="/build/js/service-edit.js"></script>