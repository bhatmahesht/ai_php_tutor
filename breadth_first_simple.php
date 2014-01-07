<?php
class City {

    var $current_city;
    var $sequence;
    public static $cities = array(
        'Kumta' => array('Ankola', 'Sirsi', 'Siddapur', 'Honavar'),
        'Ankola' => array('Kumta', 'Karwar', 'Yellapur'),
        'Karwar' => array('Ankola', 'Joida'),
        'Yellapur' => array('Haliyal', 'Mundagod', 'Sirsi', 'Joida', 'Ankola'),
        'Mundagod' => array('Haliyal', 'Sirsi', 'Yellapur'),
        'Siddapur' => array('Sirsi', 'Kumta', 'Honavar', 'Bhatkal'),
        'Sirsi' => array('Kumta', 'Yellapur', 'Siddapur', 'Mundagod'),
        'Honavar' => array('Kumta', 'Bhatkal', 'Siddapur'),
        'Bhatkal' => array('Honavar', 'Siddapur'),
        'Joida' => array('Yellapur', 'Haliyal', 'Karwar'),
        'Haliyal' => array('Joida', 'Yellapur', 'Mundagod')
    );

    function __construct($city) {
        $this−>current_city = $city;
        $this−>sequence = array();
    }

    function IsCityInSequence() {
        for ($i = 0; $i < count($this−>sequence); $i++) {
            if ($this−>sequence[$i] == $this−>current_city) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function LinkCities() {

        $link_cities = self::$cities[$this−>current_city];

        $traverse_cities = array();

        for ($i = 0; $i < count($link_cities); $i++) {

            $lcity = new City($link_cities[$i]);
            $lcity−>sequence = array_merge($this−>sequence);
            if ($lcity−>IsCityInSequence() == FALSE) {
                $lcity−>sequence[] = $link_cities[$i];
                $traverse_cities [] = $lcity;
            }
        }

        return $traverse_cities;
    }

}

$initial_city = new City('Bhatkal');
$initial_city−>sequence[] = 'Bhatkal';
$destination_city = new City('Haliyal');

$path_state = array();
$path_state [] = $initial_city;

for ($i = 0; $i < count($path_state); $i++) {
    $city = $path_state[$i];
    if ($city−>current_city == $destination_city−>current_city) {
        printf("It took $i steps to find the path <br>");
        print_r($city−>sequence);
        break;
    }

    $link_cities = $city−>LinkCities();

    foreach ($link_cities as $lcity) {
        $path_state [] = $lcity;
    }
}
?>
