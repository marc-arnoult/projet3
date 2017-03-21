<?php

/* articles.twig */
class __TwigTemplate_8dfeda9a9684e6e7abcad10e80483801a9de103eda493ae1f71c7072b44063a3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "    <div class=\"article-container\">
        ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["articles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 3
            echo "            <article class=\"article\">
                <div class=\"round\">
                    <time>
                        ";
            // line 6
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["article"], "created_at", array()), "d M Y"), "html", null, true);
            echo "
                    </time>
                </div>
                <div class=\"info\">
            <span>
                <i class=\"fa fa-comment-o\" aria-hidden=\"true\"></i>
                <strong>";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["commentDAO"] ?? null), "getCountComment", array(0 => $this->getAttribute($context["article"], "id", array())), "method"), "nbComments", array()), "html", null, true);
            echo "</strong>
                commentaires
            </span>
                </div>
                <hr>
                <h2><a href=\"/article/";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "title", array()), "html", null, true);
            echo "</a></h2>
                <div class=\"content\">
                    ";
            // line 19
            echo twig_truncate_filter($this->env, $this->getAttribute($context["article"], "content", array()), 300, true, " ...");
            echo "
                </div>
            </article>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "    </div>";
    }

    public function getTemplateName()
    {
        return "articles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 23,  55 => 19,  48 => 17,  40 => 12,  31 => 6,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "articles.twig", "/var/www/html/resources/views/articles.twig");
    }
}
