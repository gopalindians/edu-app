<footer style="margin-top: 10px;margin-bottom: 10px;">
    <div class="card-deck">
        <div class="card">

            <!--<div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>-->
            <!--<div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>-->
        </div
    </div>
</footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<?php
if ( isset( $this->minify ) ) {
	$this->minify->add_js( 'question.comments.load_more.js,helpers.js' );
	echo $this->minify->deploy_js( true, 'auto' );
}
?>
<script>
    $(document).ready(function () {
        var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        $('a[data-target="#reportModal"]').click(function () {
            $('#report_question_id').val($('a[data-target="#reportModal"]').data('question-id'));
        });
        $('input[name=report]').change(function () {
            if ($('input[name=report]').val() != '') {
                $('#report_send_btn').click(function () {
                    $.ajax({
                        url: '/report',
                        type: "POST",
                        ifModified: true,
                        data: {
                            csrfName: csrfHash,
                            type: $('input[name=report]').val(),
                            question_id: $('input[type=hidden][name=report]').val()
                        },
                        success: function (response) {
                            console.log(response);
                            $(function () {
                                $('#reportModal').modal('toggle');
                            });
                        }
                    })
                });
            }
        });
    });
</script>
</body>
</html>