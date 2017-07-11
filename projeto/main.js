// Aluno: Jorge A C Andrade. R.A.: 1619107-5
// MAPA DE PROGRAMAÇÂO III
// Arquivo javascript para controle dinâmico do front-end.
// todo o código é colocado dentro da função ready para garantir que seja executado após o load da página.
$(document).ready(function () {

	getList();	// primeira chamada ajax para listar os arquivos do diretório no load inicial da página.

	//captura do evento de submit para validação e chamada ajax.
	$("form").submit(function(e){
		e.preventDefault();
		sendImage();	
	});
	
	//função que renderiza a tabela com a lista de arquivos na pasta upload recebidos do servidor.
	function renderList(photos){
		$("tbody").empty();
		photos = Object.keys(photos).map(
				function (key) {
					return photos[key];
				});
		photos.sort().forEach(function (photo, index){
			$("tbody").append("<tr><td>" + (index + 1) + "</td><td>" + photo + "</td><td><a class='remove-link' href='" + photo + "'>Excluir</a></td>"
);
		});
		$(".remove-link").click( function (e){
			e.preventDefault();
			removeImage($(this).attr('href'));
		});
		
	}
	//função que exibe feedback ao usuário, é usado uma função async para remover o alerta após 5 segundos
	function showFeedback(container, type, strong, message){
		$(".panel-" + container).prepend("<div class='alert alert-" + type + "'><strong>" + strong + ". </strong>" + message +".</div>");
		window.setTimeout(function() {
			$(".alert-" + type).fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 5000);
	}

	//função de validação de formulario
	//Valida nesta ordem:
	//Nome do arquivo já existe, apenas caracteres alfanuméricos e _, verifica se uma imagem foi selecionada, se ela tem menos de 3MB,
	//e se é suportada(JPEG/PNG/JPG)
	//retorna TRUE se toda as condições forem cumpridas, exibe feedback de acordo ao usuário chamando a função showFeedback;
	function validateForm(){

		var file = $(":file")[0].files[0];
		var filename = $("#file-name").val();
		var files = []; 
		var ext = "." + file.type.substring(file.type.lastIndexOf("/")+1);

		$("tbody tr td:nth-child(2)").each(function (){
			files.push($(this).text());
		});
		if(files.indexOf(filename+ext) >= 0){
			showFeedback("file-upload", "danger", "Erro", "Já existe um arquivo com este nome! Escolha outro nome para o arquivo e tente novamente");
			return false;
		}else if(!(/^[\w]+$/igm).test(filename)){
			showFeedback("file-upload", "danger", "Erro", "Apenas caracteres alfa-numéricos e _ são permitidos no nome do arquivo");
			return false;
		}else{
			if(!file){
				showFeedback("file-upload", "danger", "Erro", "Você deve selecionar uma imagem");
				return false;
			}else if(file.size > 4000000){
				showFeedback("file-upload", "danger", "Erro", "Arquivo muito grande! Tamanho máx.: 3MB");
				return false;

			}else if(file.type !== "image/jpeg" && file.type !== "image/jpg" && file.type !== "image/png"){

				showFeedback("file-upload", "danger", "Erro", "Arquivo não suportado. JPEG, JPG e PNG apenas");
				return false;
			}else {
				return true;
			}	
		}
	}

	//função async para de exclusão de arquivos, faz uma chamada ajax  pelo método DELETE
	//e chama a função que exibe o feedback do resultado da operação
	function removeImage(imageName){
			$.ajax({
				url: "excluir_arquivo.php?"+imageName,
				type: "DELETE"
			}).done(function (data){
				showFeedback("file-list", "success", "Pronto", "Arquivo removido com sucesso");
				getList(data);
			}).fail(function (error){
				console.log("erro: ", error);
				showFeedback("file-upload", "danger", error.status, error.responseText);

			});		

					
	}
	//função async de envio de arquivo, faz a chamada ajax método POST ao aruivo cadastrar_arquivo.php
	//e chama a função que exibe feedback do resultado da operação
	function sendImage(){
		if(validateForm()){
			var file = $(":file")[0].files[0];
			var filename = $("#file-name").val();
			var data = new FormData();
			data.append('file', file);
			data.append('newname', filename);
			$.ajax({
				url: "cadastrar_arquivo.php",
				type: "POST",
				data: data,
				enctype: 'multipart/form-data', 
				processData: false, 
				contentType: false
			}).done(function (data){
				showFeedback("file-upload", "success", "Pronto", "Foto enviada ao servidor");
				getList(data);
			}).fail(function (error){
				console.log("erro: ", error);
				showFeedback("file-upload", "danger", error.status, error.responseText);

			});		

		}
					
	}
	//função async para listar arquivos do dir, pode ser chamada com uma lista, neste caso só repassa para função de renderização
	//ou no contrário faz uma chamada GET para o arquivo cadastrar_arquivo.php e recebe a listagem atual.
	function getList(list) {
		if(list){
			renderList(list);
		}else{
			$.get("cadastrar_arquivo.php").done(renderList).fail(function (error){
			showFeedback("file-list", "danger", error.status + " " +error.statusText, "Erro ao buscar fotos. Tente novamente em alguns minutos");
			}); 
		}
	}
});
