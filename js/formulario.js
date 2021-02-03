
eventListeners();

function eventListeners() {
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}

function validarRegistro(e){
    e.preventDefault();

    var usuario = document.getElementById('usuario').value,
        password = document.getElementById('password').value,
        tipo = document.getElementById('tipo').value;

    if(usuario === '' || password === ''){
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'All fields are required',
          })
    } else {
        //If all fields are correct, lets AJAX!

        //What we send
        var datos = new FormData();
        datos.append('usuario', usuario);
        datos.append('password', password);
        datos.append('accion', tipo);

        //Create AJAX
        var xhr = new XMLHttpRequest();

        //Open Connection
        xhr.open('POST', 'inc/modelos/modelo-admin.php', true);

        //Data return
        xhr.onload = function(){
            if(this.status === 200){
                var respuesta = JSON.parse(xhr.responseText);

                console.log(respuesta)
                //Si la respuesta es correcta
                if(respuesta.respuesta === 'correcto'){
                    //Si es un nuevo usuario
                    if(respuesta.tipo === 'crear'){
                        Swal.fire({
                            type: 'success',
                            title: 'Perfect!',
                            text: 'User has been created succesfully',
                          })
                    } else if(respuesta.tipo === 'login'){
                        Swal.fire({
                            type: 'success',
                            title: 'Correct Login!',
                          }).then(resultado => {
                              if(resultado.value){
                                  window.location.href = 'index.php';
                              }
                          })
                    }
                } else{
                    //Error
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                      })
                }
            }
        }

        //Send Petition
        xhr.send(datos);

    }
}