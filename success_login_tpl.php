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

        $start = 0;
        $next = 5;

        $query3 = "SELECT product_id, type.name as type_name, products.name as product_name, price, order_date, status, order_user, delivery_date 
                    FROM products
                        INNER JOIN type on products.type = type.type_id
                        INNER JOIN status on products.order_status = status.status_id
                    ORDER BY product_id 
                    LIMIT $start,$next ";

        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute();
        $products = $stmt3 -> fetchAll();
        
        if (isset($_GET["behindBtn"])) {
            $start -= 5;
            $next -= 5;
            if ($start < 0) {
                $start = 0;
            }
            if ($next <= 0) {
                $next = 5;
            }

            // デバッグ
            // echo $start;
            // echo $next;
            
            $query3 = "SELECT product_id, type.name as type_name, products.name as product_name, price, order_date, status, order_user, delivery_date 
                        FROM products
                            INNER JOIN type on products.type = type.type_id
                            INNER JOIN status on products.order_status = status.status_id
                        ORDER BY product_id 
                        LIMIT $start,$next ";

            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute();
            $products = $stmt3 -> fetchAll();
            
        }
        if (isset($_GET["nextBtn"])) {
            $start += 5;
            $next += 5;

            // デバッグ
            // echo $start;
            // echo $next;
            
            $query3 = "SELECT product_id, type.name as type_name, products.name as product_name, price, order_date, status, order_user, delivery_date 
                        FROM products
                            INNER JOIN type on products.type = type.type_id
                            INNER JOIN status on products.order_status = status.status_id
                        ORDER BY product_id 
                        LIMIT $start,$next ";

            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute();
            $products = $stmt3 -> fetchAll();
        }
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
            <!-- <p>ようこそ<?php echo $user_name; ?>さん</p> -->
            <?php
                foreach ($products as $product){
                    echo $product['product_id'], ' ';
                    echo $product['type_name'], ' ';
                    echo $product['product_name'], ' ';
                    echo $product['price'], ' ';
                    echo $product['order_date'], ' ';
                    echo $product['status'], ' ';
                    echo $product['order_user'], ' ';
                    echo $product['delivery_date'], '<br>';
                    }
            ?>

                <form action = "success_login_tpl.php" method = "get">
                    <input type="submit" name="behindBtn" value="前へ">
                    <input type="submit" name="nextBtn" value="次へ">
                </form>

                <form action = "./add.php">
                    <button class = "btn">新規</button>
                    <button class = "btn">変更</button>
                </form>
            </body>
        </html>

<?php
/*
try{    
    $db = new PDO(
    // ホスト名、データベース名
    'mysql:host=localhost;dbname=order;charset=utf8;',
    // ユーザー名
    'root',
    // パスワード
    ''
);
}
catch(PDOException $e){
    echo"DB接続エラー";
}


if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
}
else{
    $page = 1;
}

if ($page > 1){
    $start = ($page * 5) - 5;
}
else{
    $start = 0;
}


$query = 'SELECT * FROM products LIMIT 0, 5';
$products = $db->prepare("$query");

$products->execute();
$products = $products->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product){
    echo $product['product_id'], ' ';
    echo $product['type'], ' ';
    echo $product['name'], ' ';
    echo $product['price'], ' ';
    echo $product['order_date'], ' ';
    echo $product['order_status'], ' ';
    echo $product['order_user'], ' ';
    echo $product['delivery_date'], '<br>';
}

$products_num = $db->prepare("SELECT COUNT(*) FROM products");
$products_num -> execute();
$products_num = $products_num -> fetchColumn();

$pagination = ceil($products_num / 5);
*/
?>


