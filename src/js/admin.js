document.addEventListener("DOMContentLoaded", function() 
{
    const dateFilter_btn = document.querySelector("input#date-filter");
    if(dateFilter_btn) dateFilter_btn.addEventListener("input", onDateFilter);
});

function onDateFilter(e)
{
    const date = e.target.value;
    window.location = `?date=${date}`;
}