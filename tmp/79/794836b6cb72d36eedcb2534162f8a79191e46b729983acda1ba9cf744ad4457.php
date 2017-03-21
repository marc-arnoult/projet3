<?php

/* home.twig */
class __TwigTemplate_bae48a4212e6658af2754ad07f63a2fb64ac5afeffe18edce2fc05356c513ae4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "home.twig", 1);
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
        $context["articles"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "articles"), "method");
        // line 4
        $context["commentDAO"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "commentDAO"), "method");
        // line 5
        $context["messages"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "messages"), "method");
        // line 6
        $context["lastComments"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "lastComments"), "method");
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    public function block_title($context, array $blocks = array())
    {
        // line 9
        echo "   ";
        echo "Jean Forteroche";
        echo "
";
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        // line 13
        echo "    <section id=\"home-page\">
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["message"]) {
            // line 15
            echo "            <div class=\"alert alert-";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">
                <span class=\"alert-text\">";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["message"], 0, array(), "array"), "html", null, true);
            echo "</span>
                <span class=\"alert-remove\">x</span>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "
        <h1>Bienvenue sur le blog de Jean Forteroche</h1>
        <p>Vous trouverez ici les derniers billets à propos de mon nouveau roman : <strong>Billet simple pour l'Alaska.</strong></p>
        <div class=\"bg-tiret\">
            <div class=\"tiret\"></div>
            <div class=\"tiret\"></div>
        </div>
        <p>Dernier article</p>
        ";
        // line 28
        $this->loadTemplate("home.twig", "home.twig", 28, "1935371243")->display($context);
        // line 29
        echo "        <p>
            <a href=\"/articles\">Tout les articles</a>
        </p>
    </section>
    <section id=\"home-page-lastComment\">
        <h2>Derniers commentaires publiés</h2>
        <div class=\"comment-container\">
            ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["lastComments"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 37
            echo "                <div class=\"comments\">
                    <div class=\"reply\" data-id=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "id", array()), "html", null, true);
            echo "\">
                        <p>Posté par <strong>";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "pseudo", array()), "html", null, true);
            echo "</strong></p>
                        <i> le : ";
            // line 40
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["comment"], "created_at", array()), "d/m/Y à H:i", "Europe/Paris"), "html", null, true);
            echo "</i>
                        <a href=\"\" class=\"btn-reporting\">signaler</a>
                        <p>";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "content", array()), "html", null, true);
            echo "</p>
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "        </div>
    </section>
    <section id=\"home-page-contact\">
        <h3>Me contacter</h3>
        <hr>
        <form action=\"#\">
            <label for=\"email\">Votre email :</label>
            <input title=\"email\" name=\"email\" type=\"email\">
            <label for=\"message\">Votre message :</label>
            <textarea name=\"message\" id=\"message\" cols=\"30\" rows=\"10\"></textarea>
            <input type=\"submit\" value=\"Envoyer\">
        </form>
    </section>
";
    }

    // line 61
    public function block_script($context, array $blocks = array())
    {
        // line 62
        echo "    <script src=\"/public/js/home.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 62,  142 => 61,  125 => 46,  115 => 42,  110 => 40,  106 => 39,  102 => 38,  99 => 37,  95 => 36,  86 => 29,  84 => 28,  74 => 20,  64 => 16,  59 => 15,  55 => 14,  52 => 13,  49 => 12,  42 => 9,  39 => 8,  35 => 1,  33 => 6,  31 => 5,  29 => 4,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home.twig", "/var/www/html/resources/views/home.twig");
    }
}


/* home.twig */
class __TwigTemplate_bae48a4212e6658af2754ad07f63a2fb64ac5afeffe18edce2fc05356c513ae4_1935371243 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 28
        $this->parent = $this->loadTemplate("articles.twig", "home.twig", 28);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "articles.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 28,  145 => 62,  142 => 61,  125 => 46,  115 => 42,  110 => 40,  106 => 39,  102 => 38,  99 => 37,  95 => 36,  86 => 29,  84 => 28,  74 => 20,  64 => 16,  59 => 15,  55 => 14,  52 => 13,  49 => 12,  42 => 9,  39 => 8,  35 => 1,  33 => 6,  31 => 5,  29 => 4,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home.twig", "/var/www/html/resources/views/home.twig");
    }
}
