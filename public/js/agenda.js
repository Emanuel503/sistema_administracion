document.addEventListener('DOMContentLoaded', function () {

    //var formulario = document.querySelector("form");

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        locale: "es",

        headerToolbar: {
            left: 'prev,next,today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },

        events: "http://127.0.0.1:8000/calendario",

        dateClick: function (info) {
            $("#actividad").modal("show");
        },

        eventClick: function (info) {
            var actividad = info.event;
            console.log(actividad);

            axios.post("http://127.0.0.1:8000/calendario/edit/" + info.event.id).
                then(
                    (respuesta) => {
                        document.formulario.id.value = respuesta.data.id;
                        document.formulario.title.value = respuesta.data.title;
                        document.formulario.fecha.value = respuesta.data.fecha_inicio + ' - ' + respuesta.data.fecha_finalizacion;
                        document.formulario.hora.value = respuesta.data.hora_inicio + ' - ' + respuesta.data.hora_finalizacion;
                        document.formulario.objetivo.value = respuesta.data.objetivo;
                        document.formulario.observaciones.value = respuesta.data.observaciones;

                        document.getElementById('enlace').setAttribute('href', 'http://127.0.0.1:8000/actividades/' + respuesta.data.id);

                        //console.log(respuesta.data.hora_inicio);
                        $("#actividad").modal("show");
                    }
                ).catch(
                    error => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    }
                )
        }
    });
    calendar.render();
});