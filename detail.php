<?php
require_once('funcs.php');
$id = $_GET['id'];
$pdo = db_conn();
//２．データ詳細表示SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table_r1 WHERE id = :id;');
$stmt -> bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    // $error = $stmt->errorInfo();
    // exit('SQLError:' . print_r($error, true));
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}

var_dump($result);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>課題_ブックマーク2</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="update.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- <form method="POST" action="insert.php"> -->
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク</legend>
                <label>名前　　：<input type="text" name="name" id="name" value="<?= $result['name']?>"></label><br>
                <label>URL　　：<input type="text" name="URL" id="URL" value="<?= $result['URL']?>"></label><br>
                <label>コメント：<textArea name="comment" rows="4" cols="40" id="comment" value="<?= $result['comment']?>"><?= $result['comment']?></textArea></label><br>
                <label><img src ="<?=$result['image']?>" alt = 'デーコードされた画像' width='100%' height='100%'></label><br>
                <label id="img_text">登録したい画像のファイルを選択してください</label><br>
                <label><input type="file" id="imgUpload"></label><br>
                <!-- <label><input type="hidden" name="id" value="<?= $result['id']?>"></label><br> -->
                <label><input name="id" value="<?= $result['id']?>"></label><br>


                <!-- <input type="submit" value="送信"> -->
            </fieldset>
        </div>
    </form>
    <p><button id="show">登録データ表示</button></p>
    <!-- Main[End] -->


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$("#show").on("click", function(){

    let name =  $("#name").val();
    let URL = $("#URL").val();
    let comment = $("#comment").val();
    let id = $("#id").val();

    let xhr = new XMLHttpRequest();
        xhr.open('POST','update.php',true);
        xhr.responseType = 'text';//'text','json','arraybuffer','document','blob'
        let fd = new FormData();
        fd.append("id",name);

        fd.append("name",name);
        // console.log(name,'name');
        fd.append("URL",URL);

        // console.log(text_building_name,'text_building_name');
        fd.append("comment",comment);





        const reader = new FileReader(); //ファイル読み込みのためのオブジェクトのインスタンス化
        const uploadPhotoButton = document.querySelector('#imgUpload');
        let file = uploadPhotoButton.files[0];
        if(file==undefined){
            let img_src = "<?=$result['image']?>";

           fd.append("image",img_src);
            xhr.send(fd);
            window.location.href = 'update.php'; 
        }else{
        reader.readAsDataURL(file);
          reader.onload = function(){ 
           console.dir(file);        //onload 読み込みが終わったときに発火する
           
           let photo = reader.result;  //読み込んだ画像ファイルを格納
        //    let photo_01 = photo.replace("/","!");
        //    let photo_02 = photo.replace("+","-");
           let img_src = photo;
           if(img_src==undefined){
           }else{
           fd.append("image",img_src);
        }
           console.log(img_src);

        xhr.send(fd);}
    
    window.location.href = 'update.php';  }
    // console.log(file==undefined,"file");
    // window.location.href = 'select.php'; 

})
</script>
</html>
