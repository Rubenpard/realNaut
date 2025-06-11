# Prueba técnica Rubén Martínez

Este proyecto es una prueba técnica desarrollada por Rubén Martínez, que muestra un header para un theme de wordpress.

## Instalación

1. Abre una terminal en la ubicación \wp-content\themes.
2. Ejecuta los siguientes comandos:

cd \wp-content\themes

git init

git clone https://github.com/Rubenpard/realNaut.git

accedemos a la carpeta del proyecto por terminal

cd realNaut

E intalmos dependencias 

npm install 



## Parte técnica

La prueba se ha realizado en un entorno local. Se ha elaborado un header responsive con adaptación a laptop y resolucion de 900px. 
Cuenta con dos menús editables desde MENÚS en wordpress y dos imágenes que se cargan desde la librería de imágenes. 
> Para una correcta visualización cargar la imágenes en la librería,  las imágenes están en realNaut/assets/img/.
> Después cargar las imágenes:
  >   
  >  - logo-kscholl en Personalizar > identidad del sitio
   > - unir_blanco Personalizar > imagen Unir

También cuenta con la selección de iconos o imágenes para los ítems de los menús de navegación. 
Los links de la barra de navegación cuentan con submenus. Se despliegan al pasar el ratón por encima en el laptop y en tablets y móvil al pulsar en los iconos de flecha.
En versión tablet y móvil la navegación se abren desde un menú hamburguésa y funciona como un acordeón.        

Sistema ITCSS para gestión de estilos y escabilidad.

SCSS modular, uso de variables y breakpoints.

Nomenclatura BEM.

Menú responsive (desktop + móvil con toggle).

Submenús multinivel con interacción JS.

Accesibilidad (roles ARIA, navegación con teclado).

Empaquetado en GULP



Muchas gracias por tu tiempo, te deseo un buen día
