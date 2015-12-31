<?php
$user = "sa";
$pass = "jtakaha4";
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
try {
    $dbh = new PDO('sqlsrv:server=.\sqlexpress;database=db1', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO recipes (recipe_name, category, difficulty, budget, howto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindvalue(2, $category,  PDO::PARAM_INT);
    $stmt->bindvalue(3, $difficulty,  PDO::PARAM_INT);
    $stmt->bindvalue(4, $budget, PDO::PARAM_INT);
    $stmt->bindvalue(5, $howto,  PDO::PARAM_STR);
    $stmt = execute();
    $dbh = null;
    echo "レシピの登録が完了しました。";
}
catch (PDOException $e){
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>