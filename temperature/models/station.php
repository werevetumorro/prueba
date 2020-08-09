<?php
    require_once('connection.php');
    require_once('exceptions/recordnotfoundexception.php');
    require_once('reading.php');

    class Station {
        //attributes
        private $id;
        private $description;
        private $ipAddress;

        //getters && setters
        public function getId() { return $this->id; }
        public function getDescription() { return $this->description; }
        public function getIpAddress() { return $this->ipAddress; }

        public function __construct() {
            if(func_num_args() == 1) {
                //get connection
                $connection = MySqlConnection::getConnection();
                //query
                $query = 'select id, description, ipAddress from station where id = ?';
                //prepare statement
                $command = $connection->prepare($query);
                //params
                $command->bind_param('i',func_get_arg(0));
                //exec
                $command->execute();
                //bind results
                $command->bind_result($id, $description, $ipAddress);
                //record was found
                if($command->fetch()) {
                   $this->id = $id;
                   $this->description = $description;
                   $this->ipAddress = $ipAddress;
                   //new Station($id, $description, $ipAddress); 
                } else {
                    throw new RecordNotFoundException(func_get_arg(0));
                }
                //close command
                mysqli_stmt_close($command);

                //close connection 
                $connection->close();
           
            }
            if(func_num_args() == 3) {
                $this->id = func_get_arg(0);
                $this->description = func_get_arg(1);
                $this->ipAddress = func_get_arg(2);
            }
        }

        //returns a list of stations
        public static function getAll() {
            $list  = array();//create list
            //get connection
            $connection = MySqlConnection::getConnection();
            $query = 'select id, description, ipAddress from station';
            $command = $connection->prepare($query);
            $command->execute();
            $command->bind_result($id, $description, $ipAddress);
            // fetch data
            while($command->fetch()) {
                //add station to list
               array_push($list, new Station($id, $description, $ipAddress));
            }
            return $list;
        }

        //returns a list of readings
        public static function getReadings($par) {
            $list  = array();//create list
            //get connection
            $connection = MySqlConnection::getConnection();
            $query = 'select id, date, temperature, humidity, windQuality, powder from readings where idStation = ? order by id desc limit 0, 15';
            $command = $connection->prepare($query);
            $command->bind_param('i', $par);
            $command->execute();
            $command->bind_result($id, $date, $temperature, $humidity, $windQuality, $powder);
            // fetch data
            while($command->fetch()) {
                //add station to list
                array_push($list, new Reading($id, $date, $temperature, $humidity, $windQuality, $powder));
            }
            
             return $list;
        }
        
        public function getAllToJson() {
            $jsonArray = array();
            foreach(self::getAll() as $item) {
                array_push($jsonArray, json_decode($item->toJson()));
            }
            return json_encode($jsonArray);
        }

        public function getAllReadingsToJson($par) {
            $list = array();
            foreach($this->getReadings($par) as $item) {
                array_push($list, json_decode($item->toJson()));
            }
            return json_encode(array(
                'id' => $this->id,
                'description' => $this->description,
                'ipAddress' => $this->ipAddress,
                'readings' => $list
            ));
        }

        
        public function toJson() {
            return json_encode(array(
                'id' => $this->id,
                'description' => $this->description,
                'ipAddress' => $this->ipAddress
            ));
        }

    }
?>