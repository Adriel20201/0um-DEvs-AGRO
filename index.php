<!-- code by kzlover66 -->
<!-- a simple website made with php, javascript, css and html for a school project -->

<?php
 // Creating database for store the informations
 $db = new SQLite3('agro.db');
 $db->exec("create table if not exists novilhas (id integer primary key, quantidade integer, data text)");
 $db->exec("create table if not exists bovinos (id integer primary key, peso integer, natalidade integer, idade integer)");
 $db->exec("create table if not exists vendas (id integer primary key, compra text, venda text, valor real)");

 // checking the type of request and the request content
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['qtdNovilhas'])) {
        $stmt = $db->prepare("INSERT INTO novilhas (quantidade, data) VALUES (?, ?)");
        $stmt->bindValue(1, $_POST['qtdNovilhas'], SQLITE3_INTEGER);
        $stmt->bindValue(2, $_POST['dataNovilhas'], SQLITE3_TEXT);
        $stmt->execute();
    }
    if (isset($_POST['peso'])) {
        $stmt = $db->prepare("INSERT INTO bovinos (peso, natalidade, idade) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $_POST['peso'], SQLITE3_INTEGER);
        $stmt->bindValue(2, $_POST['natalidade'], SQLITE3_INTEGER);
        $stmt->bindValue(3, $_POST['idade'], SQLITE3_INTEGER);
        $stmt->execute();
    }
    if (isset($_POST['compra'])) {
        $stmt = $db->prepare("INSERT INTO vendas (compra, venda, valor) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $_POST['compra'], SQLITE3_TEXT);
        $stmt->bindValue(2, $_POST['venda'], SQLITE3_TEXT);
        $stmt->bindValue(3, $_POST['valorVenda'], SQLITE3_FLOAT);
        $stmt->execute();
    }
 }
?>

<!-- begin html -->
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle Agropecuário</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <div class="title">Bem vindo usuario</div>
  <div class="menu">
    <button id="themeToggle">🌙</button>
    <button onclick="showSection('novilhas')">🐄 Controle de Novilhas</button>
    <button onclick="showSection('dadosBovinos')">📊 Peso, Natalidade e Idade</button>
    <button onclick="showSection('vendas')">💲 Venda e Compra</button>
  </div>
  <form method="post">
    <div id="novilhas" class="section">
      <label>Quantidade de Novilhas:</label>
      <input type="number" name="qtdNovilhas">
      <label>Data:</label>
      <input type="date" name="dataNovilhas">
      <button type="submit">Salvar</button>
      <div class="output">
        <?php
        $res = $db->query("SELECT * FROM novilhas");
        while ($row = $res->fetchArray()) {
            echo "<p><strong>Data:</strong> {$row['data']} <br><strong>Número de novilhas:</strong> {$row['quantidade']}</p>";
        }
        ?>
      </div>
    </div>

    <div id="dadosBovinos" class="section">
      <label>Peso (kg):</label>
      <input type="number" name="peso">
      <label>Natalidade:</label>
      <input type="number" name="natalidade">
      <label>Idade (meses):</label>
      <input type="number" name="idade">
      <button type="submit">Salvar</button>
      <div class="output">
        <?php
        $res = $db->query("SELECT * FROM bovinos");
        while ($row = $res->fetchArray()) {
            echo "<p><strong>Peso:</strong> {$row['peso']}kg <br><strong>Natalidade:</strong> {$row['natalidade']} <br><strong>Idade:</strong> {$row['idade']} meses</p>";
        }
        ?>
      </div>
    </div>

    <div id="vendas" class="section">
      <label>Data de Compra:</label>
      <input type="date" name="compra">
      <label>Data de Venda:</label>
      <input type="date" name="venda">
      <label>Valor da Venda (R$):</label>
      <input type="number" name="valorVenda">
      <button type="submit">Salvar</button>
      <div class="output">
        <?php
        $res = $db->query("SELECT * FROM vendas");
        while ($row = $res->fetchArray()) {
            echo "<p><strong>Compra:</strong> {$row['compra']} <br><strong>Venda:</strong> {$row['venda']} <br><strong>Valor:</strong> R$ {$row['valor']}</p>";
        }
        ?>
      </div>
    </div>
  </form>
</div>
<script src="script.js"></script>
</body>
</html>