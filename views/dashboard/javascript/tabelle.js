function filtrotabella(colonna) {
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("input" + colonna);
	filter = input.value.toUpperCase();
	table = document.getElementById("tabella");
	tr = table.getElementsByTagName("tr");

	for (i = 2; i < tr.length; i++) {

		td = tr[i].getElementsByTagName("td")[colonna];

		if (td) {

			txtValue = td.textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";

			} else {

				tr[i].style.display = "none";
			}
		}       
	}
}

function riordinacampo(colonna) {

	var tabella, righe, ordinando, i, a, b, bisognaRiordinare;
	tabella = document.getElementById("tabella");
	ordinando = true;

	while(ordinando) {

		ordinando = false;
		righe = tabella.rows;

		for(i = 2; i < (righe.length - 1); i++) {

			bisognaRiordinare = false;
			a = righe[i].getElementsByTagName("TD")[colonna];
			b = righe[i + 1].getElementsByTagName("TD")[colonna];

			if(a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {

				bisognaRiordinare = true;
				break;
			}
		}

		if(bisognaRiordinare) {

			righe[i].parentNode.insertBefore(righe[i + 1], righe[i]);
			ordinando = true;
		}
	}
}
