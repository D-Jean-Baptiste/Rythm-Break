<?php

    /**
     * @author Damodarane&Elumalai
     */
    function getImageNasa() : string {
        $s = "";
        $json = file_get_contents("https://api.nasa.gov/planetary/apod?api_key=8voCfhA1Kwo3y4ubOB0p39kFwq8Dlggiq0ofJ5qT");
        $json = json_decode($json);
        foreach($json as $key => $value) {
            if($key == "url") {
                $url = $value;
            }
            if($key == "title") {
                $title = $value;
            }
            if($key == "copyright") {
                $copy = $value;
            }
        }
        $s.="<figure> \n";
        $s.="<img class='monimage' src='$url' alt='image du jour par apod nasa' width='500' height='500' /> \n";
        $s.="<figcaption class='center'>".$title." : Copyright © ".$copy."</figcaption> \n";
        $s.="</figure> \n";
        return $s;
    }

    
    /**
     * @author Damodarane&Elumalai
     */
    function getLocalisation()
    {
        $finaloc = "";
        $addip = getenv('REMOTE_ADDR');//geolocalisation
        $loc = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$addip")); //une liste d'informations
        $ville = $loc["geoplugin_city"];
        $pays = $loc["geoplugin_countryName"];
        $regionName = $loc['geoplugin_regionName'];
        $regionCode = $loc['geoplugin_regionCode'];
        $region = $loc['geoplugin_region'];

        $finaloc.=   "<p style='color:white'>Vous vous trouvez aux alentours de : $ville $regionName $regionCode $region $pays</p>";      
        return $finaloc;         
    }

    /**
     * @author Damodarane&Elumalai
     */

    function getArtist(string $eltrecherche): array{
        //on recupere le contenu
        $json2 = file_get_contents("https://ws.audioscrobbler.com/2.0/?method=artist.search&artist=".$eltrecherche."&api_key=ee832f2cbf4899e1409329429c40a34f&format=json");
        //on accede a des valeurs decode
        $json2 = json_decode($json2);
        $json3 = $json2->results;
        $json4 = $json3->artistmatches;
        $json5 = $json4->artist;
        return $json5;
    }
?>