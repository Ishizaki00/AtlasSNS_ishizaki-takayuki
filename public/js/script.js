document.addEventListener('DOMContentLoaded', () => {
    // アコーディオンのトグル要素を取得
    console.log('Script loaded'); // スクリプトが読み込まれたか確認
    const accordionTitles = document.querySelectorAll('[data-accordion-title]');

    // 各トグル要素にクリックイベントを追加
    accordionTitles.forEach(title => {
        title.addEventListener('click', () => {
            // 対応するメニュー要素を取得
            const menu = title.nextElementSibling;
            // 矢印アイコンを取得
            const arrowIcon = title.querySelector('.arrow-icon');

            // メニューの表示/非表示を切り替え
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '')
                ? 'block'  //アコーディオンメニュー表示
                : 'none';  //アコーディオンメニュー非表示

            // アイコンの回転を切り替え
            if (arrowIcon) {
                arrowIcon.classList.toggle('rotate');
                console.log('Icon rotation toggled'); // デバッグ用
            }
        });
    });
});
