<?php

/* server/engines/engine.twig */
class __TwigTemplate_ef8595a58f42b29f89c812aca02f227e6ee0f0b330282605abe8c2e0f6a6f2d5 extends Twig_Template
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
        echo "<h2>
    ";
        // line 2
        echo PhpMyAdmin\Util::getImage("b_engine");
        echo "
    ";
        // line 3
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "
    ";
        // line 4
        echo PhpMyAdmin\Util::showMySQLDocu(($context["help_page"] ?? null));
        echo "
</h2>
<p><em>";
        // line 6
        echo twig_escape_filter($this->env, ($context["comment"] ?? null), "html", null, true);
        echo "</em></p>

";
        // line 8
        if (( !twig_test_empty(($context["info_pages"] ?? null)) && twig_test_iterable(($context["info_pages"] ?? null)))) {
            // line 9
            echo "    <p>
        <strong>[</strong>
            ";
            // line 11
            if (twig_test_empty(($context["page"] ?? null))) {
                // line 12
                echo "                <strong>";
                echo _gettext("Variables");
                echo "</strong>
            ";
            } else {
                // line 14
                echo "                <a href=\"server_engines.php";
                // line 15
                echo PhpMyAdmin\Url::getCommon(array("engine" => ($context["engine"] ?? null)));
                echo "\">
                    ";
                // line 16
                echo _gettext("Variables");
                // line 17
                echo "                </a>
            ";
            }
            // line 19
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["info_pages"] ?? null));
            foreach ($context['_seq'] as $context["current"] => $context["label"]) {
                // line 20
                echo "                <strong>|</strong>
                ";
                // line 21
                if (((isset($context["page"]) || array_key_exists("page", $context)) && (($context["page"] ?? null) == $context["current"]))) {
                    // line 22
                    echo "                    <strong>";
                    echo twig_escape_filter($this->env, $context["label"], "html", null, true);
                    echo "</strong>
                ";
                } else {
                    // line 24
                    echo "                    <a href=\"server_engines.php";
                    // line 25
                    echo PhpMyAdmin\Url::getCommon(array("engine" => ($context["engine"] ?? null), "page" => $context["current"]));
                    echo "\">
                        ";
                    // line 26
                    echo twig_escape_filter($this->env, $context["label"], "html", null, true);
                    echo "
                    </a>
                ";
                }
                // line 29
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['current'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 30
            echo "        <strong>]</strong>
    </p>
";
        }
        // line 33
        echo "
";
        // line 34
        if ( !twig_test_empty(($context["page_output"] ?? null))) {
            // line 35
            echo "    ";
            echo ($context["page_output"] ?? null);
            echo "
";
        } else {
            // line 37
            echo "    <p>";
            echo twig_escape_filter($this->env, ($context["support"] ?? null), "html", null, true);
            echo "</p>
    ";
            // line 38
            echo ($context["variables"] ?? null);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "server/engines/engine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 38,  116 => 37,  110 => 35,  108 => 34,  105 => 33,  100 => 30,  94 => 29,  88 => 26,  84 => 25,  82 => 24,  76 => 22,  74 => 21,  71 => 20,  66 => 19,  62 => 17,  60 => 16,  56 => 15,  54 => 14,  48 => 12,  46 => 11,  42 => 9,  40 => 8,  35 => 6,  30 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "server/engines/engine.twig", "C:\\wamp64\\apps\\phpmyadmin4.8.3\\templates\\server\\engines\\engine.twig");
    }
}
