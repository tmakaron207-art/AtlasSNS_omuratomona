

// accordion-btnを取得
const btn = document.querySelector('.accordion-btn');

// accordion-listをmenuに変数変換して保存取得
const menu = document.querySelector('.accordion-list');

// arrow矢印を取得
const arrow = document.querySelector('.arrow');


// クリック時に、accordion-list,arrowのクラス名の後ろに、show,openを付ける消すを自動設定設定定
btn.addEventListener('click', () => {
  menu.classList.toggle('show');
  arrow.classList.toggle('open');
});
