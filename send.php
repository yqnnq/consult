<?php
session_start(); // セッションを使用するのでスタートさせます
if($_SESSION['token'] === $_POST['token']){

  if(isset($_SESSION['consult'])){
    $consult = $_SESSION['consult'];
    $company = $_SESSION['company'];
    $name = $_SESSION['name'];
    $phone = $_SESSION['phone'];
    $email = str_replace(array("\r","\n"),'',$_SESSION['email']);
    $message = $_SESSION['message'];
  }

  // 自分に送るお問い合わせ内容メールを構築
  $to = $email;
  $mailtitle = "お問い合わせが届きました。";
  $contents = <<<EOD

  ◆無料相談
  {$consult}

  ◆会社名
  {$company}

  ◆氏名
  {$name}

  ◆電話番号
  {$phone}

  ◆メールアドレス
  {$email}

  ◆お問い合わせ内容
  {$message}

  EOD;
  $from = "From: EC Connect <$to>\n";

  // 相手に送る送信完了メールを構築
  $to2 = $email;
  $mailtitle2 = "【自動送信】お問い合わせありがとうございます。";
  $contents2 = <<<EOD
  お問い合わせありがとうございます。
  以下の内容を送信いたしました。
  返信までしばらくお待ちください。
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  {$contents}

  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  EC Connect株式会社
  E-mail: xxx@email.com

  EOD;
  $from2 = "Return-Path:" . $to . "\r\n";
  $from2 .= "MIME-Version: 1.0\n";
	$from2 .= "From: EC Connect <$to>\n";
  $from2 .= "Reply-To:" . $to . "\r\n";

  // メール送信
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

  $param = "-f" . $to;
  //  mb_send_mail(送信先,タイトル,本文,追加ヘッダ,追加コマンドラインパラメータ)
  if (mb_send_mail($to2, $mailtitle2, $contents2, $from2, $param)) { // 相手に送信

    $message = '<div class="sec__title"><h2>お問い合わせありがとうございます</h2></div><p class="contactform__send">お問い合わせありがとうございます。<br>ご入力いただいたメールアドレス宛に<br class="sp-display">確認メールを送信しました。<br><br>しばらく経ってもメールが届かない場合は、<br class="sp-display">ご入力頂いたメールアドレスが誤っているか、<br>迷惑メールフォルダに<br class="sp-display">振り分けられている可能性がございます。</p>';

    if (mb_send_mail($to,$mailtitle,$contents,$from,$param)) { // 自分に送信

      // 終了処理開始 セッションの破棄
      $_SESSION = [];
      if (isset($_COOKIE[session_name()])) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params['httponly']);
      }
      session_destroy();
    } else {
      $message = '<p class="contactform__send error">何らかの理由で送信エラーが発生しました。<br>しばらく待ってから再度送信してください。</p>';
    }
  } else {
    $message = '<p class="contactform__send error">メールを送信できませんでした。<br>正しいメールアドレスで再度お問い合わせお願いいたします。</p>';
  }

} else {

  // 直接send.phpにアクセスしようとしたら強制的にリダイレクト
  // header('Location:./index.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="604800">
    <meta name="format-detection" content="telephone=no">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />

    <meta property="og:site_name" content="ECサイトの運用代行ならEC Connect">
    <meta property="og:title" content="ECサイトの運用代行ならEC Connect">
    <meta property="og:description" content="ECサイトの運用代行ならEC Connectへお任せ下さい。20年間の実績の元、サイト構築、デザイン、マーケティング、オペレーション、物流など一気通貫で行う事ができ、全てにおいてプロフェッショナルが対応いたします。">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ECサイトの運用代行ならEC Connect">
    <meta name="twitter:description" content="ECサイトの運用代行ならEC Connectへお任せ下さい。20年間の実績の元、サイト構築、デザイン、マーケティング、オペレーション、物流など一気通貫で行う事ができ、全てにおいてプロフェッショナルが対応いたします。">
    <meta name="twitter:url" content="">
    <meta name="twitter:site" content="">
    <meta name="twitter:image" content="">

    <title>送信完了 | EC Connect | ECサイトの運用代行</title>

    <!-- ファビコン -->
    <link rel="icon" href="./images/favicon.ico">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>
</head>
<style>
  .contactform{
    text-align: center;
  }
  .contactform__send{
    margin-bottom: 50px;
    line-height: 1.5;
  }
  .contactform__back{
    width: 352px;
    font-size: 24px;
    font-weight: bold;
    color: #FFFFFF;
    background-color: #EF8125;
    border: 4px solid #EF8125;
    border-radius: 60px;
    padding: 23px;
    transition: background-color 0.3s, color 0.1s;
  }
  .contactform__back:hover{
    color: #EF8125;
    background-color: #FFFFFF;
  }
  @media screen and (max-width: 1024px) {
    .contactform__send{
      margin-bottom: 6.67vw;
      font-size: 3.47vw;
    }
    .contactform__back{
      width: 72.27vw;
      font-size: 4.27vw;
      border: 0.53vw solid #EF8125;
      border-radius: 6.67vw;
      padding: 3.2vw;
    }
  }
</style>
<body>
  <div class="contactform">
    <div class="contactform__inner">
      <?php
          if($message !== ""){
            echo $message;
          }
        ?>
      <a class="contactform__back" href="index.php">TOPに戻る</a>
    </div>
  </div>
</body>
</html>
