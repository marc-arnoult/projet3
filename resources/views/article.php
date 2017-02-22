<?php
    include_once 'layout/header.view.php';
    if($session->get('user')) {
        $user = $session->get('user');
    }
?>

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
    <section>
        <div class="comment-response">
            <h3>* Commentaires *</h3>
            <?php if($session->get('user')) : ?>
            <form action="/comments" method="post">
                <input type="hidden" name="id_article" value="<?= $articles->id; ?>">
                <label for="content">Commentaire :</label>
                <textarea name="content"></textarea>
                <input type="submit">
            </form>
            <?php endif; ?>
        </div>
        <div class="comments">
            <?php foreach($comments as $comment): ?>
                <div class="open">
                    <h4><?= $comment->pseudo; ?></h4>
                    <a href="/comments">Répondre</a>
                    <p><?= $comment->content; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

<?php include_once 'layout/footer.view.php'; ?>