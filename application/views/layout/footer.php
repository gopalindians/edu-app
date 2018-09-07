<footer style="margin-top: 10px;margin-bottom: 10px;">
    <div class="center"><a href="/feedback">Feedback</a></div>
    <div class="card-deck">
        <div class="card">
        </div
    </div>
</footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>



<?php
if ( isset( $this->minify ) ) {
	$this->minify->add_js( [ 'profile.questions.load_more.js', 'question.comments.load_more.js', 'tags.js' ] );
	echo $this->minify->deploy_js( true, 'auto' );
}

if ( isset( $this->minify ) ) {
	$this->minify->add_css( [ 'tags.css','loader.css' ] );
	echo $this->minify->deploy_css( true, 'auto' );
}
?>
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js').then(function (registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function (err) {
                // registration failed :(
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
</script>
</body>
</html>