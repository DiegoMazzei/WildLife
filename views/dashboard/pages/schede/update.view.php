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

<main>
    <?php if (isset($schedaId) && count($schedaData) != 0) : ?>
        <form action="" method="post" name="myform" enctype="multipart/form-data">

            <input hidden value="<?= $schedaData['Codice_Accettazione'] ?>" type="text" name="schedaId">

            <label for="regione"> Regione</label>
            <select class="form-select" name="codiceRegione" id="regione">
                <option  value=""> Seleziona la regione del ritrovamento</option>
                <?php foreach ($regioniData as $record) : ?>
                    <?php if ($record['Regione'] === $schedaData['Regione']) : ?>
                        <option selected value="<?php echo $record['Regione']; ?>"> <?= $record['Regione'] ?></option>
                    <?php else: ?>
                        <option value="<?php echo $record['Regione']; ?>"> <?= $record['Regione'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="provincia"> Provincia</label>
            <select class="form-select" name="codiceProvincia" id="provincia">
                <option  value=""> Seleziona il codice della provincia del ritrovamento</option>
                <?php foreach ($provinceData as $record) : ?>
                    <?php if ($record['SiglaPR'] === $schedaData['SiglaPR']) : ?>
                        <option selected value="<?php echo $record['SiglaPR']; ?>"> <?= $record['Provincia'] ?></option>
                    <?php else: ?>
                        <option value="<?php echo $record['SiglaPR']; ?>"> <?= $record['Provincia'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="comune"> Comune</label>
            <select class="form-select" name="codiceComune" id="comune">
                <option  value=""> Seleziona il codice del comune di ritrovamento</option>
                <?php foreach ($comuniData as $record) : ?>
                    <?php if ($record['Codice_Comune'] === $schedaData['Codice_Comune']) : ?>
                        <option selected name="codiceComune" value="<?php echo $record['Codice_Comune']; ?>"> <?= $record['Comune'] ?></option>
                    <?php else: ?>
                        <option name="codiceComune" value="<?php echo $record['Codice_Comune']; ?>"> <?= $record['Comune'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="latitudine">Latitudine Ritrovamento:</label><br>
            <input value="<?= $schedaData['Latitudine'] ?>" type="text" id="latitudine" name="latitudine" required><br><br>

            <label for="longitudine">Longitudine Ritrovamento:</label><br>
            <input value="<?= $schedaData['Longitudine'] ?>" type="text" id="longitudine" name="longitudine" required><br><br>

            <label for="centro">Centro</label>
            <select class="form-select" name="codiceCentro" id="centro">
                <?php foreach ($centriData as $record) : ?>
                    <?php if ($record['Codice_centro'] === $schedaData['Codice_Centro']) : ?>
                        <option selected value="<?php echo $record['Codice_centro']; ?>"><?= $record['Denominazione'] ?>   </option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_centro']; ?>"><?= $record['Denominazione'] ?>   </option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="animale">Specie Animale</label>
            <select class="form-select" name="codiceAnimale" id="animale">
                <?php foreach ($animaliData as $record) : ?>
                    <?php if ($record['Codice_animale'] === $schedaData['Codice_Animale']) : ?>
                        <option selected value="<?php echo $record['Codice_animale']; ?>"> <?= $record['Nome_Taxon']?></option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_animale']; ?>"> <?= $record['Nome_Taxon']?></option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="soccorritore">Soccorritore Animale</label>
            <select class="form-select" name="codiceSoccorritore" id="soccorritore">
                <?php foreach ($soccorritoriData as $record) : ?>
                    <?php if ($record['Codice_soccorritore'] === $schedaData['Codice_Soccorritore']) : ?>
                        <option selected value="<?php echo $record['Codice_soccorritore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_soccorritore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="sviluppo">Fase Sviluppo</label>
            <select class="form-select" name="codiceSviluppo" id="sviluppo">
                <?php foreach ($sviluppoData as $record) : ?>
                    <?php if ($record['Codice_fase'] === $schedaData['Codice_Fase']) : ?>
                        <option selected value="<?php echo $record['Codice_fase']; ?>"><?php echo $record['Descrizione']; ?></option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_fase']; ?>"><?php echo $record['Descrizione']; ?></option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="triage">Triage</label>
            <select class="form-select" name="codiceTriage" id="triage">
                <?php foreach ($triageData as $record) : ?>
                    <?php if ($record['Codice_triage'] === $schedaData['Codice_Triage']) : ?>
                        <option selected value="<?php echo $record['Codice_triage']; ?>"><?php echo $record['Descrizione']; ?></option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_triage']; ?>"><?php echo $record['Descrizione']; ?></option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="ricovero">Ricovero</label>
            <select class="form-select" name="codiceRicovero" id="ricovero">
                <?php foreach ($ricoveriData as $record) : ?>
                    <?php if ($record['Codice_ricovero'] === $schedaData['Codice_Ricovero']) : ?>
                        <option selected value="<?php echo $record['Codice_ricovero']; ?>"> <?= $record['Descrizione'] ?> </option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_ricovero']; ?>"> <?= $record['Descrizione'] ?> </option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="operatore">Operatore</label>
            <select class="form-select" name="codiceOperatore" id="operatore">
                <?php foreach ($operatoriData as $record) : ?>
                    <?php if ($record['Codice_operatore'] === $schedaData['Codice_Operatore']) : ?>
                        <option selected value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="esito">Esito</label>
            <select class="form-select" name="codiceEsito" id="esito">
                <option value=""> Seleziona l'esito </option>
                <?php foreach ($esitiData as $record) : ?>
                    <?php if ($record['Codice_Esito'] === $schedaData['Codice_Esito']) : ?>
                        <option selected value="<?php echo $record['Codice_Esito']; ?>"><?php echo $record['Descrizione']; ?></option>
                    <?php else : ?>
                        <option value="<?php echo $record['Codice_Esito']; ?>"><?php echo $record['Descrizione']; ?></option>
                    <?php endif;  ?>
                <?php endforeach; ?>
            </select><br><br>

            <label for="dataEsito">Data Esito: </label> <br>
            <input type="date" value="<?= ((isset($schedaData['dataEsito'])) ? ($schedaData['dataEsito']) : '') ?>" name="dataEsito" id="dataEsito"> <br><br>

            <label for="note">Note:</label><br>
            <textarea id="note" name="note" rows = "4" columns = "50" required><?= $schedaData['Note'] ?></textarea><br><br>

            <label for="immagine">Immagine Animale: </label> <br>
            <input type="file" name="immagine" id="immagine"> <br><br>

            <input type="submit" value="Modifica">
        </form>
    <?php elseif (count($schedaData) === 0) : ?>
        <h1>La scheda richiesta non è presente nel sistema</h1>
    <?php else : ?>
        <h1>Non hai richiesto la modifica di nessuna scheda</h1>
    <?php endif; ?>
    </main>


<?php include_once($path . 'foot.php'); ?>
