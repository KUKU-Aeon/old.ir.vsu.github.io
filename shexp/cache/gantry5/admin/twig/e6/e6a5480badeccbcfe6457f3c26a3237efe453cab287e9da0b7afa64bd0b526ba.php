<?php

/* @gantry-admin/pages/about/about.html.twig */
class __TwigTemplate_4ec78e7cfca5290b532e61cf1206169b4d3d430110b9c07f0755c19b49479067 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'gantry' => array($this, 'block_gantry'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/pages/about/about.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"g-grid overview-header\">
        <div class=\"g-block\">
            <h2 class=\"theme-title\">
                ";
        // line 7
        if ($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "icon", array())) {
            echo "<i class=\"fa fa-";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "icon", array()), "html", null, true);
            echo "\" aria-hidden=\"true\"></i>";
        }
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "title", array()), "html", null, true);
        echo "
            </h2>
            <span class=\"theme-version\">v";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "version", array()), "html", null, true);
        echo "</span>
            <div>By <a href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "author", array()), "link", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "author", array()), "name", array()), "html", null, true);
        echo "</a></div>
        </div>
        <div class=\"g-block\">
            <span class=\"float-right\">
                <button class=\"button button-back-to-conf\"><i class=\"fa fa-fw fa-arrow-left\" aria-hidden=\"true\"></i> <span>Back to Setup</span></button>
                <a href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "support", array()), "link", array()), "html", null, true);
        echo "\" class=\"button button-primary\"><i class=\"fa fa-support\" aria-hidden=\"true\"></i> <span>Support</span></a>
                <a href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", array()), "documentation", array()), "link", array()), "html", null, true);
        echo "\" class=\"button button-primary\"><i class=\"fa fa-book\" aria-hidden=\"true\"></i> <span>Documentation</span></a>
            </span>
        </div>
    </div>

    <div class=\"g-grid overview-details\">
        <div class=\"g-block size-35\">
             <img src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute(($context["info"] ?? null), "thumbnail", array())), "html", null, true);
        echo "\" class=\"preview-image\" alt=\"\">
        </div>

        <div class=\"g-block\">
            <p>Helium is a beautiful, free theme made by the RocketTheme team in appreciation of the incredible Gantry community.</p>
            <ul class=\"overview-list\">
                <li><i class=\"fa fa-asterisk\" aria-hidden=\"true\"></i>OwlCarousel</li>
                <li><i class=\"fa fa-asterisk\" aria-hidden=\"true\"></i>Content Cubes</li>
                <li><i class=\"fa fa-asterisk\" aria-hidden=\"true\"></i>Content Tabs</li>
            </ul>
        </div>
    </div>

    ";
        // line 36
        $this->loadTemplate("@gantry-admin/partials/gantry-details.html.twig", "@gantry-admin/pages/about/about.html.twig", 36)->display($context);
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/about/about.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 36,  74 => 23,  64 => 16,  60 => 15,  50 => 10,  46 => 9,  35 => 7,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gantry-admin/pages/about/about.html.twig", "/var/www/ir.vsu.ru/shexp/templates/g5_helium/admin/templates/pages/about/about.html.twig");
    }
}
