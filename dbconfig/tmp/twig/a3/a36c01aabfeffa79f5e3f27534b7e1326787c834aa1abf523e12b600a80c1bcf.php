<?php

/* database/designer/page_selector.twig */
class __TwigTemplate_2f4fcd5009eb91833662fb8e9d88057d68d6fcf2cffe4a290913a3f2776831dd extends Twig_Template
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
        echo "<select name=\"selected_page\" id=\"selected_page\">
    <option value=\"0\">-- ";
        // line 2
        echo _gettext("Select page");
        echo " --</option>
    ";
        // line 3
        if (($context["pdfwork"] ?? null)) {
            // line 4
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["pages"] ?? null));
            foreach ($context['_seq'] as $context["nr"] => $context["desc"]) {
                // line 5
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, $context["nr"], "html", null, true);
                echo "\">
                ";
                // line 6
                echo twig_escape_filter($this->env, $context["desc"], "html", null, true);
                echo "
            </option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['nr'], $context['desc'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            echo "    ";
        }
        // line 10
        echo "</select>
";
    }

    public function getTemplateName()
    {
        return "database/designer/page_selector.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 10,  47 => 9,  38 => 6,  33 => 5,  28 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/designer/page_selector.twig", "C:\\wamp64\\apps\\phpmyadmin4.8.3\\templates\\database\\designer\\page_selector.twig");
    }
}
