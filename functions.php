<?php

    //Descomponer los parametros de la peticion y devolver un error si falta alguno de los parametros obligatorias
    function getRequestParams($keys) {
        
        $paramsArray = array();
        try {
            //Ir obteniendo cada uno de los parametros de la query string
            foreach( $keys as $key ) {
                if (isset($_GET[$key]))
                    $paramsArray[$key] = $_GET[$key];
                else
                    throw new Exception($key .' parameter is not passed in GetPOI request.');
            }
            return $paramsArray;
        }
        catch(Exception $e) { //Si se produce alguna excepcíon notificarlo
            echo 'Message: ' .$e->getMessage();
        }
    }

    //Convertir una cadena de texto a float
    function changetoFloat($string) {
      if (strlen(trim($string)) != 0) 
        return (float)$string;
      return NULL;
    }

    //Conectar a la base de datos. Los datos de conexion se encuentran en el fichero config.php
    function connectDb() {
        try {
            $dbconn = 'mysql:host=' . DBHOST . ';dbname=' . DBDATA ;
            $db = new PDO($dbconn , DBUSER , DBPASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // set the error mode to exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch(PDOException $e) { //Si se produce una excepcion notificarlo
            error_log('message:' . $e->getMessage());
        }
    }

    //Obtener los puntos de la base de datos en funcion de la posicion del usuario y del radio de distancia indicado
    function getHotspots( $db, $value ) {
        
        $sql = $db->prepare( "
        	SELECT *
        	FROM (
                            SELECT id,
                            Establecimiento as title,
                            Tipo as description,
                            Direccion as footnote,
                            Coordenada_X as lat,
                            Coordenada_Y as lon,
                            (((acos(sin((:lat1 * pi() / 180)) * sin((Coordenada_X * pi() / 180)) +
                                    cos((:lat2 * pi() / 180)) * cos((Coordenada_X * pi() / 180)) *
                                    cos((:long  - Coordenada_Y) * pi() / 180))
                               ) * 180 / pi()
                              )* 60 * 1.1515 * 1.609344 * 1000
                             ) as distance
                            FROM puntos
                            HAVING distance < :radius
                            UNION
                            SELECT id_guachinche as id,
                            name as title,
                            categoria as description,
                            specialty as footnote,
                            latitude as lat,
                            longitude as lon,
                            (((acos(sin((:lat1 * pi() / 180)) * sin((latitude * pi() / 180)) +
                                    cos((:lat2 * pi() / 180)) * cos((latitude * pi() / 180)) *
                                    cos((:long  - longitude) * pi() / 180))
                               ) * 180 / pi()
                              )* 60 * 1.1515 * 1.609344 * 1000
                             ) as distance  
                             FROM guachinches
                             HAVING distance < :radius   
             ) hotspots
			LEFT JOIN categorias ON hotspots.description = categorias.categoria
             ORDER BY distance ASC                       
                            " );
                            
        // PDOStatement::bindParam() binds the named parameter markers to the
        // specified parameter values.
        $sql->bindParam( ':lat1', $value['lat'], PDO::PARAM_STR );
        $sql->bindParam( ':lat2', $value['lat'], PDO::PARAM_STR );
        $sql->bindParam( ':long', $value['lon'], PDO::PARAM_STR );
        $sql->bindParam( ':radius', $value['radius'], PDO::PARAM_INT );
        // Use PDO::execute() to execute the prepared statement $sql.
        $sql->execute();
        // Iterator for the response array.
        $i = 0;
        // Use fetchAll to return an array containing all of the remaining rows in
        // the result set.
        // Use PDO::FETCH_ASSOC to fetch $sql query results and return each row as an
        // array indexed by column name.
        $rawPois = $sql->fetchAll(PDO::FETCH_ASSOC);
        /* Process the $rawPois result */
        // if $rawPois array is not  empty
        if ($rawPois) {
        // Put each POI information into $hotspots array.
            foreach ( $rawPois as $rawPoi ) {
                $poi = array();
                $poi['id'] = $rawPoi['id'];
                $poi['imageURL'] = 'http://open-data-canarias.herokuapp.com/img/'.strtolower($rawPoi['description']).'.png';
                // get anchor object information, note that changetoFloat is a custom function used to covert a string variable to float.
                $poi['anchor']['geolocation']['lat'] = changetoFloat($rawPoi['lat']);
                $poi['anchor']['geolocation']['lon'] = changetoFloat($rawPoi['lon']);
                // get text object information
                $poi['text']['title'] = $rawPoi['title'];
                $poi['text']['description'] = $rawPoi['description'];
                $poi['text']['footnote'] = $rawPoi['footnote'];
                // Put the poi into the $hotspots array.
                $hotspots[$i] = $poi;
                $i++;
            }//foreach
        }//if
        return $hotspots;
    }//getHotspots    

?>