var loader_time;

function Loader() 
{
    loader_time = setTimeout(showPage, 2000);
}

function showPage() 
{
    document.getElementById("loader").style.display = "none";
    document.getElementById("main-div").style.display = "block";
}