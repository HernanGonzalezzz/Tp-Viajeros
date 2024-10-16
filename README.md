## TP: Viajeros


**Desarrolladores:**

   - RODRÍGUEZ MIRANDA, JEREMÍAS : jeremias.rod.m@gmail.com
   - GONZALEZ HERNAN : hernangonzalez1373@gmail.com

**Objetivos:**

El objetivo de esta entrega es desarrollar una base de datos para una aplicación de viajes. La aplicación permite a los usuarios realizar reservas de viajes, seleccionando los vuelos que tenemos cargado en nuestra base de datos.

Usuarios: Los usuarios pueden registrarse, y los datos se almacenan en nuestra base de datos. Contemplamos que los usuarios puedan estar registrados (almacenados) sin la necesidad de seleccionar un vuelo.

Vuelos: Tenemos en cuenta que un vuelo puede contener a más de un pasajero, pero no un pasajero varios vuelos. Y cada vuelo tiene información específica como destino, vuelo, etc.



**Diagrama:**


![image](https://github.com/user-attachments/assets/8d49f6ee-7d7c-4d66-8fed-a0e564e9ae98)

 

En el diagrama podemos ver que la relacion es 1-->N. Donde 1 son los vuelos(ya que los usuarios pueden tener 1 vuelo), y N los usuarios(los vuelos tienen N usuarios)
