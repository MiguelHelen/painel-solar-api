const express = require('express');
const cors = require('cors');
const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());
app.use(cors());
app.use(express.static(__dirname)); 

let dados = [];

app.post('/dados', (req, res) => {
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
    res.status(201).json({ mensagem: 'Dado salvo com sucesso!' });
});

app.get('/dados', (req, res) => {
    res.json(dados);
});

app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
