<?php include_once 'layout/header.view.php'; ?>
    <section>
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
                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                    <?php
                        $commentDAO = $request->get('commentDAO');
                        $nb = $commentDAO->getCountComment($article->id)->nbComments;
                        echo $nb;
                    ?>
                    commentaires
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
