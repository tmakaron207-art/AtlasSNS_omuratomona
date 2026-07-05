

// ☆☆アコーディオンメニューのアクション設定↓

// accordion-btnを取得
const btn = document.querySelector('.accordion-btn');

// accordion-listをmenuに変数変換して保存取得
const menu = document.querySelector('.accordion-list');

// arrow矢印を取得
const arrow = document.querySelector('.arrow');


// クリック時に、accordion-list,arrowのクラス名の後ろに、show,openを付ける消すを自動設定
btn.addEventListener('click', () => {
  menu.classList.toggle('show');
  arrow.classList.toggle('open');
});


// 編集ボタンをクリックしたら、編集用のフォームが出るようにする設定
const editBtns = document.querySelectorAll('.edit-btn');

editBtns.forEach(function (button) {
  button.addEventListener('click', function () {


    console.log("編集ボタンが押された");

    const modal = this.parentElement.nextElementSibling;

    modal.style.display = 'block';

  });
});
