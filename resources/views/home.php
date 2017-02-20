<?php include_once 'layout/header.view.php'; ?>

    <section>
        <h1>Bonjour, bienvenue sur mon blog</h1>
        <div class="bg-tiret">
            <span class="tiret"></span>
            <span class="tiret"></span>
        </div>
        <?php foreach ($articles as $article) : ?>
            <article>
                <div class="round">
                    <time>
                        <?php
                        $date = new DateTime($article->created_at);
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
                <h2><?= $article->title; ?></h2>
                <p><?= substr($article->content, 0, 190) . '...'; ?></p>
                <a href="/article/<?= $article->id; ?>">Read More</a>
                <hr>
            </article>
        <?php endforeach; ?>
    </section>

<?php include_once 'layout/footer.view.php'; ?>