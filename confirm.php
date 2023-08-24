<?php
session_start();   //SESSIONを使うときは最初にスタートさせる

if (isset($_SESSION['consult'])) {
  $consult = $_SESSION['consult'];
  $company = $_SESSION['company'];
  $name = $_SESSION['name'];
  $phone = $_SESSION['phone'];
  $email = $_SESSION['email'];
  $message = $_SESSION['message'];
}
// ここにトークンを生成するコードを記述
$token = sha1(uniqid(mt_rand(), true));
$_SESSION['token'] = $token;

// $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
// $token = htmlspecialchars($_SESSION['token'], ENT_QUOTES);
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

  <title>お問い合わせ内容確認 | EC Connect | ECサイトの運用代行</title>

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
  .contactform__confirm{
    width: 500px;
    margin: 0 auto;
    padding-bottom: 100px;
    text-align: left;
  }
  .contactform__confirm tbody tr{
    height: 35px;
    vertical-align: baseline;
  }
  .contactform__confirm tbody tr th{
    width: 35%;
  }
  .contactform__confirm tbody tr td{
    width: 65%;
    line-height: 1.5;
  }
  .contactform__btn{
    display: flex;
    justify-content: center;
    gap: 35px;
    margin-top: 50px;
  }
  .contactform__back{
    width: 352px;
    font-size: 24px;
    font-weight: bold;
    color: #EF8125;
    border: 4px solid #EF8125;
    border-radius: 60px;
    padding: 23px;
    transition: opacity .3s;
  }
  .contactform__back:hover{
    opacity: .8;
  }
  .contactform__submit{
    margin: 0;
  }
  @media screen and (max-width: 1024px) {
    .contactform__confirm{
      width: 100%;
      padding-bottom: 13.33vw;
    }
    .contactform__confirm tbody tr{
      height: 9.33vw;
      font-size: 3.47vw;
    }
    .contactform p{
      font-size: 3.47vw;
    }
    .contactform__btn{
      gap: 4vw;
      margin-top: 6.67vw;
    }
    .contactform__back{
      width: 50%;
      font-size: 4.27vw;
      border: 0.53vw solid #EF8125;
      border-radius: 6.67vw;
      padding: 3.2vw;
    }
    .contactform__submit{
      width: 50%;
    }
    .contactform__submit-img {
      right: 5.87vw;
    }
  }
</style>
<body>
  <div class="contactform">
    <div class="contactform__inner">
      <div class="sec__title">
        <h2>お問い合わせ内容確認</h2>
      </div>
      <table class="contactform__confirm">
        <tr>
          <th>無料相談</th>
          <td>
            <?php echo $consult; ?>
          </td>
        </tr>
        <tr>
          <th>会社名</th>
          <td>
            <?php echo $company; ?>
          </td>
        </tr>
        <tr>
          <th>氏名</th>
          <td>
            <?php echo $name; ?>
          </td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>
            <?php echo $phone; ?>
          </td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>
            <?php echo $email; ?>
          </td>
        </tr>
        <tr>
          <th>お問い合わせ内容</th>
          <td>
            <?php echo nl2br($message); ?>
          </td>
        </tr>
      </table>
      <p>この内容で送信してもよろしいですか？</p>
      <form method="post" action="send.php">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <div class="contactform__btn">
          <a class="contactform__back" href="index.php?action=edit#contact">戻る</a>
          <div class="contactform__submit">
            <button type="submit" value="送信する">送信する</button>
            <div class="contactform__submit-img">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                <path id="assistant_navigation_FILL0_wght400_GRAD0_opsz48" d="M9.64,23.52,16,20.64l6.36,2.88.2-.2L16,7.44,9.44,23.32ZM16,32a15.481,15.481,0,0,1-6.2-1.26A16.12,16.12,0,0,1,1.26,22.2,15.482,15.482,0,0,1,0,16,15.58,15.58,0,0,1,1.26,9.76,15.991,15.991,0,0,1,4.7,4.68,16.4,16.4,0,0,1,9.8,1.26,15.482,15.482,0,0,1,16,0a15.58,15.58,0,0,1,6.24,1.26,16.158,16.158,0,0,1,5.08,3.42,16.481,16.481,0,0,1,2.359,3.014A15.872,15.872,0,0,1,30.74,9.76,15.58,15.58,0,0,1,32,16a15.481,15.481,0,0,1-1.26,6.2,16.4,16.4,0,0,1-3.42,5.1,15.99,15.99,0,0,1-5.08,3.44A15.58,15.58,0,0,1,16,32Zm0-2.4a13.087,13.087,0,0,0,9.64-3.98A13.139,13.139,0,0,0,29.6,16a15.787,15.787,0,0,0-.22-2.583A12.762,12.762,0,0,0,25.64,6.36,13.12,13.12,0,0,0,16,2.4,13.139,13.139,0,0,0,6.38,6.36,13.087,13.087,0,0,0,2.4,16a13.106,13.106,0,0,0,3.98,9.62A13.106,13.106,0,0,0,16,29.6ZM16,16Z" transform="translate(32) rotate(90)"></path>
              </svg>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
