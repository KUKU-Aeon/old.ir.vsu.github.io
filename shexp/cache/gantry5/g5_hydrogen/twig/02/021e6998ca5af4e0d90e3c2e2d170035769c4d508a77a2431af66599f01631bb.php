<?php

/* @particles/module.html.twig */
class __TwigTemplate_f8654ffac4d98ac4fe40c059b3c3958cab3510a0cc459d5feef4512d4b55aada extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/module.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        echo $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", array()), "displayModule", array(0 => $this->getAttribute(($context["particle"] ?? null), "module_id", array()), 1 => array("style" => (($this->getAttribute(($context["particle"] ?? null), "chrome", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "chrome", array()), "gantry")) : ("gantry")), "position" => "particle")), "method");
        echo "
";
    }

    public function getTemplateName()
    {
        return "@particles/module.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/module.html.twig", "/var/www/ir.vsu.ru/shexp/media/gantry5/engines/nucleus/particles/module.html.twig");
    }
}
