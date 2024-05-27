// scripts.js
$(document).ready(function () {
    var modal = $('#scheduleModal');
    var span = $('.close');

    function loadSchedules() {
        $.ajax({
            url: 'get_schedules.php',
            method: 'GET',
            success: function (data) {
                $('#scheduleTable tbody').html(data);
            }
        });
    }

    loadSchedules();

    $('#addScheduleBtn').on('click', function () {
        $('#scheduleForm')[0].reset();
        $('#scheduleId').val('');
        modal.show();
    });

    span.on('click', function () {
        modal.hide();
    });

    $(window).on('click', function (event) {
        if (event.target == modal[0]) {
            modal.hide();
        }
    });

    $('#scheduleForm').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: 'save_schedule.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                alert(data);
                modal.hide();
                loadSchedules();
            }
        });
    });

    $(document).on('click', '.editSchedule', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'get_schedule.php',
            method: 'GET',
            data: { id: id },
            success: function (data) {
                var schedule = JSON.parse(data);
                $('#scheduleId').val(schedule.id);
                $('#dia').val(schedule.dia);
                $('#hora_inicio').val(schedule.hora_inicio);
                $('#hora_fin').val(schedule.hora_fin);
                $('#descanso_inicio').val(schedule.descanso_inicio);
                $('#descanso_fin').val(schedule.descanso_fin);
                modal.show();
            }
        });
    });

    $(document).on('click', '.deleteSchedule', function () {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de eliminar este horario?')) {
            $.ajax({
                url: 'delete_schedule.php',
                method: 'POST',
                data: { id: id },
                success: function (data) {
                    alert(data);
                    loadSchedules();
                }
            });
        }
    });
});
