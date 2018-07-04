$(document).ready(function () {


    $('#add_tags').click(function () {
        $(this).hide();
        $('.cont').show();
    });
    $('#search-tags').keyup(function (e) {


        if ($('#search-tags').val().length > 2) {
            var csrfValue = $('meta[name=csrfHash]').attr("content");
            $.ajax({
                url: '/tags/search',
                method: 'POST',
                data: {
                    'csrf_token': csrfValue,
                    'term': $('#search-tags').val()
                },
                success: function (e) {
                    var suggestions = '';
                    e.suggestions.forEach(function (data) {

                        if (tags_array.indexOf(data.slug) >= 0) {

                        } else {
                            suggestions += '\n' +
                                '                        <div onclick="handleClickOnTag(\'' + data.slug + '\',\'' + data.tag_name + '\');$(this).hide();" class="col-lg-4 justify small text-center suggested-tag" style="cursor: pointer" >' +
                                '<a href="/tag/' + data.slug + '">' + data.tag_name + '</a>\n' +
                                '<div class="col-lg-12">' + data.tag_description + '</div>\n' +
                                '                    </div>'
                        }
                    });
                    $('#tag-picker').html('<div class="row" id="suggestions">' + suggestions + '</div>');
                    $('#tag-picker').show();
                },
                complete: function (e) {
                    console.log(e);
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    });
});
var tags = '';
var tags_array = [];

function handleClickOnTag(slug, tag_name) {
    console.log(slug, tag_name);
    tags_array.push(slug);

    tags += '<span class="badge badge-primary"><a href="/tags/' + slug + '" style="color:#fff;text-decoration:none;"> ' + tag_name + '</a></span> ';
    $('#tags').html('<p>' + tags + '</p>');
}
