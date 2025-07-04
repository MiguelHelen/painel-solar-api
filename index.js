const express = require('express');
const cors = require('cors');
const app = express();
const port = process.env.PORT || 3000;

let dados = [];

app.use(cors());
app.use(express.json());
app.use(express.static('public')); // Servir o site da pasta public

app.get('/dados', (req, res) => {
  res.json(dados);
});

app.post('/dados', (req, res) => {
  dados.push(req.body);
  res.sendStatus(200);
});

app.listen(port, () => {
  console.log(`Servidor rodando na porta ${port}`);
});
