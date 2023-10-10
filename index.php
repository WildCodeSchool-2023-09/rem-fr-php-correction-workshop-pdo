<?php 
require 'connect.php';
$pdo = new PDO(DSN, USER, PASS);

$statement = $pdo->query("SELECT * FROM story");
$stories = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes histoires</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
    <main class="container">
        <section class="grid">
            <?php foreach($stories as $story): ?>
              <article>
                <header>
                    <?= $story['title'] ?>
                </header>
                    <?= $story['content'] ?>
                <footer>
                    <?= $story['author'] ?>
                </footer>    
              </article>  
            <?php endforeach; ?>  
        </section>
    </main>
</body>
</html>