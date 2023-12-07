function confirmacao() {
    var resposta = confirm("Deseja fazer um novo requerimento?");
    if (resposta) {
        // Usuário escolheu "Sim"
        window.location.href = window.location.href; 
    } else {
        // Usuário escolheu "Não"
        window.location.href = 'pagina-inicial.php'; 
    }
}
function buscarEndereco() {
    var cep = document.getElementById('cep').value;
    var url = 'https://viacep.com.br/ws/' + cep + '/json/';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (!data.erro) {
                document.getElementById('end').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('uf').value = data.uf;
            } else {
                alert('CEP não encontrado.');
            }
        })
        .catch(error => console.error('Erro:', error));
}
function openFileExplorer() {
    // Referencie o campo de entrada de arquivo e simule um clique
    var fileInput = document.getElementById('fileInput');
    fileInput.click();
}   