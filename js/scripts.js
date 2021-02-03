evenetListeners();
//Projects List
var listaProyectos = document.getElementById('proyectos');

function evenetListeners(){
    //Create Project Button
    document.querySelector('.crear-proyecto a').addEventListener('click', nuevoProyecto);

    if(window.location.href.indexOf('proyecto') != -1){
        //Add new Task
        document.querySelector('.nueva-tarea').addEventListener('click', agregarTarea);
    }
    
    if(window.location.href.indexOf('proyecto') != -1){
        //Tasks Buttons
        document.querySelector('.listado-pendientes').addEventListener('click', accionesTareas);
    }
}

function nuevoProyecto(e){
    e.preventDefault();
    //Crate Input for New Project

    let nuevoProyecto = document.createElement('li');
    nuevoProyecto.innerHTML = '<input type="text" id="nuevo-proyecto">';
    listaProyectos.appendChild(nuevoProyecto);

    //Select new Project ID
    let inputNuevoProyecto = document.querySelector('#nuevo-proyecto');

    //On enter create new Project
    inputNuevoProyecto.addEventListener('keypress', (e) => {
        let tecla = e.wich || e.keyCode;
        if(tecla === 13){
            guardarProyectoDB(inputNuevoProyecto.value);
            listaProyectos.removeChild(nuevoProyecto);
        }
    });
}

function guardarProyectoDB(nombreProyecto){
    //Send with FormData
    let datos = new FormData();
    datos.append('proyecto', nombreProyecto);
    datos.append('accion', 'crear');
    
    //AJAX
    let xhr = new XMLHttpRequest();

    //open conection
    xhr.open('POST', 'inc/modelos/modelo-proyecto.php', true);

    //Charge
    xhr.onload = function() {
        if(this.status === 200){
            //Obtain
            let respuesta = JSON.parse(xhr.responseText);
            let proyecto = respuesta.nombre,
                id_proyecto = respuesta.id_insertado,
                tipo = respuesta.tipo,
                resultado = respuesta.respuesta;

            //Comprobar Inserción
            if(resultado === 'correcto'){
                //Nice
                if(tipo === 'crear'){
                    //Create new Project
                    //Inject HTML
                    var nuevoProyecto = document.createElement('li');
                    nuevoProyecto.innerHTML = `
                        <a href="index.php?id_proyecto=${id_proyecto}" id="proyecto:${id_proyecto}">
                            ${proyecto}
                        </a>
                    `;
                    //Add to HTML
                    listaProyectos.appendChild(nuevoProyecto);

                    //Send alert
                    Swal.fire({
                        type: 'success',
                        title: 'Created',
                        text: proyecto + " Is Created Succesfully!",
                      }).then(resultado => {
                        //Redirect to new URL
                        if(resultado.value){
                            window.location.href= 'index.php?id_proyecto=' + id_proyecto;
                        };
                      })
                } else {

                }
            } else {
                //Error
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: "Can't create a new Project",
                  })
            }
        }
    }

    //send request
    xhr.send(datos);
}

//Add new task

function agregarTarea(e){
    e.preventDefault();
    let nombreTarea = document.querySelector('.nombre-tarea').value;

    if(nombreTarea === ''){
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: "Empty Task!",
          })
    } else{
        //Theres something, let's AJAX
        let xhr = new XMLHttpRequest();

        //Form Data
        let datos = new FormData();
        datos.append('tarea', nombreTarea);
        datos.append('accion', 'crear');
        datos.append('id_proyecto', document.querySelector('#id_proyecto').value);



        xhr.open('POST', 'inc/modelos/modelo-tareas.php');

        xhr.onload = function() {
            if(this.status === 200){
                let respuesta = JSON.parse(xhr.responseText);

                let resultado = respuesta.respuesta,
                    tarea = respuesta.tarea,
                    id_insertado = respuesta.id_insertado,
                    tipo = respuesta.tipo;

                if(resultado === 'correcto'){
                    //Add correctly
                    if(tipo === 'crear'){
                        //alert
                        Swal.fire({
                            type: 'success',
                            title: 'Task Created!',
                            text: tarea + ' is Created Succesfully!',
                          })

                          //Select Empty list
                          let parrafoVacio = document.querySelectorAll(".lista-vacia");
                          if(parrafoVacio.length > 0){
                              document.querySelector(".lista-vacia").remove();
                          }

                          //Build New Task
                          let nuevaTarea = document.createElement('li');

                          nuevaTarea.id = 'tarea:'+id_insertado;

                          nuevaTarea.classList.add('tarea');

                          nuevaTarea.innerHTML = `
                            <p>${tarea}</p>
                            <p>3m 12s</p>
                            <div class="acciones">
                                <button id="s:${id_insertado}" class="crono_button start">Start</button>
                                <button id="p:${id_insertado}" class="crono_button pause display" data-id="0">Pause</button>
                                <i class="far fa-check-circle"></i>
                                <i class="fas fa-trash"></i>
                            </div>
                          `;

                          let listado = document.querySelector('.listado-pendientes ul');
                          listado.appendChild(nuevaTarea);

                          document.querySelector('.agregar-tarea').reset();
                    }
                } else {
                    //Error
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: "Can not add new Task",
                      })
                }
            }
        }

        xhr.send(datos);

    }
}

//Change State Tasks or Remove

function accionesTareas(e){
    e.preventDefault();

    if(e.target.classList.contains('fa-check-circle')){
        if(e.target.classList.contains('completo')){
            e.target.classList.remove('completo');
            cambiarEstadoTarea(e.target, 0);
        } else {
            e.target.classList.add('completo');
            cambiarEstadoTarea(e.target, 1);
        }


    } else if(e.target.classList.contains('fa-trash')){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
                let tareaEliminar = e.target.parentElement.parentElement;

                //DELETE FROM DB
                eliminarTareaBD(tareaEliminar);

                //DELETE HTML
                tareaEliminar.remove();

                Swal.fire(
                'Deleted!',
                'Your task has been deleted.',
                'success'
                )
            }
          })
    }
}

//Change Task State
function cambiarEstadoTarea(tarea, estado){
    let idTarea = tarea.parentElement.parentElement.id.split(':');
    
    //AJAX
    xhr = new XMLHttpRequest();

    let datos = new FormData();
    datos.append('id', idTarea[1]);
    datos.append('accion', 'actualizar');
    datos.append('estado', estado);

    xhr.open('POST', 'inc/modelos/modelo-tareas.php');

    xhr.onload = function() {
        if(this.status === 200){
            console.log(JSON.parse(xhr.responseText));
        }
    }

    xhr.send(datos);
}

//Delete Task from DB
function eliminarTareaBD(tarea){
    let idTarea = tarea.id.split(':');
    
    //AJAX
    xhr = new XMLHttpRequest();

    let datos = new FormData();
    datos.append('id', idTarea[1]);
    datos.append('accion', 'eliminar');

    xhr.open('POST', 'inc/modelos/modelo-tareas.php');

    xhr.onload = function() {
        if(this.status === 200){
            console.log(JSON.parse(xhr.responseText));

            //Chek for remaining Tasks
            let listadoTareasRestantes = document.querySelectorAll("li.tarea");
            if(listadoTareasRestantes.length === 0){
                document.querySelector(".listado-pendientes ul").innerHTML = '<p class="lista-vacia">There are no tasks in this Project</p>'
            }
        }
    }

    xhr.send(datos);
}