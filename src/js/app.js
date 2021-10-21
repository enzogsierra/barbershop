const summary =
{
    name: "",
    date: "",
    time: "",
    services: []
};

document.addEventListener("DOMContentLoaded", function()
{
    // Init
    openTab(3);
    summary.name = document.querySelector("input#date-name").value; // Leer el nombre desde el input en "Reservacion"

    //
    paginationHandler();
    loadServices();
    dateHandler();
    timeHandler();
});


// Pagination
function paginationHandler()
{
    const buttons = document.querySelectorAll("button[tab-id]");
    buttons.forEach(btn =>
    {
        btn.addEventListener("click", () =>
        {
            const tabid = btn.getAttribute("tab-id");
            openTab(tabid);
        });
    });
}

function openTab(tabid)
{
    const tabs = document.querySelectorAll("div.tab[tab-id]");
    tabs.forEach(tab => // Iterar sobre todos los tabs y mostrarlos/ocultarlos
    {
        const attTabId = tab.getAttribute("tab-id");
        const btn = document.querySelector(`button[tab-id="${attTabId}"]`); // Seleccionar el boton que muestra el tab

        if(attTabId == tabid) // Mostrar tab
        {
            tab.style.display = "block";
            btn.classList = "col btn btn-primary";

            // Resumen
            if(tabid == 3)
            {
                showSummary();
            }
        }
        else // Ocultar tab
        {
            tab.style.display = "none";
            btn.classList = "col btn btn-outline-light";
        }
    });
}


// Services
async function loadServices()
{
    try
    {
        const api = await fetch(`${window.location.href}api/services`);
        const services = await api.json();
        createServices(services);
    }
    catch(error)
    {
        console.log(error);
    }
}

function createServices(services)
{
    const tab = document.querySelector(".tab-services");
    services.forEach(service =>
    {
        const {id, text, price} = service;

        //
        const card = document.createElement("DIV");
        card.classList = "service p-3 rounded";
        card.setAttribute("service-id", `${id}`);
    
        card.innerHTML = 
        `
            <p class="service-text my-0 fs-5">${text}</p>
            <p class="service-price my-0 fs-4 fw-bold">$${price}</p>
        `;
        
        card.onclick = function()
        {
            onServiceSelected(service, card);
        }

        //
        tab.appendChild(card);
    });
}

function onServiceSelected(service, element)
{
    const {services} = summary;
    const elementServiceId = element.getAttribute("service-id");

    // El servicio está seleccionado
    if(services.some(s => s.id === elementServiceId))
    {
        // Quitar servicio de la lista
        summary.services = services.filter(s => s.id !== elementServiceId);
        element.classList.remove("service-selected");
    }
    else // El servicio no está seleccionado
    {
        // Agregar servicio a la lista
        summary.services = [...services, service];
        element.classList.add("service-selected");
    }
}


// Fecha y hora
function dateHandler()
{
    const date = document.querySelector("input#date");
    date.addEventListener("input", function(e)
    {
        // Extraer el número del día de la fecha seleccionada (0=domingo, 1=lunes, ...)
        const day = new Date(e.target.value).getUTCDay(); 

        // Verificar día seleccionado
        if([0, 6].includes(day)) // Día no válido
        {
            e.target.value = "";
            showAlert("Fines de semanas no permitidos");
        }
        else // Día válido
        {
            summary.date = e.target.value;
            hideAlert();
        }
    });
}

function timeHandler()
{
    const time = document.querySelector("input#time");
    time.addEventListener("input", function(e)
    {
        const val = e.target.value.split(":");

        if(val[0] >= 8 && val[0] <= 21) // Hora valida
        {
            summary.time = e.target.value;
        }
        else // Hora no válida
        {
            e.target.value = "";
            showAlert("Nuestro horario de atención es de 8am a 10pm")
        }
    });
}


// Resumen
function showSummary()
{
    const def = document.querySelector(".summary-default");
    const div = document.querySelector(".summary");

    if(Object.values(summary).includes("") || summary.services.length === 0) // Hay un string vacío - faltan datos
    {
        def.classList.remove("d-none");
        div.classList.add("d-none");
        return;
    }

    // Datos validados
    def.classList.add("d-none");
    div.classList.remove("d-none");

    //
    const {name, date, time, services} = summary;
    let total = 0;
    let html = "";

    // Header
    html += `<h2 class="my-0 text-center">Resumen</h2>`;

    // Resumen-cliente
    const dateSplit = date.split("-");
    const dateObj = new Date(dateSplit[0], dateSplit[1] - 1, dateSplit[2]);
    const dateText = dateObj.toLocaleString('es-ES', 
    {
        weekday: 'long', 
        day: 'numeric', 
        month: 'long',
    });

    html +=
    `
        <div class="my-4 p-3 d-flex flex-column gap-3 text-start rounded bg-light bg-gradient bg-opacity-25">
            <h5 class="fs-4 mb-0 px-0 col text-info">
                <i class="fas fa-user" title="Cliente"></i>
                <span class="text-white">${name}</span>
            </h5>
            <h5 class="fs-4 mb-0 px-0 col text-info">
                <i class="far fa-calendar" title="Fecha"></i>
                <span class="text-white">${dateText}</span>
            </h5>
            <h5 class="fs-4 mb-0 px-0 col text-info">
                <i class="far fa-clock" title="Hora"></i>
                <span class="text-white">${time}</span>
            </h5>
        </div>
    `;

    // Resumen-servicios
    html += 
    `
        <div class="my-4 px-4 py-3 d-flex flex-column gap-0 rounded bg-light bg-gradient bg-opacity-25">
            <div class="mb-3 p-0 d-flex justify-content-between gap-2 text-info fw-bold">
                <p class="m-0 fs-3">Servicios</p>
                <p class="m-0 fs-3">Precio</p>
            </div>
    `;
    services.forEach(service =>
    {
        total += parseFloat(service.price);
        html += 
        `
            <div class="m-0 px-1 py-1 d-flex justify-content-between gap-2 border-top">
                <p class="m-0 fs-5 fw-light">${service.text}</p>
                <p class="m-0 fs-5 fw-light">&dollar;${Math.round(service.price)}</p>
            </div>
        `;
    });
    html +=
    `
            <div class="pt-2 pe-1 d-flex justify-content-end gap-4 border-top fw-bold">
                <p class="m-0 fs-4 text-info">Total</p>
                <p class="m-0 fs-4">&dollar;${Math.round(total)}</p>
            </div>

            <div class="w-auto text-end">
                <button class="btn btn-primary mt-3" id="summary-book-btn">Reservar</button>
            </div>
        </div>
    `;

    //
    div.innerHTML = html;

    /*const bookbtn = div.querySelector("#summary-book-btn");
    bookbtn.onclick = bookDate;*/
}

async function bookDate()
{
    const {name, date, time, services} = summary;

    // Crear form
    const form = new FormData();
    form.append("name", name);
    form.append("date", date);
    form.append("time", time);
    form.append("services", services.map(service => service.id));

    console.log([...form]);

    // Enviar
    const api = await fetch(`${window.location.href}api/book-date`,
    {
        method: "POST",
        body: form
    });
    const response = await api.json();

    console.log(response);
}


// Alertas
let alertTimeout = 0;

function showAlert(msg)
{
    if(alertTimeout) hideAlert();

    //
    const div = document.querySelector(".form-alert");
    div.classList.remove("d-none");
    div.innerHTML = 
    `
        <p class="my-0">
            <strong>&CenterDot;</strong> ${msg}
        </p>
    `;

    //
    alertTimeout = setTimeout(function() 
    {
        hideAlert();
    }, 5000);
}
function hideAlert()
{
    const div = document.querySelector(".form-alert");
    div.classList.add("d-none");
    div.innerHTML = "";

    clearTimeout(alertTimeout);
    alertTimeout = 0;
}