/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar el usuario:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}

/**
 *  Muestra la clave del formulario, cambia de password a text
 */
function mostrarclave() {
   alert(" Método no implementado en Javascript ")
} 

/**
 *  Pide confirmación de volcar los datos 
 */
function confirmarVolcar(){

}