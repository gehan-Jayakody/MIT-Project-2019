<?php

/* database/designer/database_tables.twig */
class __TwigTemplate_0dd1870b103a72469e675e820306089a41efd95842ec26a27aa5ca149a4245b2 extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(0, (twig_length_filter($this->env, ($context["table_names"] ?? null)) - 1)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 2
            echo "    ";
            $context["t_n"] = $this->getAttribute(($context["table_names"] ?? null), $context["i"], array(), "array");
            // line 3
            echo "    ";
            $context["t_n_url"] = $this->getAttribute(($context["table_names_url"] ?? null), $context["i"], array(), "array");
            // line 4
            echo "    <input name=\"t_x[";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_x_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <input name=\"t_y[";
            // line 5
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_y_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <input name=\"t_v[";
            // line 6
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_v_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <input name=\"t_h[";
            // line 7
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_h_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <table id=\"";
            // line 8
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
        cellpadding=\"0\"
        cellspacing=\"0\"
        class=\"designer_tab\"
        style=\"position:absolute; left:";
            // line 13
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array"), "X", array(), "array")) : (twig_random($this->env, range(20, 700)))), "html", null, true);
            echo "px; top:";
            // line 14
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array"), "Y", array(), "array")) : (twig_random($this->env, range(20, 550)))), "html", null, true);
            echo "px; display:";
            // line 15
            echo ((($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array", true, true) || (($context["display_page"] ?? null) ==  -1))) ? ("block") : ("none"));
            echo "; z-index: 1;\">
        <thead>
            <tr class=\"header\">
                ";
            // line 18
            if (($context["has_query"] ?? null)) {
                // line 19
                echo "                    <td class=\"select_all\">
                        <input class=\"select_all_1\"
                            type=\"checkbox\"
                            style=\"margin: 0;\"
                            value=\"select_all_";
                // line 23
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "\"
                            id=\"select_all_";
                // line 24
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "\"
                            title=\"select all\"
                            designer_url_table_name=\"";
                // line 26
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "\"
                            designer_out_owner=\"";
                // line 27
                echo $this->getAttribute(($context["owner_out"] ?? null), $context["i"], array(), "array");
                echo "\">
                    </td>
                ";
            }
            // line 30
            echo "                <td class=\"small_tab\"
                    title=\"";
            // line 31
            echo _gettext("Show/hide columns");
            echo "\"
                    id=\"id_hide_tbody_";
            // line 32
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
                    table_name=\"";
            // line 33
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\">
                    ";
            // line 34
            echo ((( !$this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array", true, true) ||  !twig_test_empty($this->getAttribute($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array"), "V", array(), "array")))) ? ("v") : ("&gt;"));
            echo "
                </td>
                <td class=\"small_tab_pref small_tab_pref_1\"
                    table_name_small=\"";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute(($context["table_names_small_url"] ?? null), $context["i"], array(), "array"), "html", null, true);
            echo "\">
                    <img src=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute(($context["theme"] ?? null), "getImgPath", array(0 => "designer/exec_small.png"), "method"), "html", null, true);
            echo "\"
                        title=\"";
            // line 39
            echo _gettext("See table structure");
            echo "\" />
                </td>
                <td id=\"id_zag_";
            // line 41
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
                    class=\"tab_zag nowrap tab_zag_noquery\"
                    table_name=\"";
            // line 43
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
                    query_set=\"";
            // line 44
            echo ((($context["has_query"] ?? null)) ? (1) : (0));
            echo "\">
                    <span class=\"owner\">
                        ";
            // line 46
            echo $this->getAttribute(($context["owner_out"] ?? null), $context["i"], array(), "array");
            echo "
                    </span>
                    ";
            // line 48
            echo $this->getAttribute(($context["table_names_small_out"] ?? null), $context["i"], array(), "array");
            echo "
                </td>
                ";
            // line 50
            if (($context["has_query"] ?? null)) {
                // line 51
                echo "                    <td class=\"tab_zag tab_zag_query\"
                        id=\"id_zag_";
                // line 52
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "_2\"
                        table_name=\"";
                // line 53
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "\">
                    </td>
               ";
            }
            // line 56
            echo "            </tr>
        </thead>
        <tbody id=\"id_tbody_";
            // line 58
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"";
            // line 59
            echo ((($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array", true, true) && twig_test_empty($this->getAttribute($this->getAttribute(($context["tab_pos"] ?? null), ($context["t_n"] ?? null), array(), "array"), "V", array(), "array")))) ? (" style=\"display: none\"") : (""));
            echo ">
            ";
            // line 60
            $context["display_field"] = call_user_func_array($this->env->getFunction('Relation_getDisplayField')->getCallable(), array(($context["get_db"] ?? null), $this->getAttribute(($context["table_names_small"] ?? null), $context["i"], array(), "array")));
            // line 61
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(0, (twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_ID", array(), "array")) - 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                // line 62
                echo "                ";
                $context["tmp_column"] = ((($context["t_n"] ?? null) . ".") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array"));
                // line 63
                echo "                ";
                $context["click_field_param"] = array(0 => $this->getAttribute(                // line 64
($context["table_names_small_url"] ?? null), $context["i"], array(), "array"), 1 => twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(                // line 65
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")));
                // line 67
                echo "                ";
                if ( !PhpMyAdmin\Util::isForeignKeySupported($this->getAttribute(($context["table_types"] ?? null), $context["i"], array(), "array"))) {
                    // line 68
                    echo "                    ";
                    $context["click_field_param"] = twig_array_merge(($context["click_field_param"] ?? null), array(0 => (($this->getAttribute(($context["tables_pk_or_unique_keys"] ?? null), ($context["tmp_column"] ?? null), array(), "array", true, true)) ? (1) : (0))));
                    // line 69
                    echo "                ";
                } else {
                    // line 70
                    echo "                    ";
                    // line 72
                    echo "                    ";
                    $context["click_field_param"] = twig_array_merge(($context["click_field_param"] ?? null), array(0 => (($this->getAttribute(($context["tables_all_keys"] ?? null), ($context["tmp_column"] ?? null), array(), "array", true, true)) ? (1) : (0))));
                    // line 73
                    echo "                ";
                }
                // line 74
                echo "                ";
                $context["click_field_param"] = twig_array_merge(($context["click_field_param"] ?? null), array(0 => ($context["db"] ?? null)));
                // line 75
                echo "                <tr id=\"id_tr_";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["table_names_small_url"] ?? null), $context["i"], array(), "array"), "html", null, true);
                echo ".";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array"), "html", null, true);
                echo "\" class=\"tab_field";
                // line 76
                echo (((($context["display_field"] ?? null) == $this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array"))) ? ("_3") : (""));
                echo "\" click_field_param=\"";
                // line 77
                echo twig_escape_filter($this->env, twig_join_filter(($context["click_field_param"] ?? null), ","), "html", null, true);
                echo "\">
                    ";
                // line 78
                if (($context["has_query"] ?? null)) {
                    // line 79
                    echo "                        <td class=\"select_all\">
                            <input class=\"select_all_store_col\"
                                value=\"";
                    // line 81
                    echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), "html", null, true);
                    echo "\"
                                type=\"checkbox\"
                                id=\"select_";
                    // line 83
                    echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                    echo "._";
                    echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), "html", null, true);
                    echo "\"
                                style=\"margin: 0;\"
                                title=\"select_";
                    // line 85
                    echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), "html", null, true);
                    echo "\"
                                store_column_param=\"";
                    // line 86
                    echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute(($context["table_names_small_out"] ?? null), $context["i"], array(), "array")), "html", null, true);
                    echo ",";
                    // line 87
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["owner_out"] ?? null), $context["i"], array(), "array"), "html", null, true);
                    echo ",";
                    // line 88
                    echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), "html", null, true);
                    echo "\">
                        </td>
                    ";
                }
                // line 91
                echo "                    <td width=\"10px\" colspan=\"3\" id=\"";
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo ".";
                // line 92
                echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), "html", null, true);
                echo "\">
                        <div class=\"nowrap\">
                            ";
                // line 94
                if ($this->getAttribute(($context["tables_pk_or_unique_keys"] ?? null), ((($context["t_n"] ?? null) . ".") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), array(), "array", true, true)) {
                    // line 95
                    echo "                                <img src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["theme"] ?? null), "getImgPath", array(0 => "designer/FieldKey_small.png"), "method"), "html", null, true);
                    echo "\" alt=\"*\" />
                            ";
                } else {
                    // line 97
                    echo "                                ";
                    $context["type"] = "designer/Field_small";
                    // line 98
                    echo "                                ";
                    if ((strstr($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "char") || strstr($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 99
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "text"))) {
                        // line 100
                        echo "                                    ";
                        $context["type"] = (($context["type"] ?? null) . "_char");
                        // line 101
                        echo "                                ";
                    } elseif ((((strstr($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "int") || strstr($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 102
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "float")) || strstr($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 103
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "double")) || strstr($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 104
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "decimal"))) {
                        // line 105
                        echo "                                    ";
                        $context["type"] = (($context["type"] ?? null) . "_int");
                        // line 106
                        echo "                                ";
                    } elseif (((strstr($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "date") || strstr($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 107
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "time")) || strstr($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 108
($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "year"))) {
                        // line 109
                        echo "                                    ";
                        $context["type"] = (($context["type"] ?? null) . "_date");
                        // line 110
                        echo "                                ";
                    }
                    // line 111
                    echo "                                <img src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["theme"] ?? null), "getImgPath", array(0 => ($context["type"] ?? null)), "method"), "html", null, true);
                    echo ".png\" alt=\"*\" />
                            ";
                }
                // line 113
                echo "                            ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array"), "html", null, true);
                echo " : ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "TYPE", array(), "array"), $context["j"], array(), "array"), "html", null, true);
                echo "
                        </div>
                    </td>
                    ";
                // line 116
                if (($context["has_query"] ?? null)) {
                    // line 117
                    echo "                        <td class=\"small_tab_pref small_tab_pref_click_opt\"
                            click_option_param=\"designer_optionse,";
                    // line 119
                    echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["tab_column"] ?? null), ($context["t_n"] ?? null), array(), "array"), "COLUMN_NAME", array(), "array"), $context["j"], array(), "array")), "html", null, true);
                    echo ",";
                    // line 120
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["table_names_small_out"] ?? null), $context["i"], array(), "array"), "html", null, true);
                    echo "\">
                            <img src=\"";
                    // line 121
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["theme"] ?? null), "getImgPath", array(0 => "designer/exec_small.png"), "method"), "html", null, true);
                    echo "\" title=\"options\" />
                        </td>
                    ";
                }
                // line 124
                echo "                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 126
            echo "        </tbody>
    </table>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "database/designer/database_tables.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 126,  347 => 124,  341 => 121,  337 => 120,  334 => 119,  331 => 117,  329 => 116,  320 => 113,  314 => 111,  311 => 110,  308 => 109,  306 => 108,  305 => 107,  303 => 106,  300 => 105,  298 => 104,  297 => 103,  296 => 102,  294 => 101,  291 => 100,  289 => 99,  287 => 98,  284 => 97,  278 => 95,  276 => 94,  271 => 92,  267 => 91,  261 => 88,  258 => 87,  255 => 86,  251 => 85,  244 => 83,  238 => 81,  234 => 79,  232 => 78,  228 => 77,  225 => 76,  219 => 75,  216 => 74,  213 => 73,  210 => 72,  208 => 70,  205 => 69,  202 => 68,  199 => 67,  197 => 65,  196 => 64,  194 => 63,  191 => 62,  186 => 61,  184 => 60,  180 => 59,  177 => 58,  173 => 56,  167 => 53,  163 => 52,  160 => 51,  158 => 50,  153 => 48,  148 => 46,  143 => 44,  139 => 43,  134 => 41,  129 => 39,  125 => 38,  121 => 37,  115 => 34,  111 => 33,  107 => 32,  103 => 31,  100 => 30,  94 => 27,  90 => 26,  85 => 24,  81 => 23,  75 => 19,  73 => 18,  67 => 15,  64 => 14,  61 => 13,  54 => 8,  48 => 7,  42 => 6,  36 => 5,  29 => 4,  26 => 3,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/designer/database_tables.twig", "C:\\wamp64\\apps\\phpmyadmin4.8.3\\templates\\database\\designer\\database_tables.twig");
    }
}
