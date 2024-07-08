
<?php
require_once('funcs.php');
try {

    // $user = "root";
    // $password = "";
    $db_id   = 'michey';
    // $db_pw   = ''; //パスワード：MAMPは'root'
    $db_pw   = 'Sss560906';
    // $db_host = 'localhost'; //DBホスト
    $db_host = 'mysql648.db.sakura.ne.jp';

    $db_name = 'michey_kadai08';

    $dbh = new PDO("mysql:host=". $db_host. "; dbname=" . $db_name . "; charset=utf8", $db_id, $db_pw);
    // $dbh = db_conn();

    $stmt = $dbh->prepare('DELETE FROM gs_bm_table_r1 WHERE id = :id');

    $stmt->execute(array(':id' => $_GET["id"]));

    echo "削除しました。";

} catch (Exception $e) {
    $text = 'エラーが発生しました。:' . "\n" . $e->getMessage();
          echo $text;
}

try {
    // PDOを使った接続
    $conn = new PDO("mysql:host=". $db_host. "; dbname=" . $db_name . "; charset=utf8", $db_id, $db_pw);
    // $conn = db_conn();
    // エラーモードを例外に設定
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // テーブル名を指定
    $table_name = "gs_bm_table_r1";

    // SQL命令文
    // $sql = "ALTER TABLE `$table_name` AUTO_INCREMENT = 1";

    $sql_1 = "SET @n:= 0";
    $sql_2 = "UPDATE `$table_name` set id=@n:= @n+1";

    // SQL命令文の実行
    $conn->exec($sql_1);
    $conn->exec($sql_2);
    echo "AUTO_INCREMENT value reset successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>削除完了</title>
  </head>
  <body>          
  <p>
      <a href="select.php">投稿一覧へ</a>
  </p> 
  </body>
</html>