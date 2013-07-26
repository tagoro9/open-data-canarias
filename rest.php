<?php

    //Cargar datos de configuracion de la base de datos
    require_once('config.php');
    //Cargamos el fichero con las funciones
    require_once('functions.php');
    //Definimos el conjunto de parametros obligatorios que deben de venir en la peticion
    $keys = array( 'layerName', 'lat', 'lon', 'radius' );
    //Leer los parametros de la peticion   
    $requestParams = array();
    $requestParams = getRequestParams($keys);
    //Conectamos con la base de datos
    $db = connectDb();

    //Comenzar a construir la respuesta        
    $response = array();
    //La respuesta se crea siguiendo la documentacion de Layar
    $response['layer'] = $requestParams['layerName'];
    // Usar getHotspots para obtener los puntos desde la base de datos
    $response['hotspots'] = getHotspotsRestauracion( $db, $requestParams );
    $response['showDialog']['title'] = "Augwesome Reality";
    $response['showDialog']['description'] = "I Concurso Open Data Canarias";
                        
    //Si no hay puntos devolver un codigo de error 20
    if (!$response['hotspots']) {
        $response['errorCode'] = 20;
        $response['errorString'] = "No POI found. Please adjust the range.";
    }
    else {
        $response['errorCode'] = 0;
        $response['errorString'] = "ok";
    }
    //var_dump($response);         

    //Convertir la respuesta a JSON
    $jsonresponse = json_encode( $response );
                            
    //Introducir la cabecera HTTP de datos de tipo JSON
    header( "Content-type: application/json; charset=utf-8" );
                            
    //Devolver la respuesta
    echo $jsonresponse;
                            
                            
?>