# TPEweb3 LIBROBLOG
  Creada por ledesma Ingrid y Andino Geronimo, cuyo objetivo es poder permitir a los clientes el acceso y consumo mediante metodos de protocolos HTTP de una base de datos de libros  en la cual hay diferentes de los de estos mismos con su respectiva relacion de sus autores y descripciones. Las categorias de los libros son los autores ya que solo se enlazan a estos mismos. Este trabajo no  presenta la creacion de la parte front end del codigo pero es  posible encontrarlo en la segunda  entrega del TPE.


  # Importantes para empezar:
## 1)Importar la base de datos
- importar desde PHPMyAdmin


## 2)Pruebas con postman
El endpoint de la API es: http://localhost/tucarpetalocal/api/

## El endpoint de la api tabla libros es: http://localhost/tucarpetalocal/tucarpetalocal/api/libros

## El endpoint de la api tabla autores es :http://localhost/tucarpetalocal/tucarpetalocal/api/autores


# ENDOPOINTS POR METODO GET :

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros : Este endpoint trae todos los libros de la bbdd tp_web2 con los datos unidos de las tablas libros y autor .

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/autores : Este endpoint trae listado todos los autores de su tabla con nombre 'autor'.

* #### http://localhost/tucarpetalocal/tucarpetalocal/api/libros/:ID : Este endpoint trae un libro por id en especifico. En caso que no exista el id se te notificara el respectivo error.

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/autores/:ID : Este endpoint devuelve un autor por su id . En caso que no exista el id se te notificara el respectivo error.

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros/:ORDER/:FIELD : Este endpoint trae libros ordenados y por campo. En caso de no especificar el orden ya hay uno definido. En caso de no especificar el campo tambien ya hay uno predeterminado.

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/autores/:ORDER/:FIELD :Este endpoint trae autores ordenados y por campo. En caso de no especificar el orden ya hay uno definido. En caso de no especificar el campo tambien ya hay uno predeterminado.

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros/page/:PAGENUMBER : Con el siguiente endpoint se puede obtener los libros pero de una forma controlada, es decir paginados. Se debe especificar un numero de pagina en (:PAGENUMBER) para poder traer los libros de la manera diseñada. En caso que se ingrese un numero de pagina que no exista se le notificara el respectivo error. Esto ultimo tiene relacion con la cantidad de libros ya guardados en nuestra base de datos por eso es muy relativa dependiendo del numero que se ingrese.






# ENDPOINTS POR METODO PUT :
 * ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros/:ID : A partir de un id de un libro y con metodo put se puede modificar/actualizar un libro en especifico.


## ejemplo de body para postman : (ejemplo de json para completar)

 ```json
  {
        "titulo": "Cronicas De Una novela ",
        "Anio": 2023,
        "descripcion": "nueva descripcion de la novela",
        "id_autor": "3"
        
 }
 ```
* ### http://localhost/tucarpetalocal/tucarpetalocal/api/autores/:ID : A partir de un id de un autor y por metodo put se puede modificar/actualizar un autor en especifico.


## ejemplo de body para postman : (ejemplo de json para completar)
 ```json
  {
        "nombreApellido": "Antonio del valle",
        "nacionalidad": "brasil"
     
        
 }
 ```

# ENDPOINT POR METODO POST:
* ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros : A partir de este endpoint y con metodo post puede crearse un nuevo libro.

### ejemplo de body para crear un libro en postman :
```json
{
        "titulo": "Cronicas De Una pandemia ",
        "anio": 2020,
        "descripcion": "Una novela que examina el comportamiento humano frente a calamidades como lo fue una pandemia en el año 2020. Y las razones de la mala organizacion social frente a situaciones que van mas alla del conocimiento humano",
        "idAutor": 2
 }
 ```
*  ### http://localhost/tucarpetalocal/tucarpetalocal/api/autores : A partir de este endpoint y con metodo post puede crearse un nuevo autor.

* ### ejemplo de body para crear un autor en postman :
```json
{
    "nombreApellido":"Juan Carlos",
    "nacionalidad":"Uruguay"
  
}
```


# ENDPOINT POR METODO DELETE:

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros/:ID : A partir de un id en especifico y por metodo delete,se puede eliminar un libro. En postman luego de realizar la consulta deberia devolver el libro eliminado (el json del libro seleccionado).
