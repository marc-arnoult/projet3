<?php

/* layout.admin.twig */
class __TwigTemplate_3ca297d24ae492904763a5a87767eed42509478eb89b08adcc3c99fdc41cc09a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["user"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "getSession", array(), "method"), "get", array(0 => "user"), "method");
        // line 2
        echo "
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
    <!-- Bootstrap 3.3.6 -->
    <link rel=\"stylesheet\" href=\"/resources/views/admin/bootstrap/css/bootstrap.min.css\">
    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css\">
    <!-- Ionicons -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css\">
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"/resources/views/admin/dist/css/AdminLTE.min.css\">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel=\"stylesheet\" href=\"/resources/views/admin/dist/css/skins/skin-blue.min.css\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <script src=\"//cloud.tinymce.com/stable/tinymce.min.js\"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class=\"hold-transition skin-blue sidebar-mini\">

<div class=\"wrapper\">

    <!-- Main Header -->
    <header class=\"main-header\">

        <!-- Logo -->
        <a href=\"/admin\" class=\"logo\">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class=\"logo-mini\"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class=\"logo-lg\"><b>Admin</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class=\"navbar navbar-static-top\" role=\"navigation\">
            <!-- Sidebar toggle button-->
            <a href=\"#\" class=\"sidebar-toggle\" data-toggle=\"offcanvas\" role=\"button\">
                <span class=\"sr-only\">Toggle navigation</span>
            </a>

            <!-- Navbar Right Menu -->
            <div class=\"navbar-custom-menu\">
                <ul class=\"nav navbar-nav\">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->

                    <!-- Tasks Menu -->

                    <!-- User Account Menu -->
                    <li class=\"dropdown user user-menu\">
                        <!-- Menu Toggle Button -->
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                            <!-- The user image in the navbar-->
                            <img src=\"/resources/views/admin/dist/img/user2-160x160.jpg\" class=\"user-image\" alt=\"User Image\">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class=\"hidden-xs\">";
        // line 97
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "getPseudo", array(), "method"), "html", null, true);
        echo "</span>
                        </a>
                        <ul class=\"dropdown-menu\">
                            <!-- The user image in the menu -->
                            <li class=\"user-header\">
                                <img src=\"/resources/views/admin/dist/img/user2-160x160.jpg\" class=\"img-circle\" alt=\"User Image\">

                                <p>
                                    Bonjour ";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "getPseudo", array(), "method"), "html", null, true);
        echo "
                                    <!--<small>Member since Nov. 2012</small>-->
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!--<li class=\"user-body\">
                                <div class=\"row\">
                                    <div class=\"col-xs-4 text-center\">
                                        <a href=\"#\">Followers</a>
                                    </div>
                                    <div class=\"col-xs-4 text-center\">
                                        <a href=\"#\">Sales</a>
                                    </div>
                                    <div class=\"col-xs-4 text-center\">
                                        <a href=\"#\">Friends</a>
                                    </div>
                                </div>
                                /.row
                            </li>
                            <!-- Menu Footer-->
                            <li class=\"user-footer\">
                                <!--<div class=\"pull-left\">
                                    <a href=\"#\" class=\"btn btn-default btn-flat\">Profile</a>
                                </div>-->
                                <div class=\"pull-right\">
                                    <a href=\"/deconnexion\" class=\"btn btn-default btn-flat\">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!--<li>
                        <a href=\"#\" data-toggle=\"control-sidebar\"><i class=\"fa fa-gears\"></i></a>
                    </li>-->
                </ul>
            </div>
        </nav>
    </header>
    <aside class=\"main-sidebar\">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class=\"sidebar\">

            <!-- Sidebar user panel (optional) -->
            <div class=\"user-panel\">
                <div class=\"pull-left image\">
                    <img src=\"/resources/views/admin/dist/img/user2-160x160.jpg\" class=\"img-circle\" alt=\"User Image\">
                </div>
                <div class=\"pull-left info\">
                    <p>";
        // line 154
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "getPseudo", array(), "method"), "html", null, true);
        echo "</p>
                    <!-- Status -->
                    <!--<a href=\"#\"><i class=\"fa fa-circle text-success\"></i> Online</a>-->
                </div>
            </div>

            <!-- search form (Optional) -->
            <!--<form action=\"#\" method=\"get\" class=\"sidebar-form\">
                <div class=\"input-group\">
                    <input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Search...\">
                    <span class=\"input-group-btn\">
                    <button type=\"submit\" name=\"search\" id=\"search-btn\" class=\"btn btn-flat\"><i class=\"fa fa-search\"></i>
                    </button>
                  </span>
                </div>
            </form>-->
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class=\"sidebar-menu\">
                <li class=\"header\">HEADER</li>
                <li>
                    <a href=\"/\">
                        <i class=\"fa fa-map-o\"></i>
                        <span>Aller sur le site</span>
                    </a>
                </li>
                <li class=\"treeview\">
                    <a href=\"#\"><i class=\"fa fa-link\"></i> <span>Articles</span>
                        <span class=\"pull-right-container\">
                            <i class=\"fa fa-angle-left pull-right\"></i>
                        </span>
                    </a>
                    <ul class=\"treeview-menu\">
                        <li><a href=\"/admin/articles\"><i class=\"fa fa-link\"></i><span>Tout les articles</span></a></li>
                        <li><a href=\"/admin/article\"><i class=\"fa fa-link\"></i><span>Ajouter</span></a></li>
                    </ul>
                </li>
                <li class=\"treeview\">
                    <a href=\"#\"><i class=\"fa fa-link\"></i> <span>Commentaires</span>
                        <span class=\"pull-right-container\">
                            <i class=\"fa fa-angle-left pull-right\"></i>
                        </span>
                    </a>
                    <ul class=\"treeview-menu\">
                        <li><a href=\"/admin/comments\"><i class=\"fa fa-link\"></i><span>Tout les commentaires</span></a></li>
                        <li><a href=\"/admin/comments/reported\"><i class=\"fa fa-link\"></i><span>Commentaires signalé</span></a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class=\"content-wrapper\">
        ";
        // line 209
        $this->displayBlock('content', $context, $blocks);
        // line 210
        echo "    </div>
</div>";
    }

    // line 209
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.admin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  247 => 209,  242 => 210,  240 => 209,  182 => 154,  130 => 105,  119 => 97,  22 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.admin.twig", "/var/www/html/resources/views/admin/layout/layout.admin.twig");
    }
}
