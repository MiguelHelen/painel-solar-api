const express = require('express');
const mysql = require('mysql2');
const app = express();
app.use(express.json());

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'sua_senha',
  database: 'painel_solar'
});

app.post('/api/dados', (req, res) => {
  const { nome, valor } = req.body;
  db.query(
    'INSERT INTO dados_api (nome, valor) VALUES (?, ?)',
    [nome, valor],
    (err, results) => {
      if (err) return res.status(500).json({ error: err });
      res.json({ success: true, id: results.insertId });
    }
  );
});

app.listen(3001, () => console.log('Node.js rodando na porta 3001'));