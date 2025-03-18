document.addEventListener("DOMContentLoaded", function() {
    // Función para mostrar los datos en la tabla de manera dinámica
    function fetchData(modalType) {
        $.ajax({
            url: "fetch_data.php",  // Archivo PHP que traerá los datos
            type: "GET",
            data: { type: modalType },
            success: function(data) {
                $(`#${modalType}Table tbody`).html(data);
            }
        });
    }

    // Guardar nuevos datos
    $('form').on('submit', function(event) {
        event.preventDefault();
        let modalType = $(this).attr('id').replace('Form', '');
        $.ajax({
            url: "save_data.php",  // Archivo PHP para guardar los datos
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                fetchData(modalType);  // Refrescar la tabla
                closeModal(modalType + 'Modal');  // Cerrar el modal
            }
        });
    });

    // Actualizar datos
    function updateData(modalType) {
        let selectedId = prompt("Ingrese el ID del registro a modificar:");
        if (selectedId) {
            $.ajax({
                url: "update_data.php",
                type: "POST",
                data: {
                    id: selectedId,
                    type: modalType,
                    ...$('#' + modalType + 'Form').serializeArray()
                },
                success: function(response) {
                    alert(response);
                    fetchData(modalType);
                }
            });
        }
    }

    // Eliminar datos
    function deleteData(modalType) {
        let selectedId = prompt("Ingrese el ID del registro a eliminar:");
        if (selectedId) {
            $.ajax({
                url: "delete_data.php",
                type: "POST",
                data: { id: selectedId, type: modalType },
                success: function(response) {
                    alert(response);
                    fetchData(modalType);
                }
            });
        }
    }

    // Función de búsqueda dinámica en las tablas
    function searchTable(tableId, value) {
        $(`#${tableId} tbody tr`).filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value.toLowerCase()) > -1);
        });
    }

    // Llamar la función fetchData cuando se abra un modal
    $('.btn').on('click', function() {
        let modalType = $(this).attr('onclick').match(/'(.*?)'/)[1].replace('Modal', '');
        fetchData(modalType);
    });
});
