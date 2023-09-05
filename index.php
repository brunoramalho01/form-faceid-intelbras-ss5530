
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
  <link rel="shortcut icon" href="favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.1.2/build/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    .banner {
      text-align: center;
      margin-bottom: 30px;
    }
    .banner img {
      max-width: 100%;
      height: auto;
    }
    .form-container {
      padding: 20px;
      margin-top: 250px; /* Espaçamento entre banner e formulário */
    }
    .form-label {
      font-weight: bold;
    }

    /* Estilos específicos para telas pequenas (celular) */
    @media (max-width: 767.98px) {
      .form-container {
        margin-top: 100px; /* Ajuste o espaçamento conforme necessário */
      }
    }
  </style>
</head>
<body>
  <div class="banner fixed-top">
    <img src="banner-image.png" alt="Banner" class="img-fluid">
  </div>
  <div class="container form-container">
    <!--<h1 class="form-title">Cadastro Face ID</h1>-->
    <form id="formulario" action="criar_usuario.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
          </div>
		  
		  <div class="mb-3">
			<label for="foto" class="form-label">Foto:</label>
			<input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
			<small class="form-text text-muted">Escolha uma foto para fazer upload.</small>
		  </div>
		  
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="data" class="form-label">Data:</label>
              <input type="date" name="data" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
              <label for="e_mail" class="form-label">E-mail:</label>
              <input type="email" class="form-control" name="e_mail">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cpf" class="form-label">CPF:</label>
              <input type="text" class="form-control" name="cpf">
            </div>
            <div class="col-md-6 mb-3">
              <label for="relefone_celular" class="form-label">Contato:</label>
              <input type="text" class="form-control" name="telefone_celular">
            </div>
          </div>

          <div class="mb-3">
        <label class="form-label">Selecione as palestras:</label>
        <!-- Checkbox para cada palestra -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="palestra1" id="palestra1" name="palestras[]">
          <label class="form-check-label" for="palestra1">
            Dia 05/09/2023 no Auditório Sesclin - Unidade de Saúde.
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="palestra2" id="palestra2" name="palestras[]">
          <label class="form-check-label" for="palestra2">
            Dia 06/09/2023 no Auditório Tepequém na Sede Administrativa do SESC e SENAC/RR
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="palestra3" id="palestra3" name="palestras[]">
          <label class="form-check-label" for="palestra3">
            Dia 08/09/2023 no Auditório Tepequém na Sede Administrativa do SENAC/RR
          </label>
        </div>    
      </div>
		
      <button type="submit" class="btn btn-primary">Enviar</button>
      
    </form>
  </div>

 <script>
    document.getElementById('formulario').addEventListener('submit', function(event) {
        event.preventDefault();

        const nome = document.getElementById('nome').value;
        const foto = document.getElementById('foto').files[0];

        const formData = new FormData();
        formData.append('nome', nome);
        formData.append('foto', foto);

        fetch('criar_usuario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Exibir alerta de sucesso
            exibirAlerta('Cadastro realizado com sucesso!');
            // Limpar o formulário após o envio dos dados
            document.getElementById('formulario').reset();
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });

    function exibirAlerta(mensagem) {
        window.alert(mensagem);
    }
</script>

</div>
  <!-- Script para passar os valores e paramentros após dar o Submit no Formulario myForm -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.1.2/build/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js"></script>
</body>
</html>
