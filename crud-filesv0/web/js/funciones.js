/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar el usuario:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}


function mostrarclave() {
  var x = document.getElementById("clave_id"); 

  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  //  alert(" Método no implementado en Javascript ")
} 