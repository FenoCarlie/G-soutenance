<?php
    require '../require/connection_DB.php';

    function DeuxDate($date) {
        $dates = explode('-', $date);
        $date_deb = $dates[0];
        $date_fin = $dates[1];
        return array($date_deb, $date_fin);
    }
    
    $date_in_deb = "2025";
    $date_in_fin = "2026";
    if ($date_in_deb < $date_in_fin) {
        list($date_deb, $date_fin) = DeuxDate("$date_in_deb-$date_in_fin");
        echo "Date de début : " . $date_deb . "<br>";
        echo "Date de fin : " . $date_fin . "<br>";
        $sql = "SELECT soutenir.id as s_id, soutenir.note as s_note, soutenir.annee_univ as s_annee_univ,
                soutenir.matricule as s_matricule, etudiant.nom as e_nom, etudiant.prenoms as e_prenoms, etudiant.niveau as e_niveau, etudiant.parcours as e_parcours
                FROM soutenir
                JOIN etudiant ON soutenir.matricule = etudiant.matricule";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $annee = array();
            while($row = mysqli_fetch_assoc($result)) {
                $annee = explode ('-', $row['s_annee_univ']);
                $matricule = $row['s_matricule'];
                $etudiant= $row['e_nom'] . ' ' . $row['e_prenoms'];
                $niveau = $row['e_niveau'] . ' ' . 'en' . ' ' . $row['e_niveau'];
                $note = $row['s_note'];

                if ((($annee [0] >= $date_deb && $annee [0] < $date_fin) && ($annee [1] > $date_deb && $annee [1] <= $date_fin)) >= 1){
                    echo $annee [0] . " - " . $annee [1] . ' ' . $matricule ."<br/>";
                    
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