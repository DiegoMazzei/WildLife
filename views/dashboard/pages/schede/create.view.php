<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>

let responseFile = "/wildlife/controllers/dashboard/regprovcomune.php";
$(document).ready(function() {
    $('#regione').on('change', function() {
        let regione = $(this).val();
    $.ajax({
            method: "POST",
            url: responseFile,
            data: {
                regione: regione
            },
            datatype: "html",
            success: function (data) {
                $("#provincia").html(data);
                $("#comune").html("<option value=''>Seleziona Comune</option>")
            }
        })
    });
});

$(document).ready(function() {
    $('#provincia').on('change', function() {
        let provincia = $(this).val();
    $.ajax({
            method: "POST",
            url: responseFile,
            data: {
                provincia: provincia
            },
            datatype: "html",
            success: function (data) {
                $("#comune").html(data);
            }
        })
    });
});
</script>

<script>

function controllo () {

    let regione = document.forms["myform"]["regione"].value;

    let provincia = document.forms["myform"]["provincia"].value;

    let comune = document.forms["myform"]["comune"].value;

    let centro = document.forms["myform"]["centro"].value;

    let specie = document.forms["myform"]["animale"].value;

    let soccorritore = document.forms["myform"]["soccorritore"].value;

    let sviluppo = document.forms["myform"]["sviluppo"].value;

    let triage = document.forms["myform"]["triage"].value;

    let ricovero = document.forms["myform"]["ricovero"].value;

    let operatore = document.forms["myform"]["operatore"].value;

    let immagine = document.forms["myform"]["immagine"];
    let imageValue = immagine.value;
    let imageType = immagine.type;
    let imageSize = immagine.size;

    if (regione == "") {

        window.alert("Inserisci il codice della regione");
        
        return false;

    }

    if (provincia == "") {

        window.alert("Inserisci il codice della provincia");

        return false;

    }

    if (comune == "") {

        window.alert("Inserisci il codice del comune");

        return false;

    }

    if (centro == "") {

        window.alert("Inserisci il centro");

        return false;

    }

    if (specie == "") {

        window.alert("Inserisci la specie dell'animale");

        return false;

    }

    if (soccorritore == "") {

        window.alert("Inserisci il codice del soccorritore");

        return false;

    }

    if (sviluppo == "") {

        window.alert("Inserisci la fase di sviluppo dell'animale");

        return false;

    }

    if (triage == "") {

        window.alert("Inserisci il triage dell'animale");

        return false;

    }

    if (ricovero == "") {

        window.alert("Inserisci la condizione dell'animale");

        return false;

    }

    if (operatore == "") {

        window.alert("Inserisci l'operatore");

        return false;

    }

    if (imageValue == "") {

        window.alert("Inserisci un'immagine");

        return false;
        
    } else {
        if (imageType.match('image/*')) {
            window.alert("Il file inserito non è un'immagine");
            return false;
        }
    }

}

</script>

<main>
    <form action="" method="post" name="myform" onsubmit = "return controllo()" enctype="multipart/form-data">

        <label for="regione"> Regione</label>
        <select class="form-select" id="regione">
            <option  value=""> Seleziona la regione del ritrovamento</option>
            <?php foreach ($regioniData as $record) : ?>
                <option value="<?php echo $record['Regione']; ?>"> <?= $record['Regione'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="provincia"> Provincia</label>
        <select class="form-select" id="provincia">
        </select><br><br>

        <label for="comune"> Comune</label>
        <select class="form-select" name="codiceComune" id="comune">
        </select><br><br>

        <label for="latitudine">Latitudine Ritrovamento</label>
        <input type="text" id="latitudine" name="latitudine" required><br><br>

        <label for="longitudine">Longitudine Ritrovamento</label>
        <input type="text" id="longitudine" name="longitudine" required><br><br>

        <label for="centro">Centro</label>
        <select class="form-select" name="codiceCentro" id="centro">
            <option value=""> Seleziona il centro di ricovero </option>
            <?php foreach ($centriData as $record) : ?>
                <option value="<?php echo $record['Codice_centro']; ?>"><?= $record['Denominazione'] ?>   </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="animale">Specie Animale</label>
        <select class="form-select" name="codiceAnimale" id="animale">
            <option value=""> Seleziona la specie dell'animale ricoverato </option>
            <?php foreach ($animaliData as $record) : ?>
                <option value="<?php echo $record['Codice_animale']; ?>"><?= $record['Nome_taxon']?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="soccorritore">Soccorritore dell'Animale</label>
        <select class="form-select" name="codiceSoccorritore" id="soccorritore">
            <option value=""> Seleziona il soccorritore </option>
            <?php foreach ($soccorritoriData as $record) : ?>
                <option value="<?php echo $record['Codice_soccorritore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="sviluppo">Fase di Sviluppo</label>
        <select class="form-select" name="codiceSviluppo" id="sviluppo">
            <option value=""> Seleziona la fase di sviluppo</option>
            <?php foreach ($sviluppoData as $record) : ?>
                <option value="<?php echo $record['Codice_fase']; ?>"><?php echo $record['Descrizione']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="triage">Triage</label>
        <select class="form-select" name="codiceTriage" id="triage">
            <option value=""> Seleziona il triage </option>
            <?php foreach ($triageData as $record) : ?>
                <option value="<?php echo $record['Codice_triage']; ?>"><?php echo $record['Descrizione']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="ricovero">Causa Ricovero</label>
        <select class="form-select" name="codiceRicovero" id="ricovero">
            <option value=""> Seleziona la causa di ricovero </option>
            <?php foreach ($ricoveriData as $record) : ?>
                <option value="<?php echo $record['Codice_ricovero']; ?>"> <?= $record['Descrizione'] ?> </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="operatore">Operatore</label>
        <select class="form-select" name="codiceOperatore" id="operatore">
            <option value=""> Seleziona l'operatore </option>
            <?php foreach ($operatoriData as $record) : ?>
                <option value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="note">Note </label><br>
        <textarea name = "note" id = "note" rows = "4" columns = "50" placeholder = "scrivi le tue note"></textarea><br><br>

        <label for="immagine">Foto dell'Animale: </label>
        <input type="file" name="immagine" accept="image/*" id="immagine"> <br><br>

        <input type="submit" value="Invia">
        <button type = "reset"> Reset </button>
    </form>
</main>

<?php include_once($path . 'foot.php'); ?>
