listeners();

function listeners() {
    //Start Button Listener
    if(window.location.href.indexOf('proyecto') != -1){
        document.querySelector('.listado-pendientes').addEventListener('click', accionesCrono);
    }
}

function accionesCrono(e) {
    e.preventDefault();
    let id = e.target.id.split(":");
    let id_p = "p:" + id[1];
    let id_s = "s:" + id[1];


    if(e.target.classList.contains('start')){
        e.target.classList.add('display');
        let p = document.getElementById(id_p);
        p.classList.remove('display');
        startCrono(id[1]);
    } else if(e.target.classList.contains('pause')){
        e.target.classList.add('display');
        let s = document.getElementById(id_s);
        s.classList.remove('display');

        pauseCrono(id[1]);
    }
}

function startCrono(idTarea) {
    //AJAX

    let xhr = new XMLHttpRequest();

    let datos = new FormData();
    datos.append('idTarea', idTarea);
    datos.append('accion', 'start');

    console.log(datos);

    xhr.open('POST', 'inc/modelos/modelo-cronos.php');

    xhr.onload = function() {
        if(this.status === 200){
            console.log(JSON.parse(xhr.responseText));
        } else{
            console.log(JSON.parse(xhr.responseText));
        }
    }

    xhr.send(datos);

}

function pauseCrono(idTarea) {
    //AJAX

    let xhr = new XMLHttpRequest();

    let datos = new FormData();
    datos.append('idTarea', idTarea);
    datos.append('accion', 'pause');

    console.log(datos);

    xhr.open('POST', 'inc/modelos/modelo-cronos.php');

    xhr.onload = function() {
        if(this.status === 200){
            console.log(JSON.parse(xhr.responseText));
        } else{
            console.log(JSON.parse(xhr.responseText));
        }
    }

    xhr.send(datos);
}