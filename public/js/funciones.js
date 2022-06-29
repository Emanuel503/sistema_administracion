//Funcion para ocultar los alert
window.setTimeout(function () {
    $(".alert").fadeTo(6500, 10).slideDown(1000, function () {
        $(this).remove();
    })
}, 1500);

//Funciones para mostrar los input de motorista y vehiculo (solicitud de vehiculo)
var selectAutorizacion = document.getElementById("id_autorizacion_vehiculo");
var divVehiculo = document.getElementById("divVehiculo");
var divMotorista = document.getElementById("divMotorista");

selectAutorizacion.addEventListener("change", function() {
    if(selectAutorizacion.value == 1){
        divVehiculo.removeAttribute("hidden");
        divMotorista.removeAttribute("hidden");
    }else{
        divVehiculo.setAttribute("hidden","");
        divMotorista.setAttribute("hidden","");
    }
});

//Funciones para el menu
document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.dropdown-menu').forEach(function(element){
    element.addEventListener('click', function (e) {
      e.stopPropagation();
    });
})

if (window.innerWidth < 992) {
    document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
        everydropdown.addEventListener('hidden.bs.dropdown', function () {
              this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                  everysubmenu.style.display = 'none';
              });
        })
    });
    
    document.querySelectorAll('.dropdown-menu a').forEach(function(element){
        element.addEventListener('click', function (e) {

              let nextEl = this.nextElementSibling;
              if(nextEl && nextEl.classList.contains('submenu')) {	
                  e.preventDefault();
                  console.log(nextEl);
                  if(nextEl.style.display == 'block'){
                      nextEl.style.display = 'none';
                  } else {
                      nextEl.style.display = 'block';
                  }
              }
        });
    })
}
});