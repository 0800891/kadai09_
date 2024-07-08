<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>課題_ブックマーク</title>
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
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- <form method="POST" action="insert.php"> -->
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク</legend>
                <label>名前　　：<input type="text" name="name" id="name"></label><br>
                <label>URL　　：<input type="text" name="URL" id="URL"></label><br>
                <label>コメント：<textArea name="comment" rows="4" cols="40" id="comment"></textArea></label><br>
                <label id="img_text">登録したい画像のファイルを選択してください</label><br>
            <input type="file" id="imgUpload"><br>
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

    let xhr = new XMLHttpRequest();
        xhr.open('POST','insert.php',true);
        xhr.responseType = 'text';//'text','json','arraybuffer','document','blob'
        let fd = new FormData();

        fd.append("name",name);
        // console.log(name,'name');
        fd.append("URL",URL);

        // console.log(text_building_name,'text_building_name');
        fd.append("comment",comment);





        const reader = new FileReader(); //ファイル読み込みのためのオブジェクトのインスタンス化
        const uploadPhotoButton = document.querySelector('#imgUpload');
        let file = uploadPhotoButton.files[0];
        if(file==undefined){
            window.location.href = 'select.php'; 
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
    
    window.location.href = 'select.php';  }
    // console.log(file==undefined,"file");
    // window.location.href = 'select.php'; 

})
</script>
</html>
