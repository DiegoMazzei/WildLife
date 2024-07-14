<?php
    
    if ($_SESSION['Ruolo'] !== 'Admin') {
        die("Accesso non autorizzato");
    }

        ?>