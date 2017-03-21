<?php

/* layout.twig */
class __TwigTemplate_bc922af5eb0f7ea8c71e50f4f48a8927037b8c8a5ee9da1af908048ceb9ebd52 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width\">
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <link rel=\"stylesheet\" href=\"/public/css/app.css\">
    <link rel=\"stylesheet\" href=\"/public/css/font-awesome.min.css\">
    <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
</head>
    <body>
        <header>
            <nav>
                <div>
                    <i class=\"fa fa-paragraph\" aria-hidden=\"true\"></i>
                </div>
                <div id=\"responsive-menu\">
                    <ul>
                        <li><a href=\"/\">Accueil</a></li>
                        <li><a href=\"/articles\">Articles</a></li>
                    </ul>
                    ";
        // line 22
        $context["session"] = $this->getAttribute(($context["request"] ?? null), "getSession", array(), "method");
        // line 23
        echo "                    ";
        $context["user"] = $this->getAttribute(($context["session"] ?? null), "get", array(0 => "user"), "method");
        // line 24
        echo "                    ";
        if ( !$this->getAttribute(($context["session"] ?? null), "get", array(0 => "user"), "method")) {
            // line 25
            echo "                        <ul>
                            <li><a href=\"/inscription\">Inscription</a></li>
                            <li><a href=\"/connexion\">Connexion</a></li>
                        </ul>
                    ";
        } else {
            // line 30
            echo "                        <ul>
                            <li><span>Bonjour ";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "getPseudo", array(), "method"), "html", null, true);
            echo "</span></li>
                            <li><a href=\"/deconnexion\">Deconnexion</a></li>
                        </ul>
                    ";
        }
        // line 35
        echo "                </div>
                <a href=\"\">
                    <i class=\"fa fa-bars fa-2x\" aria-hidden=\"true\"></i>
                </a>

            </nav>
        </header>

        ";
        // line 43
        $this->displayBlock('content', $context, $blocks);
        // line 44
        echo "
        <footer>
            <div>
                <h5>Plan du site</h5>
                <ul>
                    <li><a href=\"/\">Accueil</a></li>
                    <li><a href=\"/articles\">Articles</a></li>
                    <li><a href=\"/inscription\">Inscription</a></li>
                    <li><a href=\"/connexion\">connexion</a></li>
                </ul>
            </div>
            ";
        // line 55
        if (($this->getAttribute(($context["user"] ?? null), "getRole", array(), "method") == "administrateur")) {
            // line 56
            echo "                <div>
                    <h5>Aller vers</h5>
                    <a href=\"/admin\">Administration</a>
                </div>
            ";
        }
        // line 61
        echo "            <div>
                <h5>Suivez moi</h5>
                <ul>
                    <li><a href=\"#\">Facebook</a></li>
                    <li><a href=\"#\">Twitter</a></li>
                    <li><a href=\"#\">Google Plus</a></li>
                    <li><a href=\"#\">LinkedIn</a></li>
                </ul>
            </div>
        </footer>
        <script src=\"/resources/views/admin/plugins/jQuery/jquery-2.2.3.min.js\"></script>
        <script src=\"/public/js/app.js\"></script>
        ";
        // line 73
        $this->displayBlock('script', $context, $blocks);
        // line 75
        echo "    </body>
</html>";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
    }

    // line 43
    public function block_content($context, array $blocks = array())
    {
    }

    // line 73
    public function block_script($context, array $blocks = array())
    {
        // line 74
        echo "        ";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 74,  138 => 73,  133 => 43,  128 => 9,  123 => 75,  121 => 73,  107 => 61,  100 => 56,  98 => 55,  85 => 44,  83 => 43,  73 => 35,  66 => 31,  63 => 30,  56 => 25,  53 => 24,  50 => 23,  48 => 22,  32 => 9,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.twig", "/var/www/html/resources/views/layout/layout.twig");
    }
}
