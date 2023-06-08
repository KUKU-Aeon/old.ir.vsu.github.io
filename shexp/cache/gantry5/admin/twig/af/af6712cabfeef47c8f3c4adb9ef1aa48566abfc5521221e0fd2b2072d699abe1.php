<?php

/* @gantry-admin/pages/configurations/layouts/container.html.twig */
class __TwigTemplate_4d2cada3a1ae562cd3ccb1aea351fb34db01d621355cbcc42b1c662a51e68a35 extends Twig_Template
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
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/pages/configurations/layouts/container.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = array())
    {
        // line 4
        echo "    <form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["gantry"] ?? null), "route", array(0 => ($context["action"] ?? null)), "method"), "html", null, true);
        echo "\">
        <div class=\"card settings-block\">
            <h4>
                ";
        // line 7
        echo twig_escape_filter($this->env, twig_trim_filter($this->getAttribute(($context["particle"] ?? null), "name", array())), "html", null, true);
        echo "
            </h4>

            <div class=\"inner-params\">
                ";
        // line 11
        $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/pages/configurations/layouts/container.html.twig", 11)->display(array_merge($context, array("overrideable" => false, "blueprints" => $this->getAttribute(($context["particle"] ?? null), "form", array()))));
        // line 12
        echo "            </div>
        </div>

        <div class=\"g-modal-actions\">
            <button class=\"button button-primary\" type=\"submit\">";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY"), "html", null, true);
        echo "</button>
            <button class=\"button button-primary\" data-apply-and-save=\"\">";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY_SAVE"), "html", null, true);
        echo "</button>
            <button class=\"button g5-dialog-close\">";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_CANCEL"), "html", null, true);
        echo "</button>
        </div>
    </form>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/configurations/layouts/container.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 18,  56 => 17,  52 => 16,  46 => 12,  44 => 11,  37 => 7,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gantry-admin/pages/configurations/layouts/container.html.twig", "/var/www/ir.vsu.ru/shexp/administrator/components/com_gantry5/templates/pages/configurations/layouts/container.html.twig");
    }
}
