<section class="counters widget">

		<div class="counter-container">

			<h3>Animali Ricoverati</h3>

			<img src = "/wildlife/views/dashboard/images/zampa.png" alt = "Zampa di un animale" width = "60" height = "60">

			<div class="counter" data-target="<?= $animaliRicoverati ?>">0</div>

		</div>

		<div class="counter-container">

			<h3>Operazioni Effettuate</h3>

			<img src = "/wildlife/views/dashboard/images/doctor.png" alt = "Dottore" width = "60" height = "60">

			<div class="counter" data-target="<?= $numOperazioni ?>">0</div>

		</div>

</section>

<?php

$query = "SELECT triage.Descrizione, COUNT(*) AS count FROM scheda_arrivo JOIN triage ON triage.Codice_Triage = scheda_arrivo.Codice_triage GROUP BY triage.Descrizione;";
$result = $connection->query($query);

$nBianchi = 0;
$nNeri = 0;
$nVerdi = 0;
$nRossi = 0;
$nGrigi = 0;

while ($row = $result->fetch_assoc()) {
    switch ($row['Descrizione']) {
        case 'Bianco':
            $nBianchi = $row['count'];
            break;
        case 'Nero':
            $nNeri = $row['count'];
            break;
        case 'Verde':
            $nVerdi = $row['count'];
            break;
        case 'Rosso':
            $nRossi = $row['count'];
            break;
        case 'Grigio':
            $nGrigi = $row['count'];
            break;
        default:
            break;
    }
}
?>

<p hidden id="nNeri"><?= $nNeri ?></p>
<p hidden id="nGrigi"><?= $nGrigi ?></p>
<p hidden id="nVerdi"><?= $nVerdi ?></p>
<p hidden id="nBianchi"><?= $nBianchi ?></p>
<p hidden id="nRossi"><?= $nRossi ?></p>

<div class="piechart widget">

	<canvas id="pieChart"></canvas>

</div>

<div class="linechart widget">

	<canvas id = "lineChart"></canvas> 

</div>

<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"></script>

<script src = "/wildlife/views/dashboard/javascript/incremento.js"></script>

<script src = "/wildlife/views/dashboard/javascript/piechart.js"></script>

<script src = "/wildlife/views/dashboard/javascript/lineChart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.js" integrity="sha512-WnjiZ4H9oGPsRYcEpiT97N4jexvpIUexmhP2mv6eCPvp1bahH1L9eOpCf1vzWb3lwdMmwoIZqiwgVPhhiOdeBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


