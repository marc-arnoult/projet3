<?php

/* article.twig */
class __TwigTemplate_12fb2b11e46967e69312c078091a2e39a058f3be6c1a180015d5526d04f01f30 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "article.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["article"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "article"), "method");
        // line 4
        $context["comments"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "comments"), "method");
        // line 5
        $context["messages"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "messages"), "method");
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["article"] ?? null), "title", array()), "html", null, true);
        echo "
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["message"]) {
            // line 12
            echo "        <div class=\"alert alert-";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">
            <span class=\"alert-text\">";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["message"], 0, array(), "array"), "html", null, true);
            echo "</span>
            <span class=\"alert-remove\">x</span>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "<section id=\"article-page\">
    <div class=\"article-container\">
        <article class=\"article\">
            <div class=\"round\">
                <time>
                    ";
        // line 22
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["article"] ?? null), "created_at", array()), "d M Y"), "html", null, true);
        echo "
                </time>
            </div>
            <h2>";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute(($context["article"] ?? null), "title", array()), "html", null, true);
        echo "</h2>
            <div class=\"content\">
                ";
        // line 27
        echo nl2br($this->getAttribute(($context["article"] ?? null), "content", array()));
        echo "
            </div>
        </article>
    </div>
</section>
<section id=\"article-comment\">
    <div class=\"comment-response\">
        <h3>* Commentaires *</h3>
        ";
        // line 35
        if (($context["user"] ?? null)) {
            // line 36
            echo "            <form action=\"/comments\" method=\"post\" id=\"formComment\">
                <input type=\"hidden\" name=\"id_article\" value=\"";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute(($context["article"] ?? null), "id", array()), "html", null, true);
            echo "\">
                <label for=\"content\">Commentaire :</label>
                <textarea name=\"content\" required></textarea>
                <input type=\"submit\">
            </form>
        ";
        }
        // line 43
        echo "    </div>
    ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 45
            echo "        ";
            $this->loadTemplate("comments.twig", "article.twig", 45)->display($context);
            // line 46
            echo "    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "</section>
";
    }

    // line 49
    public function block_script($context, array $blocks = array())
    {
        // line 50
        echo "    <script src=\"/public/js/comment.js\"></script>
    <script src=\"/public/js/comment_edit.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "article.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 50,  155 => 49,  150 => 47,  136 => 46,  133 => 45,  116 => 44,  113 => 43,  104 => 37,  101 => 36,  99 => 35,  88 => 27,  83 => 25,  77 => 22,  70 => 17,  60 => 13,  55 => 12,  50 => 11,  47 => 10,  40 => 8,  37 => 7,  33 => 1,  31 => 5,  29 => 4,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "article.twig", "/var/www/html/resources/views/article.twig");
    }
}
