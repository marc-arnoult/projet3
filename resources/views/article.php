<?php include_once 'layout/header.view.php'; ?>

    <section>
        <article>
            <div class="round">
                <time>
                    <?php
                    $date = new DateTime($articles->created_at);
                    echo $date->format('d M Y');
                    ?>
                </time>
            </div>
            <div class="info"
            <span>
                <i class="fa fa-comment-o" aria-hidden="true"></i>21 Comments
            </span>
            </div>
            <hr>
            <h2><?= $articles->title; ?></h2>
            <p><?= $articles->content; ?></p>
            <hr>
        </article>
    </section>

    <section>
        <form action="#">
            Titre
            <input type="text">
            Commentaire
            <textarea name="" rows="10"></textarea>
        </form>
    </section>

<?php include_once 'layout/footer.view.php'; ?>