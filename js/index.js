$(function () {
  /* -------------------------------------------------------
  よくある質問 アコーディオン
  --------------------------------------------------------*/
  $('.question__list-title').on('click', function () {
    $(this).next("div").slideToggle();
    $(this).toggleClass("active");
    $('.question__list-title').not($(this)).next('div').slideUp();
    $('.question__list-title').not($(this)).removeClass("active");
  });

  /* -------------------------------------------------------
  リストクリックでスムーズスクロール
  --------------------------------------------------------*/
  $('a[href^="#"]').click(function () {
    const header = $(".header").height();
    const speed = 500;
    const href = $(this).attr("href");
    const target = $(href == "#" || href == "" ? 'html' : href);
    const position = target.offset().top - header + 15;
    $("html, body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });

  /* -------------------------------------------------------
  画像遅延
  --------------------------------------------------------*/
  $("img.lazyload").lazyload();

  /* -------------------------------------------------------
  導入事例スライダー
  --------------------------------------------------------*/
  $(".example__slider").slick({
    infinite: true, //無限ループ
    speed: 500,
    slidesToShow: 4,
    lazyLoad: 'progressive',
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          centerMode: true,
          centerPadding: "15%",
        },
      },
    ],
  });
});


/* -------------------------------------------------------
  フェードインアニメーション
--------------------------------------------------------*/
function animation() {
  const $scroll = $(window).scrollTop();
  const $windowH = $(window).height();

  $('.fadeIn').each(function () {
    const $target = $(this).offset().top + 80;
    if ($scroll >= $target - $windowH) {
      $(this).addClass('active');
    }
  });
}

/* -------------------------------------------------------
  トップ背景
--------------------------------------------------------*/
function particles() {
  particlesJS('js-particles', {
    "particles": {

      //--シェイプの設定----------
      "number": {
        "value": 40, //シェイプの数
        "density": {
          "enable": true, //シェイプの密集度を変更するか否か
          "value_area": 400 //シェイプの密集度
        }
      },
      "shape": {
        "type": "circle", //シェイプの形（circle:丸）
      },
      "color": {
        "value": "#F3D9DC" //シェイプの色
      },
      "opacity": {
        "value": 0.4, //シェイプの透明度
        "random": false, //シェイプの透明度をランダムにするか否か
        "anim": {
          "enable": false, //シェイプの透明度をアニメーションさせるか否か
          "speed": 1, //アニメーションのスピード
          "opacity_min": 0.1, //透明度の最小値
          "sync": false //全てのシェイプを同時にアニメーションさせるか否か
        }
      },
      "size": {
        "value": 10, //シェイプの大きさ
        "random": true, //シェイプの大きさをランダムにするか否か
        "anim": {
          "enable": false, //シェイプの大きさをアニメーションさせるか否か
          "speed": 1, //アニメーションのスピード
          "size_min": 0.1, //大きさの最小値
          "sync": false //全てのシェイプを同時にアニメーションさせるか否か
        }
      },
      //--------------------

      //--線の設定----------
      "line_linked": {
        "enable": true, //線を表示するか否か
        "distance": 150, //線をつなぐシェイプの間隔
        "color": "#F3D9DC", //線の色
        "opacity": 0.2, //線の透明度
        "width": 2 //線の太さ
      },
      //--------------------

      //--動きの設定----------
      "move": {
        "enable": true,
        "speed": 5, //シェイプの動くスピード
        "straight": false, //個々のシェイプの動きを止めるか否か
        "direction": "none", //エリア全体の動き(none、top、top-right、right、bottom-right、bottom、bottom-left、left、top-leftより選択)
        "out_mode": "out", //エリア外に出たシェイプの動き(out、bounceより選択)
      }
      //--------------------

    },

    "retina_detect": true, //Retina Displayを対応するか否か
    "resize": true //canvasのサイズ変更にわせて拡大縮小するか否か
  }
  );
}

/* -------------------------------------------------------
  関数
--------------------------------------------------------*/
$(window).on('scroll', function () {
  animation(); //フェードイン
});

$(window).on('load', function () {
  $(".js-loading").delay(1300).fadeOut('slow');
  $(".js-loading__logo").delay(1000).fadeOut('slow', function () {
    $('.lp').addClass('active');
    particles(); //トップ背景

    setTimeout(function () {
      $('.top__content').css("opacity", "1");
    }, 500);
    setTimeout(function () {
      animation(); //フェードイン
    }, 1500);
    setTimeout(function () {
      $('.banner').css("opacity", "1");
    }, 2000);
  });
});
