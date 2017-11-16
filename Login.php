<!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="UTF-8">
  <title>掲示板</title>
  </head>
  <body>
    <h1>ログイン画面</h1>
    <section>
        ログインIDとパスワードを入力してください
        <form action="ConfirmLog" method="post">
          ID: <br>
          <input type="text" name="id" value=""><br>
          パスワード:<br>
          <input type="text" name="password" value=""><br>
          <input type="submit" value="ログイン">
        </form>
    </section>
  </body>
</html>