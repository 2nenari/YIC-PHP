<?php
    $user_id = $_GET["user_id"];
    $pass = $_GET["pass"];
    $start = $_GET["start"];
    $next = $_GET["next"];


try {

    // データベースに接続
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:host=localhost;dbname=order;charset=utf8;',
        // ユーザー名
        'root',
        // パスワード
        '',
        // レコード列名をキーとして取得させる
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );

    // ログイン

    $query = 'SELECT * FROM users WHERE user_id = :user_ID AND password = :pass';
//    $query = 'SELECT * FROM users';
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(':user_ID', $user_id);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();

    $result = $stmt->fetchAll();
    if(empty($result)){

        require_once 'login.html';
    }
    else{
        $user_name = $result[0]["name"];
        // ５件検索
        $query2 = "SELECT * FROM products order by product_id limit :begin, :next";

        // echo $start;
        // echo $next;
        $stmt2 = $pdo -> prepare($query2);
        $stmt2 -> bindParam(':begin', $start, PDO::PARAM_INT);
        $stmt2 -> bindParam(':next', $next, PDO::PARAM_INT);
        $stmt2 -> execute();
        $products = $stmt2 -> fetchAll();
        require_once 'success_login_tpl.php';
    }
}
catch (PDOException $e) {
    // echo "error";
    echo $e->getMessage();
    exit();
}


// // SQL文をセット
// $stmt = $pdo->prepare('SELECT * FROM users');
 
// // SQL文を実行
// $stmt->execute();
 

// // ループして1レコードずつ取得
// foreach ($stmt as $row) {

//     //全て表示
//     //var_dump($row);
//     echo $row['user_id'];
//     echo ", ";
//     echo $row['name'];
//     echo ", ";
//     echo $row['password'];
//     echo ", ";
//     echo $row['permission'];
//     echo '<BR>';

// }

?>

