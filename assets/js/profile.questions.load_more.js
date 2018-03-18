/*
URL: [DOMAIN]/profile/[PROFILE_ID]/[SAFE_EMAIL]?tab=questions
* */
$(document).ready(function () {
    $('#profile_questions_load_more').click(function () {
        var csrfValue = $('meta[name=csrfHash]').attr("content");
        var user_id = $('#profile_user_id').val();
        var profile_question_offset = $('#profile_question_offset').val();
        $.ajax({
            url: '/profile/load_more_questions',
            method: 'POST',
            data: {
                'csrf_token': csrfValue,
                'user_id': user_id,
                'limit': 5,
                'offset': profile_question_offset,
            },
            success: function (response) {
                console.log(response);
                $('meta[name=csrfHash]').attr("content", response.csrf);
                csrfValue = response.csrf;
                $('#profile_question_offset').val(response.result.current_offset);
                response.result.all_questions.forEach(function (data) {
                    var moment_question_date = moment(data.question_updated_at).fromNow();
                    $('#profile_questions').append('' +
                        '<div class="card" style="margin-top: 5px">\n' +
                        '                        <div class="card-body">\n' +
                        '                            <h6 class="card-subtitle mb-2 text-muted"><a\n' +
                        '                                        href="/question/' + data.question_id + '/' + data.question_slug + '">' + data.question_text + '</a>\n' +
                        '                                <input type="hidden" id="hidden_question_id" value="' + data.question_id + '">\n' +
                        '                            </h6>\n' +
                        '                            <small id="question_<?= $question->question_id; ?>">' + moment_question_date + '</small> |\n' +
                        '                            <small> Comments</small>\n' +
                        '                            <small class="badge badge-secondary">' + data.question_total_comments + '</small> |' +
                        '                            <small>By <a href="/profile/' + data.user_id + '/' + data.safe_user_email + '"\n' +
                        '                                   class="card-link">' + data.safe_user_email + '</a>\n' +
                        '                            </small>\n' +
                        '                        </div>\n' +
                        '                    </div>');
                });
                if (response.result.all_questions.length == 0) {
                    $('#profile_questions_load_more').hide();
                }
            },
            error: function (response) {
                console.log(response);
            }
        })
    });
});