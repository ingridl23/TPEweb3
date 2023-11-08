# TPEweb3
  

## El endpoint de la api tabla libros es: http://localhost/tucarpetalocal/tucarpetalocal/api/libros

## El endpoint de la api tabla autores es :http://localhost/tucarpetalocal/tucarpetalocal/api/autores


# ENDOPINTS POR METODO GET :

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/libros : ###Este endpoint trae todos los libros de la bbdd tp_web2 con los datos unidos de las tablas libros y autor .

* ### http://localhost/tucarpetalocal/tucarpetalocal/api/autores : ### Este endpoint trae listado todos los autores de su tabla con nombre 'autor'.

* #### http://localhost/tucarpetalocal/tucarpetalocal/api/libros/:ID : ### este endpoint trae un libro por id especificado. En caso que no exista el id se te notificara el respectivo error.

*
*

# ENDPOINTS POR METODO POST :

## ejemplo de request post: http://localhost/TPEWEB3/api/libros


```json
{
        "titulo": "Cronicas De Una pandemia ",
        "Anio": 2020,
        "descripcion": "Una novela que examina el comportamiento humano frente a calamidades como lo fue una pandemia en el año 2020. Y las razones de la mala organizacion social frente a situaciones que van mas alla del conocimiento humano",
        "id_autor": 10
 }
 ```
 

# ENDPOINT POR METODO PUT:

# ENDPOINT POR METODO DELETE:

# ENDPOINT PARA TOKEN :
