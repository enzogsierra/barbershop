let editing = false;
let originalHTML = "";
let Toast = [];


document.addEventListener("DOMContentLoaded", function() 
{
    const newServiceBtn = document.querySelector("#service-btn-new");
    newServiceBtn.addEventListener("click", onServiceAdded);

    //
    const services = document.querySelector("tbody#services");
    services.addEventListener("click", onServicesClick);

    // Crear sweetalert - mensaje default
    Toast = Swal.mixin(
    {
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => 
        {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
});


// Cuando el usuario hace click en "Añadir" servicio
async function onServiceAdded(e)
{
    e.preventDefault();
    const text = document.querySelector("#service-new-text").value;
    const price = document.querySelector("#service-new-price").value;

    // Servicio creado
    if(true)
    {
        const count = document.querySelectorAll("tr[service-id]").length + 1;

        // Crear elemento
        const tr = document.createElement("TR");
        tr.setAttribute("service-id", `${count}`);
        tr.innerHTML = 
        `
            <tr service-id="${count}">
                <th scope="row">${count}</th>
                <td id="service-text">${text}</td>
                <td id="service-price">$${price}</td>
                
                <td class="text-center text-nowrap">
                    <button class="btn btn-secondary col" id="service-btn-edit" title="Editar"><i class="far fa-edit btn-child"></i></button>
                    <button class="btn btn-outline-danger col" id="service-btn-delete" title="Eliminar"><i class="far fa-trash-alt btn-child"></i></button>
                </td>
            </tr>
        `;

        document.querySelector("tbody#services").appendChild(tr); // Añadir nuevo servicio a la lista
        document.querySelector("#service-form-new").reset(); // Resetear formulario
    
        Toast.fire(
        {
            icon: 'success',
            title: 'Servicio creado correctamente'
        });
    }
    else // Error
    {
        Toast.fire(
        {
            icon: 'error',
            title: `Hubo un error al procesar la información. Verifica que los datos sean correctos.\nCódigo ${response.response}`
        });
    }
}


// Cuando el usuari clickea en algún boton en la lista de servicios
function onServicesClick(e)
{
    const btn = (!e.target.classList.contains("btn-child")) ? e.target : e.target.parentElement;

    // Editar
    if(btn.id == "service-btn-edit")
    {
        // Si ya está editando, clickear el boton de cancelar automaticamente
        if(editing) document.querySelector("#service-btn-cancel").click();

        editing = true; 

        // Cambiar HTML
        const row = btn.parentElement.parentElement; // Seleccionar el row (btn > td > tr)
        const id = row.getAttribute("service-id"); // Obtener ID del servicio
        const text = row.querySelector("#service-text").textContent; // Extraer el texto del servicio
        const price = row.querySelector("#service-price").textContent.substring(1); // Extraer el precio del servicio y quitarle el '$'
        
        row.classList.add("table-active");
        originalHTML = row.innerHTML; // Guardar el row original
        row.innerHTML = // Modificar row
        `
            <form>
                <th scope="row">${id}</tr>
                <td scope="col">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                        <input type="text" class="form-control" id="service-edited-text" value="${text}" maxlength="64" required>
                    </div>
                    <p class="form-text my-0">El texto debe tener entre 5 y 64 caracteres</p>
                </td>
                <td width="20%">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                        <input type="number" class="form-control" id="service-edited-price" value="${price}" min="0" required>
                    </div>
                    <p class="d-none form-text">Puedes usar decimales (Ejemplo: <strong>4,99</strong>)</p>
                </td>

                <td class="text-center text-nowrap align-middle">
                    <button type="submit" class="btn btn-success" id="service-btn-save" title="Guardar"><i class="far fa-save"></i></button>
                    <button type="button" class="btn btn-secondary" id="service-btn-cancel" title="Cancelar"><i class="fas fa-times-circle"></i></button>
                </td>
            </form>
        `;
        const save = row.querySelector("#service-btn-save"); // Seleccionar boton de guardar
        const cancel = row.querySelector("#service-btn-cancel"); // ~


        // "Guardar"
        save.onclick = async function(e)
        {
            e.preventDefault();
            const editedText = row.querySelector("#service-edited-text").value; // Obtener el nuevo texto
            const editedPrice = row.querySelector("#service-edited-price").value; // ~

            // Crear form y enviarlo
            const form = new FormData();
            form.append("id", id);
            form.append("text", editedText);
            form.append("price", editedPrice);

            if(true) // Servicio editado correctamente
            {
                // Re-generar html
                row.innerHTML = originalHTML;
                row.querySelector("#service-text").innerText = `${editedText}`;
                row.querySelector("#service-price").innerText = `$${parseFloat(editedPrice).toFixed(2)}`;
                originalHTML = row.innerHTML;

                cancel.click(); // Finalizar edición

                // Mostrar Sweetalert
                Toast.fire(
                {
                    icon: 'success',
                    title: 'Servicio editado correctamente'
                });
            }
            else // Error
            {
                Toast.fire(
                {
                    icon: 'error',
                    title: `Hubo un error al procesar la información. Verifica que los datos sean correctos.\nCódigo ${response.response}`
                });
            }
        }

        // Cancelar
        cancel.addEventListener("click", function()
        {
            editing = false;
            row.classList.remove("table-active");
            row.innerHTML = originalHTML;
        });
    }

    // Eliminar
    if(btn.id === "service-btn-delete")
    {
        // Verificar que no esté editando un servicio
        if(editing)
        {
            Toast.fire(
            {
                icon: 'error',
                title: `Termina de editar el servicio actual antes de continuar`
            });
            return;
        }


        const row = btn.parentElement.parentElement; // Seleccionar el row (btn > td > tr)

        // Mostrar Sweetalert
        Swal.fire(
        {
            title: 'Eliminar',
            text: "¿Seguro que quieres eliminar este servicio? Esta acción es irreversible",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Eliminar',
            cancelButtonText: "Cancelar"
        })
        .then(async function(result) 
        {
            if(result.isConfirmed) 
            {
                if(true)
                {
                    row.remove();

                    Toast.fire(
                    {
                        icon: 'success',
                        title: 'Servicio eliminado correctamente'
                    });
                }
                else // Error
                {
                    Toast.fire(
                    {
                        icon: 'error',
                        title: `Hubo un error y no pudimos eliminar este servicio.\nCódigo ${response.response}`
                    });
                }
            }
        });
    }
}

// Envia un form a la url especificada
async function sendForm(form, action)
{
    const options = 
    {
        method: "POST", 
        body: form
    };
    const send = await fetch(`http://${window.location.host}/admin/services/${action}`, options);
    const response = await send.json();
    return response;
}