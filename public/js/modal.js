// $(document).ready(function () {
$(function () {
    // 編集ボタンをクリックするとモーダルを表示
    $(".modal-button").on("click", function () {
        // $(".modal-block").fadeIn().css("display", "flex");
      $(".modal-block").fadeIn();
      // console.log("test");
    });


    // モーダルの外側をクリックしたら閉じる
    $(document).on("click", ".modal-block", function (e) {
        if (e.target === this) {
            $(this).fadeOut();
        }
    });
});
