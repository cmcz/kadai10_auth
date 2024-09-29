<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//1. POSTデータ取得
$loginID = $_POST["loginID"]; //loginID
$loginPW = $_POST["loginPW"]; //loginPW

//2. DB接続します
include 'util/db_connect.php';

//3. データ登録SQL作成
//* PasswordがHash化→条件はloginIDのみ！！
$stmt = $pdo->prepare("SELECT * FROM user_table WHERE loginID=:loginID AND activeFlag=1"); 
$stmt->bindValue(':loginID', $loginID, PDO::PARAM_STR);
$status = $stmt->execute();

// 4. SQL実行時にエラーがある場合STOP
if($status==false){
    $error = $stmt->errorInfo();
    exit("SQL_SELECT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}

$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($loginPW, $val["loginPW"]); //$loginPW = password_hash($loginPW, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["adminFlag"] = $val['adminFlag'];
  $_SESSION["loginID"]   = $val['loginID'];
  $_SESSION["email"]   = $val['email'];
  header("Location: ../index.php");
  exit();
}else{
    header("Location: ../login.php");
    exit();
}

exit();


