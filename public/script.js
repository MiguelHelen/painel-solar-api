const apiUrl = "https://painel-solar-api.onrender.com/dados"; 

async function buscarDados() {
    try {
        const resposta = await fetch(apiUrl);
        const dados = await resposta.json();

        if (dados.length > 0) {
            const ultimo = dados[dados.length - 1];
            document.getElementById('radiacao').textContent = ultimo.radiacao;
            document.getElementById('energia').textContent = ultimo.energia.toFixed(2) + " W";

            montarTabela(dados);
            montarGrafico(dados);
        }
    } catch (erro) {
        console.error("Erro ao buscar dados:", erro);
    }
}

function montarTabela(dados) {
    const corpoTabela = document.getElementById('tabelaDados');
    corpoTabela.innerHTML = "";

    dados.slice(-10).reverse().forEach(item => {
        const linha = `<tr>
            <td>${item.data}</td>
            <td>${item.radiacao}</td>
            <td>${item.energia.toFixed(2)} W</td>
        </tr>`;
        corpoTabela.innerHTML += linha;
    });
}

function montarGrafico(dados) {
    const ctx = document.getElementById('graficoEnergia').getContext('2d');
    const ultimos = dados.slice(-10);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ultimos.map(d => d.data.split(" ")[1]),
            datasets: [{
                label: 'Energia (W)',
                data: ultimos.map(d => d.energia),
                borderColor: '#0077b6',
                backgroundColor: 'rgba(0,119,182,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

setInterval(buscarDados, 5000);
buscarDados();
