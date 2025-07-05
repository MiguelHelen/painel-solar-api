

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
      montarGraficoEnergia(dados);
      montarGraficoDiario(dados);
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
    const dataLocal = converterParaHorarioLocal(item.data);
    corpoTabela.innerHTML += `<tr>
      <td>${dataLocal}</td>
      <td>${item.radiacao}</td>
      <td>${item.energia.toFixed(2)} W</td>
    </tr>`;
  });
}

function montarGraficoEnergia(dados) {
  const ctx = document.getElementById('graficoEnergia').getContext('2d');
  if (graficoEnergia) graficoEnergia.destroy();

  const ultimos = dados.slice(-10);
  graficoEnergia = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ultimos.map(d => converterParaHorarioLocal(d.data).split(" ")[1]),
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
      scales: { y: { beginAtZero: true } }
    }
  });
}

function converterParaHorarioLocal(dataUTC) {
  const dataObj = new Date(dataUTC + " UTC");
  return dataObj.toLocaleString("pt-BR", { timeZone: "America/Sao_Paulo" });
}


let graficoEnergia;
function montarGraficoEnergia(dados) {
  const ctx = document.getElementById('graficoEnergia').getContext('2d');
  if (graficoEnergia) graficoEnergia.destroy();

  const ultimos = dados.slice(-10);
  graficoEnergia = new Chart(ctx, {
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
      scales: { y: { beginAtZero: true } }
    }
  });
}

let graficoMensal;
function montarGraficoDiario(dados) {
  const ctx = document.getElementById('graficoMensal').getContext('2d');
  if (graficoMensal) graficoMensal.destroy();

  // Agrupando produção total por dia
  const producaoPorDia = {};

  dados.forEach(item => {
    const dia = item.data.split(" ")[0];
    if (!producaoPorDia[dia]) {
      producaoPorDia[dia] = 0;
    }
    producaoPorDia[dia] += item.energia;
  });

  const dias = Object.keys(producaoPorDia);
  const producoes = dias.map(dia => producaoPorDia[dia].toFixed(2));

  graficoMensal = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: dias,
      datasets: [{
        label: 'Produção Total por Dia (W)',
        data: producoes,
        backgroundColor: '#0077b6'
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } }
    }
  });
}

setInterval(buscarDados, 5000);
buscarDados();
