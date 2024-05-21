<?php
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tratamientos WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <div class="modal fade" id="editarTratamientoModal" tabindex="-1" aria-labelledby="editarTratamientoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarTratamientoModalLabel">Editar Tratamiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editarTratamientoForm" method="post" action="editar_tratamiento.php">
                            <input type="hidden" id="editarIdTratamiento" name="idTratamiento" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label for="editarNombreTratamiento">Nombre del Tratamiento:</label>
                                <input type="text" class="form-control" id="editarNombreTratamiento" name="nombreTratamiento" value="<?php echo $row['nombre']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editarDuracionTratamiento">Duración (en minutos):</label>
                                <input type="number" class="form-control" id="editarDuracionTratamiento" name="duracionTratamiento" value="<?php echo $row['duracion']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    $conn->close();
}
?>
