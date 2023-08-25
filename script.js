document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const foto = document.getElementById('foto').files[0];

    const formData = new FormData();
    formData.append('nome', nome);
    formData.append('foto', foto);

    fetch('save_csv.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        // Exibir alerta de sucesso
        exibirAlerta('Cadastro realizado com sucesso!');
        // Limpar o formulário após o envio dos dados
        document.getElementById('myForm').reset();
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});

function exibirAlerta(mensagem) {
    window.alert(mensagem);
}