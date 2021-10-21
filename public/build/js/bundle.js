const summary={name:"",date:"",time:"",services:[]};function paginationHandler(){document.querySelectorAll("button[tab-id]").forEach(e=>{e.addEventListener("click",()=>{openTab(e.getAttribute("tab-id"))})})}function openTab(e){document.querySelectorAll("div.tab[tab-id]").forEach(t=>{const n=t.getAttribute("tab-id"),s=document.querySelector(`button[tab-id="${n}"]`);n==e?(t.style.display="block",s.classList="col btn btn-primary",3==e&&showSummary()):(t.style.display="none",s.classList="col btn btn-outline-light")})}async function loadServices(){try{const e=await fetch(window.location.href+"api/services");createServices(await e.json())}catch(e){console.log(e)}}function createServices(e){const t=document.querySelector(".tab-services");e.forEach(e=>{const{id:n,text:s,price:a}=e,i=document.createElement("DIV");i.classList="service p-3 rounded",i.setAttribute("service-id",""+n),i.innerHTML=`\n            <p class="service-text my-0 fs-5">${s}</p>\n            <p class="service-price my-0 fs-4 fw-bold">$${a}</p>\n        `,i.onclick=function(){onServiceSelected(e,i)},t.appendChild(i)})}function onServiceSelected(e,t){const{services:n}=summary,s=t.getAttribute("service-id");n.some(e=>e.id===s)?(summary.services=n.filter(e=>e.id!==s),t.classList.remove("service-selected")):(summary.services=[...n,e],t.classList.add("service-selected"))}function dateHandler(){document.querySelector("input#date").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[0,6].includes(t)?(e.target.value="",showAlert("Fines de semanas no permitidos")):(summary.date=e.target.value,hideAlert())}))}function timeHandler(){document.querySelector("input#time").addEventListener("input",(function(e){const t=e.target.value.split(":");t[0]>=8&&t[0]<=21?summary.time=e.target.value:(e.target.value="",showAlert("Nuestro horario de atención es de 8am a 10pm"))}))}function showSummary(){const e=document.querySelector(".summary-default"),t=document.querySelector(".summary");if(Object.values(summary).includes("")||0===summary.services.length)return e.classList.remove("d-none"),void t.classList.add("d-none");e.classList.add("d-none"),t.classList.remove("d-none");const{name:n,date:s,time:a,services:i}=summary;let o=0,c="";c+='<h2 class="my-0 text-center">Resumen</h2>';const r=s.split("-"),l=new Date(r[0],r[1]-1,r[2]).toLocaleString("es-ES",{weekday:"long",day:"numeric",month:"long"});c+=`\n        <div class="my-4 p-3 d-flex flex-column gap-3 text-start rounded bg-light bg-gradient bg-opacity-25">\n            <h5 class="fs-4 mb-0 px-0 col text-info">\n                <i class="fas fa-user" title="Cliente"></i>\n                <span class="text-white">${n}</span>\n            </h5>\n            <h5 class="fs-4 mb-0 px-0 col text-info">\n                <i class="far fa-calendar" title="Fecha"></i>\n                <span class="text-white">${l}</span>\n            </h5>\n            <h5 class="fs-4 mb-0 px-0 col text-info">\n                <i class="far fa-clock" title="Hora"></i>\n                <span class="text-white">${a}</span>\n            </h5>\n        </div>\n    `,c+='\n        <div class="my-4 px-4 py-3 d-flex flex-column gap-0 rounded bg-light bg-gradient bg-opacity-25">\n            <div class="mb-3 p-0 d-flex justify-content-between gap-2 text-info fw-bold">\n                <p class="m-0 fs-3">Servicios</p>\n                <p class="m-0 fs-3">Precio</p>\n            </div>\n    ',i.forEach(e=>{o+=parseFloat(e.price),c+=`\n            <div class="m-0 px-1 py-1 d-flex justify-content-between gap-2 border-top">\n                <p class="m-0 fs-5 fw-light">${e.text}</p>\n                <p class="m-0 fs-5 fw-light">&dollar;${Math.round(e.price)}</p>\n            </div>\n        `}),c+=`\n            <div class="pt-2 pe-1 d-flex justify-content-end gap-4 border-top fw-bold">\n                <p class="m-0 fs-4 text-info">Total</p>\n                <p class="m-0 fs-4">&dollar;${Math.round(o)}</p>\n            </div>\n\n            <div class="w-auto text-end">\n                <button class="btn btn-primary mt-3" id="summary-book-btn">Reservar</button>\n            </div>\n        </div>\n    `,t.innerHTML=c}async function bookDate(){const{name:e,date:t,time:n,services:s}=summary,a=new FormData;a.append("name",e),a.append("date",t),a.append("time",n),a.append("services",s.map(e=>e.id)),console.log([...a]);const i=await fetch(window.location.href+"api/book-date",{method:"POST",body:a}),o=await i.json();console.log(o)}document.addEventListener("DOMContentLoaded",(function(){openTab(3),summary.name=document.querySelector("input#date-name").value,paginationHandler(),loadServices(),dateHandler(),timeHandler()}));let alertTimeout=0;function showAlert(e){alertTimeout&&hideAlert();const t=document.querySelector(".form-alert");t.classList.remove("d-none"),t.innerHTML=`\n        <p class="my-0">\n            <strong>&CenterDot;</strong> ${e}\n        </p>\n    `,alertTimeout=setTimeout((function(){hideAlert()}),5e3)}function hideAlert(){const e=document.querySelector(".form-alert");e.classList.add("d-none"),e.innerHTML="",clearTimeout(alertTimeout),alertTimeout=0}
//# sourceMappingURL=bundle.js.map
