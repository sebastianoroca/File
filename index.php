<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Tabella Log CSV</title>
</head>
<body>

<?php
    $file = fopen("log.csv", "r");
    if(!$file){ // Equivale a $file === false
        die("Errore nell'apertura del file");
        // die($msg) interrompe l'esecuzione dello script 
        // viene stampato a schermo il messaggio $msg
    }
    // Non mi serve avere un ramo else perchè in caso di errore
    // Lo script viene interrotto a riga 4

    // Se il file esiste e viene aperto correttamente:
    echo "<table border='1'>";
    $primaRiga = true; // la prima riga del CSV contiene le intestazioni

    while(!feof($file)){ // feof($file) === false
        $row = fgets($file); // Corretto: aggiunti i simboli $ ($row e $file)

        // salto eventuali righe vuote (es. l'ultima riga del file)
        if(trim($row) === ""){
            continue;
        }

        // devo usare explode con "," come separatore
        // e $row come stringa da separare
        // avrò in output un array di stringhe da visualizzare
        // nella <tr></tr>. Ciascun elemento di questo array
        // dev'essere in una cella <td></td>
        $campi = explode(",", trim($row)); // Corretto: aggiunti i simboli $ ($campi e $row)

        echo "<tr>";
        foreach($campi as $campo){
            if($primaRiga){
                echo "<th>" . htmlspecialchars($campo) . "</th>";
            } else {
                echo "<td>" . htmlspecialchars($campo) . "</td>";
            }
        }
        echo "</tr>";
        $primaRiga = false;
        // Questo ciclo viene eseguito finchè il file ha dei contenuti da leggere
    }

    echo "</table>";

    fclose($file);
?>

</body>
</html>