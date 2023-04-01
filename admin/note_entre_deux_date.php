<?php
    require '../require/connection_DB.php';

    function DeuxDate($date) {
        $dates = explode('-', $date);
        $date_deb = $dates[0];
        $date_fin = $dates[1];
        return array($date_deb, $date_fin);
    }
    
    $date_in_deb = "2015";
    $date_in_fin = "2016";
    if ($date_in_deb < $date_in_fin) {
        list($date_deb, $date_fin) = DeuxDate("$date_in_deb-$date_in_fin");
        echo "Date de début : " . $date_deb . "<br>";
        echo "Date de fin : " . $date_fin . "<br>";
        $sql = "SELECT annee_univ FROM annee_univ";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $annee = array();
            while($row = mysqli_fetch_assoc($result)) {
                $annee = explode ('-', $row['annee_univ']);
                if ((($annee [0] >= $date_deb && $annee [0] < $date_fin) && ($annee [1] > $date_deb && $annee [1] <= $date_fin)) >= 1){
                    echo $annee [0] . " - " . $annee [1] . "<br/>";
                }else{ 
                    echo "Pas d'annee pour cette date";
                    break;
                }
            }
        } else {
            echo "Aucune date trouvée dans la base de données.";
        }
    } else {
        echo "l'annee est incorecte";
    }
?>