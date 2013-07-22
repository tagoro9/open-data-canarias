<?php
    /* Put parameters from GetPOI request into an associative array named $requestParams */
    // Put needed parameter names from GetPOI request in an array called $keys.
    $keys = array( 'layerName', 'lat', 'lon', 'radius' );
    
    // Initialize an empty associative array.
    $requestParams = array();
    // Call funtion getRequestParams()
    $requestParams = getRequestParams($keys);

    // Connect to predefined MySQL database.
    $db = connectDb();

    
    // Put needed getPOI request parameters and their values in an associative array
    //
    // Arguments:
    //  array ; An array of needed parameters passed in getPOI request
    //
    // Returns:
    //  array ; An associative array which contains the request parameters and
    //  their values.
    function getRequestParams($keys) {
        
        $paramsArray = array();
        try {
            // Retrieve parameter values using $_GET and put them in $value array with
            // parameter name as key.
            foreach( $keys as $key ) {
                if (isset($_GET[$key]))
                    $paramsArray[$key] = $_GET[$key];
                else
                    throw new Exception($key .' parameter is not passed in GetPOI request.');
            }
            return $paramsArray;
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }//getRequestParams 

    
    // Connect to the database, configuration information is stored in
    // config.inc.php file
    function connectDb() {
        try {
            $dbconn = 'mysql:host=' . DBHOST . ';dbname=' . DBDATA ;
            $db = new PDO($dbconn , DBUSER , DBPASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // set the error mode to exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            return $db;
        }// try
        catch(PDOException $e) {
            error_log('message:' . $e->getMessage());
        }// catch
    }// connectDb
    
    function getHotspots( $db, $value ) {
        
        /* Create the SQL query to retrieve POIs whose "poiType" value is "geo"  and
         
         the distance between POIs and the user is within the "radius" returned from GetPOI request.
         Returned POIs are sorted by distance and the first 50 POIs are selected.
         The distance is caculated based on the Haversine formula.
         Note: this way of calculation is not scalable for querying large database.
         */
        
        // Use PDO::prepare() to prepare SQL statement.
        // This statement is used due to security reasons and will help prevent general SQL injection attacks.
        // ":lat1", ":lat2", ":long" and ":radius" are named parameter markers for which real values
        // will be substituted when the statement is executed.
        // $sql is returned as a PDO statement object.
        $sql = $db->prepare( "
                            SELECT id,
                            //imageURL,
                            establecimiento,
                            tipo,
                            //footnote,
                            latitud,
                            longitud,
                            (((acos(sin((:lat1 * pi() / 180)) * sin((lat * pi() / 180)) +
                                    cos((:lat2 * pi() / 180)) * cos((lat * pi() / 180)) *
                                    cos((:long  - lon) * pi() / 180))
                               ) * 180 / pi()
                              )* 60 * 1.1515 * 1.609344 * 1000
                             ) as distance
                            FROM puntos //Faltan guachinches
                            WHERE poiType = "geo"
                            HAVING distance < :radius
                            ORDER BY distance ASC
                            LIMIT 0, 50 " );
                            
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
                $poi['imageURL'] = $rawPoi['imageURL'];
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
                            
    /* Construct the response into an associative array */
    
    // Create an empty array named response.
    $response = array();
                            
    // Assign cooresponding values to mandatory JSON response keys.
    $response['layer'] = $requestParams['layerName'];
                
    // Use getHotspots() function to retrieve POIs with in the search range.
    $response['hotspots'] = getHotspots( $db, $requestParams );
                        
    // if there is no POI found, return a custom error message.
    if ($response['hotspots']) {
        $response['errorCode'] = 20;
        $response['errorString'] = "No POI found. Please adjust the range.";
    }//if
    else {
        $response['errorCode'] = 0;
        $response['errorString'] = "ok";
    }//else
                            
    /* All data is in $response, print it into JSON format.*/
                        
    // Put the JSON representation of $response into $jsonresponse.
    $jsonresponse = json_encode( $response );
                            
    // Declare the correct content type in HTTP response header.
    header( "Content-type: application/json; charset=utf-8" );
                            
    // Print out Json response.
    echo $jsonresponse;
                            
                            
?>