const apiUrl = "https://painel-solar-api.onrender.com/dados";
const metaDiaria = 5000;
let producaoTotal = 0;
let graficoEnergia;
let graficoMensal;
let graficoPorDia;

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
      montarGraficoMensal(dados);
      montarGraficoPorDia(dados);
    }
  } catch (erro) {
    console.error("Erro ao buscar dados:", erro);
    document.getElementById('radiacao').textContent = "Erro na API";
    document.getElementById('energia').textContent = "Erro na API";
  }
}

function atualizarProducao() {
  const porcentagem = Math.min((producaoTotal / metaDiaria) * 100, 100);
  document.getElementById('producaoDia').textContent = `${producaoTotal.toFixed(2)} / ${metaDiaria} W`;
  document.getElementById('barraProgresso').style.width = `${porcentagem}%`;
}

function montarTabela(dados) {
  window.ultimoDados = dados;

  const corpoTabela = document.getElementById('tabelaDados');
  corpoTabela.innerHTML = "";

  dados.slice(-10).reverse().forEach(item => {
    const dataLocal = converterParaHorarioLocal(item.data);
    corpoTabela.innerHTML += `
      <tr>
        <td>${dataLocal}</td>
        <td>${item.radiacao}</td>
        <td>${item.energia.toFixed(2)} W</td>
      </tr>
    `;
  });

  adicionarEventosLinhas();
}

function montarGraficoEnergia(dados) {
  const ctx = document.getElementById('graficoEnergia').getContext('2d');
  if (graficoEnergia) graficoEnergia.destroy();

  const ultimos = dados.slice(-10);
  graficoEnergia = new Chart(ctx, {
    type: 'line',
    data: {
      // Usar uma função de callback para garantir que a data seja formatada corretamente
      labels: ultimos.map(d => {
        const dataObj = parseDataStringToUTC(d.data); // Cria a data em UTC
        if (isNaN(dataObj.getTime())) return "N/A";
        // Converte para São Paulo para pegar a hora local
        return dataObj.toLocaleString("pt-BR", { timeZone: "America/Sao_Paulo", hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
      }),
      datasets: [{
        label: 'Energia (W)',
        data: ultimos.map(d => d.energia),
        borderColor: '#0077b6',
        backgroundColor: 'rgba(0,119,182,0.1)',
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } }
    }
  });
}

function montarGraficoMensal(dados) {
  const ctx = document.getElementById('graficoMensal').getContext('2d');
  if (graficoMensal) graficoMensal.destroy();

  const meses = [
    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto"
  ];

  const valoresFixos = [48000, 47000, 50000, 51000, 53000, 52000, 50000];

  const producaoAgosto = dados
    .filter(d => {
      const dataObj = parseDataStringToUTC(d.data); // Cria a data em UTC
      if (isNaN(dataObj.getTime())) return false;
      const mesLocal = dataObj.toLocaleString("pt-BR", { timeZone: "America/Sao_Paulo" })
                               .split("/")[1];
      return mesLocal === "07";
    })
    .reduce((acc, d) => acc + d.energia, 0);

  const dadosFinais = [...valoresFixos, producaoAgosto];

  graficoMensal = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: meses,
      datasets: [{
        label: 'Energia Total (W)',
        data: dadosFinais,
        backgroundColor: meses.map((_, i) =>
          i === 6 ? '#0077b6' : '#90e0ef'
        )
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              if (value >= 1000) return value / 1000 + '.000';
              return value;
            }
          }
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.parsed.y.toFixed(2) + ' W';
            }
          }
        }
      }
    }
  });
}

function montarGraficoPorDia(dados) {
  const ctx = document.getElementById('graficoPorDia').getContext('2d');
  if (graficoPorDia) graficoPorDia.destroy();

  const energiaPorDia = {};

  dados.forEach(dado => {
    const dataObj = parseDataStringToUTC(dado.data); // Cria a data em UTC
    if (isNaN(dataObj.getTime())) return;

    const dataLocal = dataObj.toLocaleDateString("pt-BR", {
      timeZone: "America/Sao_Paulo"
    });

    if (!energiaPorDia[dataLocal]) {
      energiaPorDia[dataLocal] = 0;
    }
    energiaPorDia[dataLocal] += dado.energia;
  });

  const dias = Object.keys(energiaPorDia);
  const energias = Object.values(energiaPorDia);

  graficoPorDia = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: dias,
      datasets: [{
        label: 'Energia Total por Dia (W)',
        data: energias,
        backgroundColor: '#00b4d8'
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: value => (value >= 1000 ? value / 1000 + '00' : value)
          }
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: ctx => ctx.parsed.y.toFixed(2) + " W"
          }
        }
      }
    }
  });
}

/**
 * Converte a string de data no formato "DD/MM/YYYY, HH:mm:ss"
 * para um objeto Date interpretado como horário dos EUA (fuso horário da API).
 * Em seguida, formata para o fuso horário de São Paulo para exibição.
 * @param {string} dateString A string de data da API.
 * @returns {string} A data e hora formatada localmente ou uma string de erro.
 */
function converterParaHorarioLocal(dateString) {
  const dataObj = parseDataStringToUTC(dateString); // A data é criada como UTC
  if (isNaN(dataObj.getTime())) {
    console.warn("Data inválida recebida:", dateString);
    return "Data Inválida";
  }
  // Agora converte para o fuso horário de São Paulo
  return dataObj.toLocaleString("pt-BR", {
    timeZone: "America/Sao_Paulo",
    hour12: false // Formato 24 horas
  });
}

/**
 * Função auxiliar para parsear a string de data "DD/MM/YYYY, HH:mm:ss"
 * e criar um objeto Date em UTC.
 * @param {string} dateString A string de data no formato "DD/MM/YYYY, HH:mm:ss".
 * @returns {Date} Um objeto Date interpretado como UTC.
 */
function parseDataStringToUTC(dateString) {
  const parts = dateString.match(/(\d{2})\/(\d{2})\/(\d{4}), (\d{2}):(\d{2}):(\d{2})/);
  if (!parts) {
    return new Date('Invalid Date');
  }
  const day = parseInt(parts[1], 10);
  const month = parseInt(parts[2], 10) - 1; // Mês é zero-indexed no JS (0-11)
  const year = parseInt(parts[3], 10);
  const hour = parseInt(parts[4], 10);
  const minute = parseInt(parts[5], 10);
  const second = parseInt(parts[6], 10);

  // CRÍTICO: Criar a data usando Date.UTC()
  // Isso cria um objeto Date que representa o momento em UTC,
  // sem aplicar o offset local do navegador.
  const utcMilliseconds = Date.UTC(year, month, day, hour, minute, second);
  return new Date(utcMilliseconds);
}

setInterval(buscarDados, 5000);
buscarDados();

// Dados fictícios para setor, parte do mapa e imagem (sem alterações)
const setores = ["Setor A", "Setor B", "Setor C", "Setor D"];
const partesMapa = ["Área Norte", "Área Sul", "Área Leste", "Área Oeste"];
const imagens = [
  "https://via.placeholder.com/320x180?text=Foto+1",
  "https://via.placeholder.com/320x180?text=Foto+2",
  "https://via.placeholder.com/320x180?text=Foto+3",
  "https://via.placeholder.com/320x180?text=Foto+4"
];

function adicionarEventosLinhas() {
  const linhas = document.querySelectorAll("#tabelaDados tr");
  linhas.forEach((linha, i) => {
    linha.style.cursor = "pointer";
    linha.onclick = () => abrirModalDetalhes(i);
  });
}

function abrirModalDetalhes(index) {
  const dados = window.ultimoDados || [];
  const dadosOrdenados = dados.slice(-10).reverse();
  const dado = dadosOrdenados[index];

  if (!dado) return;

  const dataObj = parseDataStringToUTC(dado.data); // Usa a nova função
  if (isNaN(dataObj.getTime())) {
    document.getElementById("modalDataHora").textContent = "Data Inválida";
  } else {
    document.getElementById("modalDataHora").textContent = dataObj.toLocaleString("pt-BR", {
      timeZone: "America/Sao_Paulo",
      hour12: false
    });
  }

  document.getElementById("modalRadiacao").textContent = dado.radiacao;
  document.getElementById("modalEnergia").textContent = dado.energia.toFixed(2);

  const setor = setores[index % setores.length];
  const parteMapa = partesMapa[index % partesMapa.length];
  const imagem = imagens[index % imagens.length];

  document.getElementById("modalSetor").textContent = setor;
  document.getElementById("modalParteMapa").textContent = parteMapa;
  document.getElementById("modalImagem").src = imagem;

  document.getElementById("modalRelatorio").style.display = "block";
}

document.getElementById("fecharModal").onclick = () => {
  document.getElementById("modalRelatorio").style.display = "none";
};

window.onclick = (e) => {
  if (e.target.id === "modalRelatorio") {
    document.getElementById("modalRelatorio").style.display = "none";
  }
};

document.getElementById('baixarTxt').addEventListener('click', () => {
    window.open("https://painel-solar-api.onrender.com/download", '_blank');
});
