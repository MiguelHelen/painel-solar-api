const tabela = document.querySelector('#tabela-dados tbody');
const ctx = document.getElementById('grafico').getContext('2d');

const grafico = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Energia Gerada (W)',
            borderColor: '#FFD700',
            backgroundColor: 'rgba(255, 215, 0, 0.3)',
            data: []
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});

function atualizarDados() {
    fetch('http://localhost:3000/dados')
        .then(res => res.json())
        .then(dados => {
            tabela.innerHTML = '';
            grafico.data.labels = [];
            grafico.data.datasets[0].data = [];

            dados.slice(-20).forEach(registro => {
                tabela.innerHTML += `
                    <tr>
                        <td>${registro.horario}</td>
                        <td>${registro.radiacao}</td>
                        <td>${registro.energia} W</td>
                    </tr>
                `;
                grafico.data.labels.push(registro.horario);
                grafico.data.datasets[0].data.push(registro.energia);
            });

            grafico.update();
        })
        .catch(err => console.error(err));
}

setInterval(atualizarDados, 5000);
atualizarDados();
