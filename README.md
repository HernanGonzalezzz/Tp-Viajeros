## TP: Viajeros


**Desarrolladores:**

   - RODRÍGUEZ MIRANDA, JEREMÍAS : jeremias.rod.m@gmail.com
   - GONZALEZ HERNAN : hernangonzalez1373@gmail.com

Tube el inconveniente de que mi compañero jeremias no participo en la segunda entrega y no la va a hacer. Esto me lo comunico esta semana y se me complico poder hacer toda la segunda parte a mi solo, hay algunas cosas que no andan.

**Objetivos:**

El objetivo de esta entrega es desarrollar una base de datos para una aplicación de viajes. La aplicación permite ver los vuelos y los usuarios disponibles que tiene cargado el sitio, se puede deatallar un vuelo para que muestra su informacion y los usuarios que estan registrados en el vuelo. Hay un apartado para que el administrador pueda agregar vuelos y usuarios como tambien modificarlos.


**Diagrama:**


![image](https://github.com/user-attachments/assets/05d15f17-24ac-4bd0-90c8-936a92d0eec1)



 

En el diagrama podemos ver que la relacion es 1-->N. Donde 1 son los vuelos(ya que los usuarios pueden tener 1 vuelo), y N los usuarios(los vuelos tienen N usuarios).


El acceso para el administrador es:
   direccion de correro electronico: webadmin@gmail.com
   clave: admin


**Navegacion**

Acceso Publico:

- Listado de Vuelos: Se muestran todos lo vuelos disponibles de la pagina.
     -URL = /Vuelos
- Detalle de un vuelo: Se muestra el detalle del vuelo y los usuarios que son pasajeros.
     - URL= /Vuelos/:id
-Listado de Usuarios: Se muestan todos los usuarios disponibles.
     - URL= /Clientes
-Acceder al login: Se muestra el formulario para logearse.
     - URL= /mostrarLogin
 
       
Acceso de Administrador:

-Editar vuelos: Se muestra el formulario con los datos de los vuelo que se pueden modificar.
      -URL= /MostrarEditar/Vuelo/:id
-Editar usuario: Se muestra el formulario con los datos del usuario que se pueden modificar.
      -URL= /MostrarEditar/Usuario/:id
-Ingresar un vuelo:
      -URL= /Insertar/Vuelo
-Ingresar un usuario:
      -URL= /Insertar/Usuario
-Eliminar un vuelo: 
      -URL= /Eliminar/Vuelo/:id
-Eliminar un usuario: 
      -URL= /Eliminar/Usuario/:id
-Cerrar sesion: 
      -URL= /cerrarSesion

