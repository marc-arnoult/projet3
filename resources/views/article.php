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
                <i class="" aria-hidden="true"></i>
            </span>
            </div>
            <hr>
            <h2><?= $articles->title; ?></h2>
            <p><?= $articles->content; ?></p>
            <hr>
        </article>
    </section>
    <?php var_dump($session->get('user')); ?>
    <section>
        <div class="comment">
            <h3>* Commentaires *</h3>
            <form action="/articles" method="post">
                Titre
                <input type="text" name="title">
                Commentaire
                <textarea name="content"></textarea>
                <input type="submit">
            </form>
        </div>
    </section>

<?php include_once 'layout/footer.view.php'; ?>