<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Entrada</title>
    <script>
        function validarImagen(input) {
            const file = input.files[0];
            if (file) {
                const img = new Image();
                img.src = URL.createObjectURL(file);
                img.onload = function () {
                    if (this.width > 2048|| this.height > 2048) {
                        alert("La imagen debe tener un tamaño máximo de 256x256 píxeles.");
                        input.value = ""; // Resetea el input
                    }
                };
            }
        }
    </script>
</head>
<body>
    <center>
        <h1>Agregar Nueva Entrada</h1>
        <form action="guardar.php" method="POST" enctype="multipart/form-data">
            <h2>Detalles del Proyecto</h2>
            <span class="required_notification">*Datos Requeridos*</span>
            
            <div>
                <label for="nombre_proyecto">Nombre del Proyecto</label>
                <input type="text" name="nombre_proyecto" placeholder="Escriba el nombre del proyecto" maxlength="100" required/>
            </div>
            
            <div>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" placeholder="Descripción del proyecto" maxlength="255" required></textarea>
            </div>
            
            <div>
                <label for="estilo_diseño">Estilo de Diseño</label>
                <input type="text" name="estilo_diseño" placeholder="Escriba el estilo de diseño" maxlength="45" required/>
            </div>
            
            <div>
                <label for="cliente">Cliente</label>
                <input type="text" name="cliente" placeholder="Nombre del cliente" maxlength="45" required/>
            </div>
            
            <div>
                <label for="motor_render">Motor de Render</label>
                <input type="text" name="motor_render" placeholder="Motor de render utilizado" maxlength="45" required/>
            </div>
            
            <div>
                <label for="software_modelado">Software de Modelado</label>
                <input type="text" name="software_modelado" placeholder="Software de modelado utilizado" maxlength="45" required/>
            </div>
            
            <div>
                <label for="fecha_creacion">Fecha de Creación</label>
                <input type="date" name="fecha_creacion" required/>
            </div>

            <div>
                <label for="imagen">Subir Imagen (256x256 máx.)</label>
                <input type="file" name="imagen" accept="image/*" onchange="validarImagen(this)" required/>
            </div>

            <div>
                <input type="submit" value="Guardar Entrada"/>
            </div>
        </form>
    </center>
</body>
</html>
