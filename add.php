<?php

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


    // SQL文をセット
    $stmt = $pdo->prepare('INSERT INTO products (product_id, type_, name_, price, order_date, order_status, order_user, delivery_date) VALUES(:product_id, :type_, :name_, :price, :order_date, :order_status, :order_user, :delivery_date');

    // 値をセット
    $stmt->bindValue(':product_id','' );
    $stmt->bindValue(':type_', '');
    $stmt->bindValue(':name_', '');
    $stmt->bindValue(':price', '');
    $stmt->bindValue(':order_date', 3);
    $stmt->bindValue(':order_status', '');
    $stmt->bindValue(':order_user', '');
    $stmt->bindValue(':delivery_date', '');

    // SQL実行
    $stmt->execute();

}
catch (PDOException $e) {
    // echo "error";
    echo $e->getMessage();
    exit();
}

?>

<!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title></title>
        </head>
        <body>

            <form action = "add.php" method = "get">
                <input type="text" name="product_id">
                <input type="submit" name="addBtn" value="追加">
            </form>
            </body>
    </html>
