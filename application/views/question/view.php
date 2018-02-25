<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-02-2018
 * Time: 00:40
 * Link:
 */

?>

</br>

<div class="card text-center">
    <!--<div class="card-header">
        Featured
    </div>-->
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
        <a href="/question/add" class="btn btn-primary">Add new question</a>
    </div>
    <!--<div class="card-footer text-muted">
        2 days ago
    </div>-->
</div>
<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12" style="">
        <div class="card" style="margin-top: 5px">
            <div class="card-body">
                <!--<h5 class="card-title">Card title</h5>-->
                <h6 class="card-subtitle mb-2 text-muted"><?= $question[0]->question_text; ?></h6>
                <p class="card-text"><?= $question[0]->question_description; ?></p>
                <a href="#" class="card-link small">Card link</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 hidden-md hidden-sm">
        <div class="alert alert-success">Hello</div>
    </div>
</div>

