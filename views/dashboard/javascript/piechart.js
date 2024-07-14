// Recupera i dati dei codici di ricovero dai paragrafi nascosti nel HTML
let bianchi = parseInt(document.getElementById('nBianchi').textContent);
let neri = parseInt(document.getElementById('nNeri').textContent);
let verdi = parseInt(document.getElementById('nVerdi').textContent);
let rossi = parseInt(document.getElementById('nRossi').textContent);
let grigi = parseInt(document.getElementById('nGrigi').textContent);

// Imposta i dati e le etichette per il grafico a torta
let labels = ['Bianco', 'Verde', 'Rosso', 'Nero', 'Grigio'];
let itemData = [bianchi, verdi, rossi, neri, grigi];

const data = {
    labels: labels,
    datasets: [{
        data: itemData,
        backgroundColor: [
            'rgb(255, 255, 255)', 
            'rgb(0, 255, 38)', 
            'rgb(255, 0, 0)', 
            'rgb(10, 10, 10)', 
            'rgb(140, 140, 140)'
        ],
        borderWidth: 3,
        borderColor: 'rgb(10, 10, 10)', 
    }]
};

const config = {
    type: 'pie',
    data: data, 
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'right'
            },
        }
    }
};

// Crea il grafico a torta
const pieChart = new Chart(
    document.getElementById('pieChart'),
    config
);