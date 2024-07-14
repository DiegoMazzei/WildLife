<?php 
$path = $root . '/views/dashboard/partials/';
include_once($path . 'head.php');
include_once($path . 'sidebar.php');
include_once($path . 'header.php');

require($root . 'database.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = htmlspecialchars($_GET['id']);

    $query = $connection->query("SELECT soccorritore.*, regprovcomune.Comune FROM soccorritore JOIN regprovcomune ON regprovcomune.Codice_comune = soccorritore.Codice_Comune WHERE Codice_Soccorritore =" . $id);

    if ($query->num_rows === 1) {
        $row = $query->fetch_assoc();
?>

        <main>
        <form action='update.php' method='post' name='myform'>
            <input type='hidden' name='id' value='<?php echo $row['Codice_Soccorritore']; ?>'><br>
            <label for="Nome">Nome:</label><br>
            <input type='text' name='nome' value='<?php echo $row['Nome']; ?>'><br>
            <label for="Cognome">Cognome:</label><br>
            <input type='text' name='cognome' value='<?php echo $row['Cognome']; ?>'><br>


            <label for="Indirizzo">Indirizzo:</label><br>
            <input type='text' name='indirizzo' value='<?php echo $row['Indirizzo']; ?>'><br>


            <label for="comune">Comune:</label><br>
            <select class="form-select" name="comune" id="comune">
                <option name="comune" value="">Inserisci il Comune</option>
                <?php
                $query = "SELECT DISTINCT Codice_comune, Comune FROM regprovcomune ORDER BY Codice_comune ASC;";
                $result = $connection->query($query);
                if ($result->num_rows > 0) {
                        while ($row2 = mysqli_fetch_assoc($result)){
                            ?>
                            <option name="comune" value="<?php echo $row2['Codice_comune']; ?>"><?php echo $row2['Comune']; ?></option>
                            <?php
                        }
                    }
                ?>
                </select><br>

            <label for="Telefono">Telefono:</label><br>
            <input type='text' name='telefono' value='<?php echo $row['Telefono']; ?>'><br>
            <label for="Email">Email:</label><br>
            <input type='text' name='email' value='<?php echo $row['Email']; ?>'><br><br>
            
            
            <label for="Tipologia"> Tipologia</label>
            <select class="form-select" name="tipologia" id="tipologia">
                <?php
                $query = "SELECT DISTINCT Codice_Tip_Soccorritore, Descrizione FROM tipologia_soccorritore ORDER BY Codice_Tip_Soccorritore ASC;";
                $result = $connection->query($query);
                if ($result->num_rows > 0) {
                    while ($row3 = mysqli_fetch_assoc($result)){
                        if($row3['Codice_Tip_Soccorritore'] == $row['Codice_Tip_Soccorritore']) { ?>
                            <option selected value="<?php echo $row['Codice_Tip_Soccorritore']; ?>"><?= $row3['Descrizione'] ?></option>
                        <?php
                        }
                        else { ?>
                            <option name="tipologia" value="<?php echo $row3['Codice_Tip_Soccorritore']; ?>"><?php echo $row3['Descrizione']; ?></option>
                        <?php
                        }
                    }
                }
                ?>
            </select><br><br>
            

            <input type='submit' value='Modifica'>
        </form>
    </main>
<?php
    } else {
        echo "Il soccorritore non esiste nei nostri archivi";
        die();
    }
}
?>
