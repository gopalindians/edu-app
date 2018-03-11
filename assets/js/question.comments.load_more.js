/*

URL: [DOMAIN]/question/[QUESTION_ID]/[QUESTION_SLUG]
* */

$(document).ready(function () {
    $('#question_comments_load_more').click(function () {
        var csrfValue = $('meta[name=csrfHash]').attr("content");
        var question_id = $('input[name=question_id]').val();
        var comment_offset = $('input[name=comment_offset]').val();
        $.ajax({
            url: '/question/load_more_comments',
            method: 'POST',
            data: {
                'csrf_token': csrfValue,
                'question_id': question_id,
                'limit': 5,
                'offset': comment_offset,
            },
            success: function (response) {
                $('meta[name=csrfHash]').attr("content", response.csrf);
                csrfValue = response.csrf;
                $('input[name=comment_offset]').val(response.comments.current_offset);

                response.comments.result.forEach(function (data) {
                    $('#question_comments').append('' +
                        '<div class="card" style="margin-top: 5px">\n' +
                        '                    <div class="card-body">\n' +
                        '                        <p class="card-text">' + data.question_comment_body + '</p>\n' +
                        '                        <div class="float-right">\n' +
                        '                            <a href="/profile/' + data.user_id + '/' + data.safe_user_email + '"\n' +
                        '                               class="card-link small float-right">' + data.safe_user_email + '</a>\n' +
                        '                            <br>\n' +
                        '                            <small>' + data.question_comment_updated_at + '</small>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>');
                });

                if (response.comments.current_offset > response.comments.total_comments) {
                    $('#question_comments_load_more').hide();
                }
            },
            error: function (response) {
                console.log(response);
            }
        })
    });
});