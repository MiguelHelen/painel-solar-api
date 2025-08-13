const express = require('express');
const cors = require('cors');
const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());
app.use(cors());
app.use(express.static(__dirname)); 

let dados = [];

app.post('/dados', async (req, res) => {
    const { radiacao, energia } = req.body;
    if (!radiacao || !energia) {
        return res.status(400).json({ erro: 'Campos obrigatórios!' });
    }
    const registro = {
        radiacao,
        energia,
        data: new Date().toLocaleString('pt-BR')
    };
    dados.push(registro);
    console.log("Recebido:", registro);

    // Enviar para o backend que salva no banco
    try {
        const response = await fetch('http://localhost:3001/api/dados', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nome: 'radiacao', valor: radiacao })
        });
        const response2 = await fetch('http://localhost:3001/api/dados', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nome: 'energia', valor: energia })
        });
        if (!response.ok || !response2.ok) throw new Error('Erro ao salvar no banco');
        res.status(201).json({ mensagem: 'Dado salvo com sucesso!' });
    } catch (err) {
        res.status(500).json({ erro: 'Falha ao salvar no banco', detalhes: err.message });
    }
});

app.get('/dados', (req, res) => {
    res.json(dados);
});

app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
