document.addEventListener('DOMContentLoaded', function () {

    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    var $ruta = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        locale: "es",

        headerToolbar: {
            left: 'prev,next,today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },

        events: $ruta + "calendario",

        eventClick: function (info) {

            if(info.event.title == "Registro de salida"){
                $("#salida").modal("show");
                axios.post($ruta + "calendario/salida/" + info.event.id).
                then(
                    (respuesta) => {
                        document.formularioSalida.id.value = respuesta.data.id;
                        document.formularioSalida.title.value = respuesta.data.title;
                        document.formularioSalida.fecha.value = respuesta.data.fecha;
                        document.formularioSalida.hora_inicio.value = respuesta.data.hora_inicio;
                        document.formularioSalida.hora_final.value = respuesta.data.hora_final;
                        document.formularioSalida.objetivo.value = respuesta.data.objetivo;
                        document.getElementById('enlaceSalida').setAttribute('href', $ruta + 'registros-salida/' + respuesta.data.id);
                    }
                )
            }else{
                $("#actividad").modal("show");
                axios.post($ruta + "calendario/actividad/" + info.event.id).
                then(
                    (respuesta) => {
                        document.formularioActividad.id.value = respuesta.data.id;
                        document.formularioActividad.title.value = respuesta.data.title;
                        document.formularioActividad.fecha.value = respuesta.data.fecha_inicio + ' - ' + respuesta.data.fecha_finalizacion;
                        document.formularioActividad.hora.value = respuesta.data.hora_inicio + ' - ' + respuesta.data.hora_finalizacion;
                        document.formularioActividad.objetivo.value = respuesta.data.objetivo;
                        document.formularioActividad.observaciones.value = respuesta.data.observaciones;
                        document.getElementById('enlaceActividad').setAttribute('href', $ruta + 'actividades/' + respuesta.data.id);
                    }
                )
            }
        }
    });
    calendar.render();
});