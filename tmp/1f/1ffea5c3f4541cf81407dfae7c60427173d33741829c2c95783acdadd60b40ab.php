<?php

/* admin/index.twig */
class __TwigTemplate_5e17bf9f83e28f1e11a7a7862f3571a55000adc93213165299f2ffa1fcf62109 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.admin.twig", "admin/index.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.admin.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        $context["messagesAll"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "messages"), "method");
        // line 4
        echo "    ";
        $context["nbUser"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "nbUser"), "method");
        // line 5
        echo "    ";
        $context["nbArticle"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "attributes", array()), "get", array(0 => "nbArticle"), "method");
        // line 6
        echo "<!-- Left side column. contains the logo and sidebar -->
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messagesAll"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["messages"]) {
            // line 10
            echo "        <div class=\"alert alert-";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">
            ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 12
                echo "                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
                <span class=\"alert-text\">";
                // line 15
                echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                echo "</span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "    <section class=\"content-header\">
        <h1>
            Administration
        </h1>
        <!--<ol class=\"breadcrumb\">
          <li><a href=\"#\"><i class=\"fa fa-dashboard\"></i> Level</a></li>
          <li class=\"active\">Here</li>
        </ol>-->
    </section>

    <!-- Main content -->
    <section class=\"content\">
        <div class=\"col-lg-3 col-xs-6\">
            <!-- small box -->
            <div class=\"small-box bg-yellow\">
                <div class=\"inner\">
                    <h3>";
        // line 35
        echo twig_escape_filter($this->env, ($context["nbUser"] ?? null), "html", null, true);
        echo "</h3>

                    <p>Utilisateurs inscrits</p>
                </div>
                <div class=\"icon\">
                    <i class=\"ion ion-person-add\"></i>
                </div>
                <a href=\"#\" class=\"small-box-footer\">
                    Plus d'infos <i class=\"fa fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>
        <!-- Your Page Content Here -->
        <div class=\"col-lg-3 col-xs-6\">
            <!-- small box -->
            <div class=\"small-box bg-green\">
                <div class=\"inner\">
                    <h3>";
        // line 52
        echo twig_escape_filter($this->env, ($context["nbArticle"] ?? null), "html", null, true);
        echo "</h3>

                    <p>Article écrit</p>
                </div>
                <div class=\"icon\">
                    <i class=\" fa fa-edit\"></i>
                </div>
                <a href=\"/admin/articles\" class=\"small-box-footer\">
                    Plus d'infos <i class=\"fa fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class=\"main-footer\">
    <!-- To the right -->
    <div class=\"pull-right hidden-xs\">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href=\"#\">Company</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class=\"control-sidebar control-sidebar-dark\">
    <!-- Create the tabs -->
    <ul class=\"nav nav-tabs nav-justified control-sidebar-tabs\">
        <li class=\"active\"><a href=\"#control-sidebar-home-tab\" data-toggle=\"tab\"><i class=\"fa fa-home\"></i></a></li>
        <li><a href=\"#control-sidebar-settings-tab\" data-toggle=\"tab\"><i class=\"fa fa-gears\"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class=\"tab-content\">
        <!-- Home tab content -->
        <div class=\"tab-pane active\" id=\"control-sidebar-home-tab\">
            <h3 class=\"control-sidebar-heading\">Recent Activity</h3>
            <ul class=\"control-sidebar-menu\">
                <li>
                    <a href=\"javascript:;\">
                        <i class=\"menu-icon fa fa-birthday-cake bg-red\"></i>

                        <div class=\"menu-info\">
                            <h4 class=\"control-sidebar-subheading\">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class=\"control-sidebar-heading\">Tasks Progress</h3>
            <ul class=\"control-sidebar-menu\">
                <li>
                    <a href=\"javascript:;\">
                        <h4 class=\"control-sidebar-subheading\">
                            Custom Template Design
                            <span class=\"pull-right-container\">
                  <span class=\"label label-danger pull-right\">70%</span>
                </span>
                        </h4>

                        <div class=\"progress progress-xxs\">
                            <div class=\"progress-bar progress-bar-danger\" style=\"width: 70%\"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <!-- /.tab-pane -->
     </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src=\"resources/views/admin/plugins/jQuery/jquery-2.2.3.min.js\"></script>
<!-- Bootstrap 3.3.6 -->
<script src=\"resources/views/admin/bootstrap/js/bootstrap.min.js\"></script>
<!-- AdminLTE App -->
<script src=\"resources/views/admin/dist/js/app.min.js\"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
";
    }

    public function getTemplateName()
    {
        return "admin/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 52,  96 => 35,  78 => 19,  71 => 17,  63 => 15,  58 => 12,  54 => 11,  49 => 10,  45 => 9,  40 => 6,  37 => 5,  34 => 4,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/index.twig", "/var/www/html/resources/views/admin/index.twig");
    }
}
