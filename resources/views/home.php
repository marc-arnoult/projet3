<?php $session = $request->getSession(); ?>

<?php include_once 'layout/header.view.php'; ?>

    <section>
        <h1>Bonjour, bienvenue sur mon blog</h1>
        <div class="bg-tiret">
            <span class="tiret"></span>
            <span class="tiret"></span>
        </div>
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
            <p><?= substr($articles->content, 0, 190) . '...'; ?></p>
            <a href="/article/<?= $articles->id; ?>">Read More</a>
            <hr>
        </article>
    </section>

<?php include_once 'layout/footer.view.php'; ?>