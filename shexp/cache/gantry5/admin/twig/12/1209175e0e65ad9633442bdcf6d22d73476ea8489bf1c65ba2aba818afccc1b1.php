<?php

/* @gantry-admin/partials/php_unsupported.html.twig */
class __TwigTemplate_a4e6b7a9ec8c7a0650c191d01705f19efcea78572554855b7e3d3dded64bde46 extends Twig_Template
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
        $context["php_version"] = twig_constant("PHP_VERSION");
        // line 2
        echo "
";
        // line 3
        if ((is_string($__internal_0515d15ef56f14433f942d54dd6b3915d967e2b99349ee2ea7edd02fc80f0537 = ($context["php_version"] ?? null)) && is_string($__internal_22d7a3ca0e0ec32d679751b896ed6b0526e95cac994072e3c50256ce4a0b5d40 = "5.4") && ('' === $__internal_22d7a3ca0e0ec32d679751b896ed6b0526e95cac994072e3c50256ce4a0b5d40 || 0 === strpos($__internal_0515d15ef56f14433f942d54dd6b3915d967e2b99349ee2ea7edd02fc80f0537, $__internal_22d7a3ca0e0ec32d679751b896ed6b0526e95cac994072e3c50256ce4a0b5d40)))) {
            // line 4
            echo "<div class=\"g-grid\">
    <div class=\"g-block alert alert-warning g-php-outdated\">
        ";
            // line 6
            echo $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_PHP54_WARNING", ($context["php_version"] ?? null));
            echo "
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/php_unsupported.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 6,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gantry-admin/partials/php_unsupported.html.twig", "/var/www/ir.vsu.ru/shexp/administrator/components/com_gantry5/templates/partials/php_unsupported.html.twig");
    }
}
