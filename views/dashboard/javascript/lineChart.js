const grafico = document.getElementById("lineChart");

let lineChart = new Chart (grafico, {
	
	type: 'line',
	data: {
		
		labels: ["Lunedi", "Martedi", "Mercoledi", "Giovedi", "Venerdi", "Sabato", "Domenica"],
		
		datasets: [
		
			{
			
				label: "Diagnosi", 
				// lineTension: 5,
				backgroundColor: "rgba (75, 192, 192, 0.4)",
				borderColor: "rgba (75, 192, 192, 1)",
				pointBorderColor: "rgba (75, 192, 192, 1)",
				pointHoverBorderColor: "rgba (220, 220, 220, 1)",
				// pointRadius: 1,
				// pointHitRadius: 10,
				data: [65, 200, 300, 81, 56, 55, 32],
			
			},
			{
			
				label: "Esami", 
				backgroundColor: "rgba (75, 192, 192, 0.4)",
				borderColor: "rgba (75, 192, 192, 1)",
				pointBorderColor: "rgba (75, 192, 192, 1)",
				pointHoverBorderColor: "rgba (220, 220, 220, 1)",
				// pointRadius: 1,
				// pointHitRadius: 10,
				data: [78, 300, 200, 10, 46, 34, 91],
			
			},

			{
			
				label: "Terapie", 
				backgroundColor: "rgba (75, 192, 192, 0.4)",
				borderColor: "rgba (75, 192, 192, 1)",
				pointBorderColor: "rgba (75, 192, 192, 1)",
				pointHoverBorderColor: "rgba (220, 220, 220, 1)",
				// pointRadius: 1,
				// pointHitRadius: 10,
				data: [12, 46, 22, 100, 29, 45, 11],
			
			}
		
		]
	
	},
	options: {
		maintainAspectRatio: false,
	}
	
});
