# Prueba técnica Rubén Martinez

Este proyecto es una prueba técnica desarrollada por Rubén Martínez, que muestra un de un header para un theme de wordpress.

## Instalación

1. Abre una terminal en la ubicación \wp-content\themes.
2. Ejecuta los siguientes comandos:

cd \wp-content\themes
git init
git clone https://github.com/Rubenpard/realNaut.git


## Parte técnica CSS

Diseño mobile-first con Tailwind CSS. He utilizado esta herramienta para garantizar un diseño responsive, asegurando que la interfaz de usuario se ajuste a distintos tamaños de pantalla sin necesidad de escribir código CSS adicional.

El proyecto no utiliza Sass ni ninguna otra metodología CSS adicional. Toda la personalización de estilos se hace directamente con Tailwind y sus utilidades para margenes, espaciados, tipografía y colores.

## Parte técnica JavaScript y Frameworks

El proyecto está desarrollado con Angular 19 utilizando componentes independientes (standalone components), lo que facilita la modularidad y el rendimiento. Además, he hecho uso de los siguientes elementos clave en el proyecto:

- Servicios para manejar el almacenamiento de datos en el navegador, evitando la necesidad de realizar solicitudes API cada vez que se recarga la página.

- NgFor y ngIf: Se utilizan para iterar sobre listas de datos y mostrar contenido dinámico en función de las condiciones, como la visualización de notificaciones y contactos.

- Manejo de gráficos: Se utilizan bibliotecas como Ngx-Charts y Chart.js para mostrar información visual, como gráficos de líneas, barras y circulares.

-Este proyecto utiliza RxJS (Reactive Extensions for JavaScript) para manejar flujos de datos asincrónicos, como peticiones a APIs. Angular trabaja de forma natural con RxJS a través de observables, lo que permite suscribirse a eventos, manejar respuestas y controlar errores fácilmente.

## Parte técnica JavaScript y Frameworks

El proyecto consume una API para para obtener usuarios aleatorios:

https://randomuser.me/

He dejado un vinculo a otra API en el servicio por si acaso fallara randonuser 

https://dummyjson.com/

En caso de estar caida la API https://randomuser.me/api/ . 
Me ha dado muchos problemas ya que ha estado caida gran parte del tiempo durante la elavoración del proyecto   


Muchas gracias por tu tiempo, te deseo un buen día

