<?php

/* sign_in.twig */
class __TwigTemplate_fe001b5db0b3aea18b053c6f6d1f23df4f4d514db64c963e23df0226c6137ebe extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width\">
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <script src=\"https://use.fontawesome.com/84658dd2ae.js\"></script>
    <link rel=\"stylesheet\" href=\"/public/css/app.css\">
    <title>Connexion</title>
</head>

<body>
    <div class=\"sign\">
        <form id=\"form\" action=\"/connexion\" method=\"post\">
            Pseudo :
            <input type=\"text\" name=\"pseudo\" required>
            Password :
            <input type=\"password\" name=\"password\" required>
            <input type=\"submit\" value=\"Connexion\">
        </form>
    </div>
</body>

";
    }

    public function getTemplateName()
    {
        return "sign_in.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "sign_in.twig", "/var/www/html/resources/views/sign_in.twig");
    }
}
