function enviarDadosPainelSolar(dados) {
    fetch('../php/get_dados.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    })
    .then(response => response.json())
    .then(resultado => {
        console.log('Resposta do PHP:', resultado);
        // Aqui você pode atualizar a interface ou mostrar mensagem ao usuário
    })
    .catch(error => {
        console.error('Erro ao enviar dados:', error);
    });
}

// Exemplo de uso:
const dadosPainel = {
    nome: 'Painel 1',
    energia_gerada: 123.45,
    irradiancia: 800,
    temperatura: 35.2
};
enviarDadosPainelSolar(dadosPainel);