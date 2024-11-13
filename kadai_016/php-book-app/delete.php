<?php
 $dsn = 'mysql://qa17pxb0fc5tfcsi:evq6sdewaz08s4p6@q0h7yf5pynynaq54.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/oaw4z00z8kvgfvp8';
 $user = 'qa17pxb0fc5tfcsi';
// MAMPを利用しているMacユーザーの方は、''ではなく'root'を代入してください
 $password = 'evq6sdewaz08s4p6';
 
 try {
     $pdo = new PDO($dsn, $user, $password);
 
     // idカラムの値をプレースホルダ（:id）に置き換えたSQL文をあらかじめ用意する
     $sql_delete = 'DELETE FROM products WHERE id = :id';
     $stmt_delete = $pdo->prepare($sql_delete);
 
     // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
     $stmt_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
 
     // SQL文を実行する
     $stmt_delete->execute();
 
     // 削除した件数を取得する
     $count = $stmt_delete->rowCount();
 
     $message = "書籍を{$count}件削除しました。";
 
     // 書籍一覧ページにリダイレクトさせる（同時にmessageパラメータも渡す）
     header("Location: read.php?message={$message}");
 } catch (PDOException $e) {
     exit($e->getMessage());
 }