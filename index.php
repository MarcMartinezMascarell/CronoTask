<?php
    include 'inc/funciones/sesiones.php';
    include 'inc/funciones/funciones.php';
    include 'inc/templates/header.php';
    include 'inc/templates/barra.php';

    //Obtain URL ID
    if(isset($_GET['id_proyecto'])){
        $id_proyecto = $_GET['id_proyecto'];
    }

?>


<div class="contenedor">
    <?php
        include 'inc/templates/sidebar.php';
    ?>

    <main class="contenido-principal">
        <h1>
            <?php 
                $proyecto =obtenerNombreProyecto($id_proyecto);

                if($proyecto){
                foreach ($proyecto as $nombre): ?>
                    <span><?php echo $nombre['nombre']; ?></span>

                <?php endforeach; ?>
        </h1>

        <form action="#" class="agregar-tarea">
            <div class="campo">
                <label for="tarea">Tarea:</label>
                <input type="text" placeholder="Nombre Tarea" class="nombre-tarea"> 
            </div>
            <div class="campo enviar">
                <p>Total Crono: <span>18' 36''</span></p>
                <input type="hidden" id="id_proyecto" value="<?php echo $id_proyecto; ?>" value="id_proyecto">
                <input type="submit" class="boton nueva-tarea" value="Agregar">
            </div>

        </form>
        
 

        <h2>Listado de tareas:</h2>

        <div class="listado-pendientes">
            <ul>

                <?php 
                    //Obtain Current Project Task
                    $tareas = obtenerTareasProyecto($id_proyecto);

                    if($tareas->num_rows > 0){
                        //There aretask
                        foreach($tareas as $tarea){
                            ?>
                                <li id="tarea:<?php echo $tarea['id'] ?>" class="tarea">
                                    <p><?php echo $tarea['nombre'] ?></p>
                                    <p>3m 12s</p>
                                    <div class="acciones">
                                        <button id="s:<?php echo $tarea['id'] ?>" class="crono_button start">Start</button>
                                        <button id="p:<?php echo $tarea['id'] ?>" class="crono_button pause display" data-id="0">Pause</button>
                                        <i class="far fa-check-circle <?php echo ($tarea['estado'] === '1' ? 'completo' : '') ?>"></i>
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </li>
                            <?php
                        }
                    } else {
                        //No task on this project
                        ?>
                        <p class="lista-vacia">There are no tasks in this Project</p>
                        <?php
                    }

                ?>
 
            </ul>
        </div>
        <?php } else{ ?>
        
        <h1>Selecciona un Proyecto!</h1>

        <?php } ?>
    </main>
</div><!--.contenedor-->


<?php
        include 'inc/templates/footer.php';
?>


