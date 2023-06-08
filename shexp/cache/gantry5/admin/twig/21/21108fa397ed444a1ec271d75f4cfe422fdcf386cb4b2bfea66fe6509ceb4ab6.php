<?php

/* @gantry-admin/pages/configurations/assignments/assignments.html.twig */
class __TwigTemplate_dcb660cfb79efe2632fa7533943d31db34f0a5db3b6a6c1ceac719625cba52b8 extends Twig_Template
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
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/pages/configurations/assignments/assignments.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["edit"] = $this->getAttribute(($context["gantry"] ?? null), "authorize", array(0 => "outline.assign"), "method");
        // line 1
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_gantry($context, array $blocks = array())
    {
        // line 6
        echo "    <div id=\"assignments\">
        ";
        // line 7
        if (($context["assignments"] ?? null)) {
            // line 8
            echo "            <form method=\"post\">
                ";
            // line 9
            if (($context["edit"] ?? null)) {
                // line 10
                echo "                <span class=\"float-right\">
                    <button type=\"submit\" class=\"button button-primary button-save\" data-save=\"Assignments\">
                        <i class=\"fa fa-fw fa-check\" aria-hidden=\"true\"></i> <span>";
                // line 12
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SAVE_ASSIGNMENTS"), "html", null, true);
                echo "</span>
                    </button>
                </span>
                ";
            }
            // line 16
            echo "
                <h2 class=\"page-title\">";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS"), "html", null, true);
            echo "</h2>

                <div class=\"g-filters-bar\">
                    <div class=\"g-panel-filters\" data-g-global-filter=\"\">
                        <div class=\"search settings-block\">
                            <input type=\"text\" placeholder=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_GLOBAL_FILTER_ELI"), "html", null, true);
            echo "\" aria-label=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_GLOBAL_FILTER_ELI"), "html", null, true);
            echo "\" role=\"search\">
                            <i class=\"fa fa-fw fa-search\" aria-hidden=\"true\"></i>
                        </div>
                    </div>
                    <label>
                        <input type=\"checkbox\" data-assignments-enabledonly=\"\" /> ";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS_HIDE_UNASSIGNED"), "html", null, true);
            echo "
                    </label>
                    ";
            // line 29
            if (($context["edit"] ?? null)) {
                // line 30
                echo "                        <a href=\"#\" data-g-assignments-check=\"\"
                           aria-label=\"";
                // line 31
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS_SELECT_ALL"), "html", null, true);
                echo "\"
                           data-tip=\"";
                // line 32
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS_SELECT_ALL"), "html", null, true);
                echo "\"
                           data-tip-place=\"top\">All
                        </a>
                        <a href=\"#\" data-g-assignments-uncheck=\"\"
                           aria-label=\"";
                // line 36
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS_UNSELECT_ALL"), "html", null, true);
                echo "\"
                           data-tip=\"";
                // line 37
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS_UNSELECT_ALL"), "html", null, true);
                echo "\"
                           data-tip-place=\"top\">None
                        </a>
                    ";
            }
            // line 41
            echo "
                    ";
            // line 42
            if (($context["options"] ?? null)) {
                // line 43
                echo "                        <div class=\"pull-right\">
                            ";
                // line 44
                $this->loadTemplate("@gantry-admin/forms/fields/select/selectize.html.twig", "@gantry-admin/pages/configurations/assignments/assignments.html.twig", 44)->display(array("layout" => "input", "name" => "assignments.assignment", "field" => array("type" => "select.selectize", "options" => ($context["options"] ?? null)), "value" => ($context["assignment"] ?? null)));
                // line 45
                echo "                        </div>
                    ";
            }
            // line 47
            echo "                </div>

                <div class=\"cards-wrapper clearfix\">
                    ";
            // line 50
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["assignments"] ?? null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["type"] => $context["types"]) {
                // line 51
                echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["types"]);
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["name"] => $context["list"]) {
                    // line 52
                    echo "                            <div class=\"card settings-block\">
                                <h4>
                                    ";
                    // line 54
                    echo twig_escape_filter($this->env, $this->getAttribute($context["list"], "label", array()), "html", null, true);
                    echo "
                                    <div class=\"g-panel-filters float-right align-right\">
                                        <div class=\"search settings-block\">
                                            <input type=\"text\" placeholder=\"";
                    // line 57
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_FILTER_ELI"), "html", null, true);
                    echo "\" aria-label=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_FILTER_ELI"), "html", null, true);
                    echo "\">
                                            <i class=\"fa fa-fw fa-search\" aria-hidden=\"true\"></i>
                                        </div>
                                        ";
                    // line 60
                    if (($context["edit"] ?? null)) {
                        // line 61
                        echo "                                            <a href=\"#\" data-g-assignments-check=\"\"
                                               aria-label=\"";
                        // line 62
                        echo twig_escape_filter($this->env, (($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SELECT_ALL_MENU") . " in ") . $this->getAttribute($context["list"], "label", array())), "html", null, true);
                        echo "\"
                                               data-tip=\"";
                        // line 63
                        echo twig_escape_filter($this->env, (($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SELECT_ALL_MENU") . " in ") . $this->getAttribute($context["list"], "label", array())), "html", null, true);
                        echo "\"
                                               data-tip-place=\"top\">All
                                            </a>
                                            <a href=\"#\" data-g-assignments-uncheck=\"\"
                                               aria-label=\"";
                        // line 67
                        echo twig_escape_filter($this->env, (($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_UNSELECT_ALL_MENU") . " in ") . $this->getAttribute($context["list"], "label", array())), "html", null, true);
                        echo "\"
                                               data-tip=\"";
                        // line 68
                        echo twig_escape_filter($this->env, (($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_UNSELECT_ALL_MENU") . " in ") . $this->getAttribute($context["list"], "label", array())), "html", null, true);
                        echo "\"
                                               data-tip-place=\"top\">None
                                            </a>
                                        ";
                    }
                    // line 72
                    echo "                                    </div>
                                </h4>

                                <div class=\"settings-param-wrapper\">
                                    ";
                    // line 76
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["list"], "items", array()));
                    $context['loop'] = array(
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    );
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                        // line 77
                        echo "                                        ";
                        $context["path"] = ((((("assignments." . $context["type"]) . ".") . $context["name"]) . ".") . $this->getAttribute($context["link"], "name", array()));
                        // line 78
                        echo "                                        ";
                        $context["group"] = (($this->getAttribute($context["link"], "section", array())) ? ((("data-g-assignments-group=\"" . twig_escape_filter($this->env, $this->getAttribute($context["link"], "name", array()))) . "\"")) : ((("data-g-assignments-parent=\"" . twig_escape_filter($this->env, $this->getAttribute($context["link"], "taxonomy", array()))) . "\"")));
                        // line 79
                        echo "                                        ";
                        $context["value"] = (($this->getAttribute($context["link"], "value", array(), "any", true, true)) ? ($this->getAttribute($context["link"], "value", array())) : ($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", array()), "get", array(0 => ($context["path"] ?? null)), "method")));
                        // line 80
                        echo "                                        <label class=\"settings-param";
                        if ($this->getAttribute($context["link"], "section", array())) {
                            echo " settings-param-section";
                        }
                        echo "\" ";
                        echo ($context["group"] ?? null);
                        echo ">
                                            ";
                        // line 81
                        $this->loadTemplate("forms/fields/enable/enable.html.twig", "@gantry-admin/pages/configurations/assignments/assignments.html.twig", 81)->display(array_merge($context, array("default" => true, "name" => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->fieldNameFilter(                        // line 83
($context["path"] ?? null)), "field" => $this->getAttribute(                        // line 84
$context["link"], "field", array()), "value" =>                         // line 85
($context["value"] ?? null), "disabled" =>  !                        // line 86
($context["value"] ?? null), "turned_off" => $this->getAttribute(                        // line 87
$context["link"], "disabled", array()), "title" => (("'" . $this->getAttribute(                        // line 88
$context["link"], "label", array())) . "' Menu Item"))));
                        // line 90
                        echo "                                            <span class=\"settings-param-title";
                        if ($this->getAttribute($context["link"], "section", array())) {
                            echo " settings-param-section-title";
                        }
                        echo "\">";
                        // line 91
                        echo twig_escape_filter($this->env, $this->getAttribute($context["link"], "label", array()), "html", null, true);
                        // line 92
                        echo "</span>
                                        </label>
                                    ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 95
                    echo "                                </div>
                            </div>
                        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['name'], $context['list'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 98
                echo "                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['types'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "                </div>

                ";
            // line 101
            if (($context["edit"] ?? null)) {
                // line 102
                echo "                <div class=\"g-footer-actions\">
                    <span class=\"float-right\">
                        <button type=\"submit\" class=\"button button-primary button-save\" data-save=\"";
                // line 104
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS"), "html", null, true);
                echo "\">
                            <i class=\"fa fa-fw fa-check\" aria-hidden=\"true\"></i> <span>";
                // line 105
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SAVE_ASSIGNMENTS"), "html", null, true);
                echo "</span>
                        </button>
                    </span>
                </div>
                ";
            }
            // line 110
            echo "                <input type=\"hidden\" name=\"_end\" value=\"1\" />
            </form>
        ";
        } else {
            // line 113
            echo "            <h2 class=\"page-title\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGNMENTS"), "html", null, true);
            echo "</h2>
            ";
            // line 114
            if ((($context["configuration"] ?? null) == "default")) {
                // line 115
                echo "                <p>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ASSIGN_BASE_DESC"), "html", null, true);
                echo "</p>
            ";
            } else {
                // line 117
                echo "                <p>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_NO_ASSIGNMENTS_DESC"), "html", null, true);
                echo "</p>
            ";
            }
            // line 119
            echo "        ";
        }
        // line 120
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/configurations/assignments/assignments.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  358 => 120,  355 => 119,  349 => 117,  343 => 115,  341 => 114,  336 => 113,  331 => 110,  323 => 105,  319 => 104,  315 => 102,  313 => 101,  309 => 99,  295 => 98,  279 => 95,  263 => 92,  261 => 91,  255 => 90,  253 => 88,  252 => 87,  251 => 86,  250 => 85,  249 => 84,  248 => 83,  247 => 81,  238 => 80,  235 => 79,  232 => 78,  229 => 77,  212 => 76,  206 => 72,  199 => 68,  195 => 67,  188 => 63,  184 => 62,  181 => 61,  179 => 60,  171 => 57,  165 => 54,  161 => 52,  143 => 51,  126 => 50,  121 => 47,  117 => 45,  115 => 44,  112 => 43,  110 => 42,  107 => 41,  100 => 37,  96 => 36,  89 => 32,  85 => 31,  82 => 30,  80 => 29,  75 => 27,  65 => 22,  57 => 17,  54 => 16,  47 => 12,  43 => 10,  41 => 9,  38 => 8,  36 => 7,  33 => 6,  30 => 5,  26 => 1,  24 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gantry-admin/pages/configurations/assignments/assignments.html.twig", "/var/www/ir.vsu.ru/shexp/administrator/components/com_gantry5/templates/pages/configurations/assignments/assignments.html.twig");
    }
}
