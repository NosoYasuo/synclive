$(function() {
    get_data();
});

function get_data() {
        console.log(id1);
    console.log(id2);

    $.ajax({
        url: "https://testsynclive.herokuapp.com/room/result/ajax",
        dataType: "json",
        data: {'id1':id1, 'id2':id2},
        success: data => {
            $("#comment-data")
                .find(".comment-visible")
                .remove();

            for (var i = 0; i < data.comments.length; i++) {
                console.log(data.comments[i]);
                var html = `
                            <div class="media comment-visible">
                                <div class="media-body comment-body">
                                    <div class="row">
                                        <span class="comment-body-user" id="name">${data.comments[i].sender_name}</span>
                                        <span class="comment-body-time" id="created_at">${data.comments[i].created_at}</span>
                                    </div>
                                    <span class="comment-body-content" id="comment">${data.comments[i].comment}</span>
                                </div>
                            </div>
                        `;

                $("#comment-data").append(html);
            }
        },
        error: () => {
            console.log("ajax Error");
        }
    });

    setTimeout("get_data()", 10000);
}


// $(function () {
//     let submit = $('#submit');
//     submit.on('click', function () {
//         let comment = $('#chat_comment').val();
//         let to_user_id = $('#to_user_id').val();
//         console.log(comment);
//         console.log(to_user_id);
//         // ajax処理スタート
//         $.ajax({
//             headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
//             url: 'add',
//             method: 'POST',
//             data: {'comment': comment},
//         })
//         //通信成功した時の処理
//         .done(function () {
//             get_data();
//         })
//         //通信失敗した時の処理
//         .fail(function () {
//             console.log('fail');
//         });
//     });
// });
