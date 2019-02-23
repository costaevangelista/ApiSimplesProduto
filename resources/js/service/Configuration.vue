<script>

const BASE_URL = "http://localhost:8000/";
const API_URL = "http://localhost:8000/api/v1/";

function MENSAGEM_ALERT(titulo, mensagem, tipo) {
	window.swal({
		title: titulo,
		text: mensagem,
		icon: tipo,
		closeOnEsc: false,
		closeOnClickOutside: false,
		buttons: false,
		timer: 3000,
	});
}

export default {
	BASE_URL,
	API_URL,
	MENSAGEM_ALERT
}
</script>
