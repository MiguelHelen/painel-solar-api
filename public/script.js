const apiUrl = "https://painel-solar-api.onrender.com/dados";
let producaoTotal = 0;
const metaDiaria = 5000;

async function buscarDados() {
  try {
    const resposta = await fetch(apiUrl);
    const dados = await resposta.json();

    if (dados.length > 0) {
      const ultimo = dados[dados.length - 1];
      document.getElementById('radiacao').textContent = ultimo.radiacao;
      document.getElementById('energia').textContent = ultimo.energia.toFixed(2) + " W";

      producaoTotal = dados.reduce((acc, item) => acc + item.energia, 0);
      atualizarProducao();
      montarTabela(dados);
      montarGrafico(dados);
    }
  } catch (erro) {
    console.error("Erro ao buscar dados:", erro);
  }
}

function atualizarProducao() {
  const porcentagem = Math.min((producaoTotal / metaDiaria) * 100, 100);
  document.getElementById('producaoDia').textContent = `${producaoTotal.toFixed(2)} / ${metaDiaria} W`;
  document.getElementById('barraProgresso').style.width = `${porcentagem}%`;
}

function montarTabela(dados) {
  const corpoTabela = document.getElementById('tabelaDados');
  corpoTabela.innerHTML = "";

  dados.slice(-10).reverse().forEach(item => {
    corpoTabela.innerHTML += `<tr>
      <td>${item.data}</td>
      <td>${item.radiacao}</td>
      <td>${item.energia.toFixed(2)} W</td>
    </tr>`;
  });
}

let grafico;
function montarGrafico(dados) {
  const ctx = document.getElementById('graficoEnergia').getContext('2d');
  if (grafico) grafico.destroy();

  const ultimos = dados.slice(-10);
  grafico = new Chart(ctx, {
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
