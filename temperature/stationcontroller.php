<?php
    require_once('models/station.php');
    //get
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        //get all
        if($parameters == '') {
            echo json_encode(array(
                'status' => 0,
                'stations' => json_decode(Station::getAllToJson())
            ));
        } 
        //get one
        else {
            try {
                $s = new Station($parameters);
                echo json_encode(array(
                    'status' => 0,
                    'station' => json_decode($s->getAllReadingsToJson($parameters))
                ));
            }
            catch(RecordNotFoundException $ex) {
                echo json_encode(array(
                    'status' => 1,
                    'errorMessage' => $ex->getMessage()
                ));
            }
        }
    }
?>