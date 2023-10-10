<?php 
require 'connect.php';

$pdo = new PDO(DSN, USER, PASS);

if (!empty($_POST)) {
    $data = array_map('trim', $_POST);
    $data = array_map('htmlentities', $data);


    $errors = []; 

    if (!isset($data['title']) || empty($data['title'])) 
    {
        $errors['title'][] = 'Le champ titre est obligatoire';
    }
    
    if (!isset($data['content']) || empty($data['content'])) 
    {
        $errors[] = 'Le champ content est obligatoire';
    }

    if (!isset($data['author']) || empty($data['author'])) 
    {
        $errors[] = 'Le champ author est obligatoire';
    }

    if (empty($errors)) {
        $query = "INSERT INTO story (title, content, author) VALUES (:title, :content, :author)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':title', $data['title']);
        $statement->bindValue(':content', $data['content']);
        $statement->bindValue(':author', $data['author']);
        $statement->execute();
        header('Location: create.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>Votre histoire</h1>
        <form action="" method="post">
            <label for="title">
            Votre titre
            <input type="text" id="title" name="title" placeholder="Votre titre" 
            <?php echo !empty($errors['title']) ?  'aria-invalid="true"' : ' ' ?>
            >
            </label>
            <label for="content">
            Votre histoire
            <textarea type="text" id="content" name="content" placeholder="Votre histoire" 
            <?php echo !empty($errors['title']) ?  'aria-invalid="true"' : ' ' ?>
            >
            </textarea>   
            </label>
            <label for="author">
            L'auteur
            <input type="text" id="author" name="author" placeholder="L'auteur" 
            <?php echo !empty($errors['title']) ?  'aria-invalid="true"' : ' ' ?>
            >
            </label>
            <button>Ajouter votre histoire</button>
        </form>
    </main>
</body>
</html>