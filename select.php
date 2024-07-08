<?php
require_once('funcs.php');
// クロスサイトスクリプティング対策　-> funcs.phpに格納して、他のページでも使うときは、呼び出すようにする
// function h($str) {
//   return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
// };

//1.  DB接続します
// try {
//   //ID:'root', Password: xamppは 空白 ''
//   $pdo = new PDO('mysql:dbname=gs_db_kadai07;charset=utf8;host=localhost', 'root', '');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }


$pdo = db_conn();
//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table_r1");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  // $error = $stmt->errorInfo();
  // exit("ErrorQuery:".$error[2]);
    sql_error($stmt);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr>";
    // $view .= h($result['id']) . h($result['date']) . ' ' . h($result['name']) . ' ' . h($result['URL']) . ' ' . h($result['comment']);
    $view .= '<td><a href = "detail.php?id=' . h($result['id']) .'">';
    $view .= h($result['id']) . '</a></td>' ;
    $view .= '<td><a href = "detail.php?id=' . h($result['id']) .'">' . h($result['name']) .  '</td>' ;
    $view .= '<td><img src =' . h($result['image']) . 'alt = "デーコードされた画像" width="40%" height="40%"></td>' ;
    $view .= '<td>' . h($result['comment']) .  '</td>' ;
    $view .= '<td width="10px">' . h($result['URL']) .  '</td>' ;
    $view .= '<td>' . h($result['date']) .  '</td>' ;
    $view .= '<td><a href = delete.php?id=' . h($result['id']) .  '>delete</a></td>' ;
    $view .= "</tr>";
  }
  

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<p><button id="back">登録画面に戻る</button></p>
<div>

  <table width="80%" border = "1" style = "border-collapse: collapse">
    <tr>
      <td>id</td>
      <td>name</td>
      <td>image</td>
      <td>comment</td>
      <td>URL</td>
      <td>Date</td>
      <td><a href = resetid.php?>id_Reset</a></td>
    </tr>
    <div class="container jumbotron">
      <a href="detail.php"></a>
      <?= $view ?>
    </div>
</div>
<!-- Main[End] -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="js/jquery-2.1.3.min.js"></script> -->
<script>
$("#back").on("click", function(){
   
    window.location.href = 'index.php';  

})
</script>
</html>