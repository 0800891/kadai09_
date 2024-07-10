<?php
// session_start();
require_once('funcs.php');
/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
// if(isset($_POST['name'])){
$name = $_POST['name'];
// echo $name ;
// }
// if(isset($_POST['lid'])){
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
// }

$kanri_flg = 0;
$life_flg = 0;
//2. DB接続します
// try {
//     //ID:'root', Password: xamppは 空白 ''
//     $pdo = new PDO('mysql:dbname=gs_db_kadai07;charset=utf8;host=localhost', 'root', '');
// } catch (PDOException $e) {
//     exit('DBConnectError:'.$e->getMessage());
// }
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO
                gs_user_table(name, lid, lpw, kanri_flg,life_flg)
                VALUES(:name, :lid, :lpw, :kanri_flg, :life_flg) ');

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    // $error = $stmt->errorInfo();
    // exit('ErrorMessage:'.$error[2]);
    sql_error($stmt);
} else {
    //５．index.phpへリダイレクト
  // header('Location: index.php');
  redirect('index.php');

}
?>