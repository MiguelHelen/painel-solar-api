const express = require('express');
const cors = require('cors');
const db = require('./db'); // importa o arquivo do banco
const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());
app.use(cors());
app.use(express.static(__dirname));

const fs = require('fs');

app.post('/dados', (req, res) => {
    const { radiacao, energia } = req.body;

    if (!radiacao || !energia) {
        return res.status(400).json({ erro: 'Campos obrigatórios!' });
    }

    const data = new Date().toISOString().slice(0, 19).replace('T', ' '); // Formato MySQL DATETIME
    const sql = 'INSERT INTO dados (radiacao, energia, data) VALUES (?, ?, ?)';

    db.query(sql, [radiacao, energia, data], (err, results) => {
        if (err) {
            console.error(err.message);
            return res.status(500).json({ erro: 'Erro ao salvar no banco de dados' });
        }

        // Grava no TXT
        const linha = `Data: ${data} | Radiação: ${radiacao} | Energia: ${energia} W\n`;
        fs.appendFile('dados_registrados.txt', linha, (erroEscrita) => {
            if (erroEscrita) {
                console.error("Erro ao salvar no arquivo:", erroEscrita.message);
                return res.status(500).json({ erro: 'Erro ao salvar no arquivo .txt' });
            }

            res.status(201).json({ mensagem: 'Dado salvo no banco e no arquivo!' });
        });
    });
});


// Rota GET para pegar os dados do banco
app.get('/dados', (req, res) => {
    const sql = 'SELECT * FROM dados ORDER BY id DESC LIMIT 100';

    db.query(sql, (err, results) => {
        if (err) {
            console.error(err.message);
            return res.status(500).json({ erro: 'Erro ao buscar os dados' });
        }

        res.json(results);
    });
});


app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
