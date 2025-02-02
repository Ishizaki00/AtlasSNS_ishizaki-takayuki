// $(document).ready(function () {
$(function () {
    // 編集ボタンをクリックするとモーダルを表示
    $(".modal-button").on("click", function () {
        // $(".modal-block").fadeIn().css("display", "flex");
      $(".modal-block").fadeIn();
        // console.log("test");
        // 押されたボタンから投稿内容を取得し変数へ格納
        var post = $(this).data('post');
        // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
        var post_id = $(this).attr('data-post-id');



        // 取得した投稿内容をモーダルの中身へ渡す
        $('.modal_post').text(post);
        // 取得した投稿のidをモーダルの中身へ渡す
        $('.modal_id').val(post_id);
        // return false;
        // 以下のように設定することで送信先のURLを変更（例えば、post_id = 5 なら action="/posts/update/5" に変更。）
        $("#edit-form").attr("action", "/posts/update/" + post_id);
    });

    // 投稿編集

    // モーダルの外側をクリックしたら閉じる
    $(document).on("click", ".modal-block", function (e) {
        if (e.target === this) {
            $(this).fadeOut();
        }
    });
});
