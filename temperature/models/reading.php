<?php
    class Reading {
        private $id;
        private $date;
        private $temperature;
        private $humidity;
        private $windQuality;
        private $powder;

        //setter && getter
        public function getId() { return $this->id; }  
        public function getDate() { return $this->date; }  
        public function getTemperature() { return $this->temperature; } 
        public function getHumidity() { return $this->humidity; } 
        public function getWindQuality() { return $this->windQuality; } 
        public function getPowder() { return $this->powder; } 

        //Constructor
        public function __construct() {
            if(func_num_args() == 6) {
                $this->id = func_get_arg(0);
                $this->date = func_get_arg(1);
                $this->temperature = func_get_arg(2);
                $this->humidity = func_get_arg(3);
                $this->windQuality = func_get_arg(4);
                $this->powder = func_get_arg(5);
            }
        }

        public function toJson() {
            return json_encode(array(
                'id' => $this->id,
                'dateTime' => $this->date,
                'temperature' => $this->temperature,
                'humidity' => $this->humidity,
                'windQuality' => $this->windQuality,
                'powder' => $this->powder
            ));
        }
    }
?>