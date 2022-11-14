Tpewebapi/api/products(GET all productos)

Tpewebapi/api/products/:ID(GET producto por id)

Tpewebapi/api/products/:ID (DELETE producto por id)

Tpewebapi/api/products (POST producto con su respectivo body)

Tpewebapi/api/products/:ID (PUT producto con su respectivo body)

Parametros opcionales get
    1- orderby=campotabla (ordena los registros en base a este campo, ascendentemente por defecto), puede usarse "&asc" o "&desc" para que 
    la respuesta este ordenada ascendentemente o descendentemente respectivamente

    2- page="numero">=0 y "pagelimit">=0 (page limit 0 = 0 registros)estos parametros opcionales en conjunto asignan la cantidad de registros devueltos por página y la página actual del resultado, pagelimit siempre debe definirse, sino no afectaran al resultado

    3- nombre="nombre buscado" este parámetro opcional filtra el resultado por los resultados iguales al nombre deseado (distingue entre mayusculas y minúsculas)
    