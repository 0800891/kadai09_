<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>サインアップ</title>
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
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="signup.php">サインアップ</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="insert_signup.php">
        <div class="jumbotron">
            <fieldset>
                <legend>サインアップ</legend>
                <label>お名前：<input type="text"  name="name"></label><br>
                <label>ID：<input type="text" name="lid"></label><br>
                <label>パスワード：<input type="text" name="lpw"></label><br>
                <input type="submit" value="登録">
            </fieldset>
        </div>
    </form>
    <p><button id="send">戻る</button></p>
    <!-- Main[End] -->


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$("#send").on("click", function(){

    window.location.href = 'index.php';  }
    // console.log(file==undefined,"file");
    // window.location.href = 'select.php'; 

)
</script>
</html>
