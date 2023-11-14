# Prueba técnica PHP/Laravel

**Tabla de contenido:**
 - [Caso práctico](#use-case)
 - [Desing doc](#design-doc)
 - [Conclusiones](#conclusions)

## Notas:

- Tiempo para resolver la prueba es de 2 días
- En caso de tener dudas escribir al correo <adrian.galicia@koltin.com.mx>

<a id="use-case"></a>
## Caso práctico

Necesitamos una prueba piloto de un blog. Lo queremos mantener separado, así que debemos empezar un nuevo proyecto.

Empezaremos con algo sencillo, solo queremos autores, posts, comentarios respecto a los autores y los posts, dichos comentarios serán almacenados en formato WYSIWYG (no vamos a gestionar categorías, multimedia ni nada de eso). Vamos a necesitar acceder al contenido del blog desde otras aplicaciones, lo que nos requiere exponer una API.

Por tanto, este proyecto debe tener lo siguiente:

- Design doc de la solución

- Blog público
    - Lista de posts :heavy_check_mark:
    - Página de post incluyendo comentarios, donde se mostrará una pequeña ficha del autor :heavy_check_mark:
    - Página de autor con sus incluyendo comentarios :heavy_check_mark:

- API
    - Endpoint GET para la obtención de posts, incluyendo autor y comentarios :heavy_check_mark:
    - Endpoint POST para la publicación de un post. :heavy_check_mark:
    - Endpoint POST para el registro de autor. :heavy_check_mark:
    - Endpoint GET para obtener los autores, incluyendo comentarios y posts relacionados :heavy_check_mark:

- Comando que exporte a google sheets los comentarios recibiendo un rango de fechas :heavy_check_mark:

**Bonus**

- Desplegar el proyecto.

El objetivo de la prueba es la demostración de :
- Conocimientos en Laravel y PHP, por lo que se primará el cuidado de la estructura backend.
- La correcta separación de servicios y responsabilidades
- Introducción de interfaces, tolerancia ante fallos, etc.

Para la parte front no requerimos una gran labor de maquetación. Puedes usar librerías adicionales a las del framework si lo necesitas. También en la parte de front, puedes usar Bootstrap, Bulma, Tailwind u otro framework CSS.

## Requisitos:

- PHP 8.0+ :heavy_check_mark: 
- Composer y estructura PSR-4 en el proyecto :heavy_check_mark:
- La última versión estable de Laravel :heavy_check_mark:
- Testing unitario :heavy_check_mark:
- La API debe devolver y consumir los datos en formato JSON :heavy_check_mark:
- Programar en el idioma inglés :heavy_check_mark:
- Uso de herramientas de análisis estático (por ejemplo PHPStan en modo máximo) y de estilo de código (por ejemplo PHP CS Fixer en modo @Symfony) :heavy_check_mark:
- Uso de SCSS y Webpack, ya sea usando Webpack directamente o mediante Symfony Encore / Laravel Mix o similar :heavy_multiplication_x:
- Ofrecer un Swagger/OpenAPI para la parte de la API :heavy_check_mark: (Postman)

Para la entrega, puedes mandarnos un enlace a un repositorio público (GitHub, GitLab u otro sitio donde tengas cuenta).

Lo que sí nos gustaría que incluyeras es un README explicando la prueba y cualquier cosa de la que quieras dejar constancia, como las decisiones a la hora de organizar el código, las librerías extra que hayas añadido para facilitar el trabajo, problemas que te hayas encontrado, soluciones alternativas que te gustaría haber probado, etc.

Nos gusta que nos den este tipo de feedback ya que nos ayuda a valorar mejor y de forma objetiva la prueba técnica.
<a id="design-doc"></a>
## Design Doc:

We are creating a simple blog, this doesn't manage media and is using a clean blog from bootstrap templates.
![image](https://github.com/cMachuca/blog-koltin/assets/1843597/29ccd5bb-2685-4700-92bf-c70885165f74)

### Stack
All the project was completed with PHP (Laravel 10) + MySQL for my local environment I use Valet.

- PHP 8.2
- Laravel 10
- MySQL 8
- Google Console

### Development stack
- valet
- phpstan
- php-cs-fixer
- PHPUnit
- ngrok

### Laravel packages
- sanctum
- breeze
- [laravel-google-sheets](https://github.com/kawax/laravel-google-sheets)

### Web Routes
These routes are public so anybody can access them, and see the blog posts.

| Route Name | Route Path |
| -------- | ------------- |
| index | / |
| single-post | /posts/{slug} |
| authors | /authors/{slugName} |

### API Endpoints
These routes are protected do you need to register a user and generate a personal token from the web form (register/login go to Profile -> Personal Access Token) 
You can see the entire documentation in my [Postman profile](https://documenter.getpostman.com/view/5449563/2s9YXmY11X)

| Method | Route Name | Route Path |
|-----| -------- | --------- |
|POST| Create Post | /api/v1/posts |
|GET| Get Posts | /api/v1/posts |
|POST| Create Authors | /api/v1/authors |
|GET| Get Authors | /api/v1/authors |

<a id="conclusions"></a>
## Conclusiones:
I enjoy creating projects from scratch but most of the time take a long time to upsert all the project depending on the requirements in this case was as simple as php/mysql/nginx fortunately cache driver and queues were not necessary for this small project. 
It was difficult for me not to focus on the frontend... Its an area of opportunity for me since I was working entirely in backend for around 3 years.

### My tech debt
I implemented a couple of tries and catches, and also I recycled some code for registering a user to meet with Single responsibility principle.
However, I would have liked to have had time to apply the repository pattern since another of the things that consumed my time was making the connection to Google Sheets
If I can make a list of the missing things I would like to use in this project it should be.

- More validation in all the cases web/API
- Repository Pattern
- DTOs
- Laravel Passport (oAuth) for the API

Thank you for this challenge.
