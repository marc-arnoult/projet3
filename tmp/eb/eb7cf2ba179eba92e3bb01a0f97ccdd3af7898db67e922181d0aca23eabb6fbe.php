<?php

/* articles_list.twig */
class __TwigTemplate_5f91e98feecaaa28fbd4bdb5f71610395aa1bad1be692b34326f9a9a25b6a00a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "articles_list.twig", 1);
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        echo "Jean Forteroche";
        echo "
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "
    ";
        // line 9
        $context["articles"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "articles"), "method");
        // line 10
        echo "    ";
        $context["commentDAO"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "commentDAO"), "method");
        // line 11
        echo "    ";
        $context["articlesByDates"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "articlesByDates"), "method");
        // line 12
        echo "
    <section id=\"articles-list\">
        <h1>Tous les articles</h1>
        ";
        // line 15
        $this->loadTemplate("articles_list.twig", "articles_list.twig", 15, "857015525")->display($context);
        // line 17
        echo "    </section>
    <aside id=\"info-box\">
        <h4>Suivez moi</h4>
            <ul id=\"social-network\">
                <li><a href=\"#\"><i class=\"fa fa-facebook-square fa-2x\"></i></a></li>
                <li><a href=\"#\"><i class=\"fa fa-twitter-square fa-2x\"></i></a></li>
                <li><a href=\"#\"><i class=\"fa fa-google-plus-square fa-2x\"></i></a></li>
                <li><a href=\"#\"><i class=\"fa fa-linkedin-square fa-2x\"></i></a></li>
            </ul>
        <div>
            <h4>Mes articles</h4>
            <ul id=\"nav-articles\">
            ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["articlesByDates"] ?? null));
        foreach ($context['_seq'] as $context["year"] => $context["articlesByYear"]) {
            // line 30
            echo "                <li><a href=\"#\" class=\"toggleSubMenu\">";
            echo twig_escape_filter($this->env, $context["year"], "html", null, true);
            echo "</a></li>
                <ul class=\"subMenu\">
                    ";
            // line 32
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["articlesByYear"]);
            foreach ($context['_seq'] as $context["month"] => $context["articlesByMonth"]) {
                // line 33
                echo "                        <li><a href=\"#\" class=\"toggleSubMenu\">";
                echo twig_escape_filter($this->env, $context["month"], "html", null, true);
                echo "</a></li>
                        <ul class=\"subMenu\">
                            ";
                // line 35
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["articlesByMonth"]);
                foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                    // line 36
                    echo "                                <li><a href=\"/article/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "title", array()), "html", null, true);
                    echo "</a></li>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 38
                echo "                        </ul>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['month'], $context['articlesByMonth'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "                </ul>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['year'], $context['articlesByYear'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "            </ul>
        </div>
    </aside>

";
    }

    // line 47
    public function block_script($context, array $blocks = array())
    {
        // line 48
        echo "    <script>
        \$(function () {
            \$('.subMenu').hide();

            \$('li a.toggleSubMenu').click(function (e) {
                e.preventDefault();

                \$(this).parent().next().toggle(400);
            })
        })
    </script>
";
    }

    public function getTemplateName()
    {
        return "articles_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 48,  132 => 47,  124 => 42,  117 => 40,  110 => 38,  99 => 36,  95 => 35,  89 => 33,  85 => 32,  79 => 30,  75 => 29,  61 => 17,  59 => 15,  54 => 12,  51 => 11,  48 => 10,  46 => 9,  43 => 8,  40 => 7,  33 => 4,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "articles_list.twig", "/var/www/html/resources/views/articles_list.twig");
    }
}


/* articles_list.twig */
class __TwigTemplate_5f91e98feecaaa28fbd4bdb5f71610395aa1bad1be692b34326f9a9a25b6a00a_857015525 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 15
        $this->parent = $this->loadTemplate("articles.twig", "articles_list.twig", 15);
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
        return "articles_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 15,  135 => 48,  132 => 47,  124 => 42,  117 => 40,  110 => 38,  99 => 36,  95 => 35,  89 => 33,  85 => 32,  79 => 30,  75 => 29,  61 => 17,  59 => 15,  54 => 12,  51 => 11,  48 => 10,  46 => 9,  43 => 8,  40 => 7,  33 => 4,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "articles_list.twig", "/var/www/html/resources/views/articles_list.twig");
    }
}
