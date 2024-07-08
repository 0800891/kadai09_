<?php
require_once('funcs.php');

// //1. POSTデータ取得
if(isset($_POST['name'])){
    $name = $_POST['name'];
    echo $name ;
    }
    if(isset($_POST['URL'])){
    $URL = $_POST['URL'];
    }
    if(isset($_POST['comment'])){
    $comment = $_POST['comment'];
    }
    if(isset($_POST['image'])){
    $image = $_POST['image'];
    }
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        }
// if(isset($_GET['name'])){
//     $name = $_GET['name'];
//     echo $name ;
//     }
//     if(isset($_GET['URL'])){
//     $URL = $_GET['URL'];
//     }
//     if(isset($_GET['comment'])){
//     $comment = $_GET['comment'];
//     }
//     if(isset($_GET['image'])){
//     $image = $_GET['image'];
//     }
//     if(isset($_GET['id'])){
//         $id = $_GET['id'];
//         }

    //2. DB接続します
    // try {
    //     //ID:'root', Password: xamppは 空白 ''
    //     $pdo = new PDO('mysql:dbname=gs_db_kadai07;charset=utf8;host=localhost', 'root', '');
    // } catch (PDOException $e) {
    //     exit('DBConnectError:'.$e->getMessage());
    // }
    $pdo = db_conn();
    
    //３．データ登録SQL作成
    $stmt = $pdo->prepare('UPDATE
                                gs_bm_table_r1
                            SET  
                                name = :name,
                                URL = :URL, 
                                comment= :comment,
                                image= :image,
                                date = now()
                            WHERE 
                                id = :id; 
                            ');
    
    //  2. バインド変数を用意
    // Integer 数値の場合 PDO::PARAM_INT
    // String文字列の場合 PDO::PARAM_STR
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':URL', $URL, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
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
      header('Location: select.php');
      exit();
    
    }
    ?>