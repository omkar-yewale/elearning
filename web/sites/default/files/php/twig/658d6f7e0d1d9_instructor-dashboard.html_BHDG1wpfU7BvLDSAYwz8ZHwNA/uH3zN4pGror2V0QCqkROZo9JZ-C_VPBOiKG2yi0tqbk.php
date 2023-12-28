<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/custom_elearning/templates/instructor-dashboard.html.twig */
class __TwigTemplate_494afe6b19f38a41f39b0c674c8f5a6d extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $context["base_url"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("<front>");
        // line 2
        echo "
<table>
\t<thead>
\t\t<th>
\t\t\tStudent Name
\t\t</th>
\t\t<th>
\t\t\tEnrolled course title
\t\t</th>
\t\t<th>
\t\t\tStatus
\t\t</th>
\t\t<th>
\t\t\tProgress
\t\t</th>
\t\t<th>
\t\t\tEnrolled At
\t\t</th>
\t\t<th>
\t\t\tActions
\t\t</th>
\t</thead>
\t<tbody>
\t\t";
        // line 25
        if (twig_test_empty(($context["data"] ?? null))) {
            // line 26
            echo "\t\t\t<tr>
\t\t\t\t<td colspan=\"8\" style=\"text-align:center;\">
\t\t\t\t\tNo Records found.
\t\t\t\t</td>
\t\t\t</tr>
\t\t";
        } else {
            // line 32
            echo "\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["dashboard"]) {
                // line 33
                echo "\t\t\t\t<tr>
\t\t\t\t\t<td>";
                // line 34
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "studentName", [], "any", false, false, true, 34), 34, $this->source), "html", null, true);
                echo "</td>
\t\t\t\t\t<td>";
                // line 35
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "courseTitle", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
                echo "</td>
\t\t\t\t\t<td>";
                // line 36
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "enrollmentStatus", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
                echo " </td>
\t\t\t\t\t<td>";
                // line 37
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "progress", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
                echo " %</td>
\t\t\t\t\t<td>";
                // line 38
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "createdDate", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t";
                // line 40
                if ((twig_get_attribute($this->env, $this->source, $context["dashboard"], "progress", [], "any", false, false, true, 40) == 100)) {
                    // line 41
                    echo "\t\t\t\t\t\t\t<a href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_url"] ?? null), 41, $this->source), "html", null, true);
                    echo "node/";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "courseId", [], "any", false, false, true, 41), 41, $this->source), "html", null, true);
                    echo "?uid=";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "userId", [], "any", false, false, true, 41), 41, $this->source), "html", null, true);
                    echo "\" target=\"_blank\">Add Grade</a>
\t\t\t\t\t\t";
                } else {
                    // line 43
                    echo "\t\t\t\t\t\t\t<a href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_url"] ?? null), 43, $this->source), "html", null, true);
                    echo "node/";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["dashboard"], "courseId", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
                    echo "\" target=\"_blank\">View Course</a>
\t\t\t\t\t\t";
                }
                // line 45
                echo "\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dashboard'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "
\t\t";
        }
        // line 50
        echo "\t</tbody>

</table>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/custom_elearning/templates/instructor-dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 50,  133 => 48,  125 => 45,  117 => 43,  107 => 41,  105 => 40,  100 => 38,  96 => 37,  92 => 36,  88 => 35,  84 => 34,  81 => 33,  76 => 32,  68 => 26,  66 => 25,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% set base_url = url('<front>') %}

<table>
\t<thead>
\t\t<th>
\t\t\tStudent Name
\t\t</th>
\t\t<th>
\t\t\tEnrolled course title
\t\t</th>
\t\t<th>
\t\t\tStatus
\t\t</th>
\t\t<th>
\t\t\tProgress
\t\t</th>
\t\t<th>
\t\t\tEnrolled At
\t\t</th>
\t\t<th>
\t\t\tActions
\t\t</th>
\t</thead>
\t<tbody>
\t\t{% if data is empty %}
\t\t\t<tr>
\t\t\t\t<td colspan=\"8\" style=\"text-align:center;\">
\t\t\t\t\tNo Records found.
\t\t\t\t</td>
\t\t\t</tr>
\t\t{% else %}
\t\t\t{% for dashboard in data %}
\t\t\t\t<tr>
\t\t\t\t\t<td>{{ dashboard.studentName }}</td>
\t\t\t\t\t<td>{{ dashboard.courseTitle }}</td>
\t\t\t\t\t<td>{{ dashboard.enrollmentStatus }} </td>
\t\t\t\t\t<td>{{ dashboard.progress }} %</td>
\t\t\t\t\t<td>{{ dashboard.createdDate }}</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t{% if dashboard.progress == 100 %}
\t\t\t\t\t\t\t<a href=\"{{ base_url }}node/{{ dashboard.courseId }}?uid={{ dashboard.userId }}\" target=\"_blank\">Add Grade</a>
\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t<a href=\"{{ base_url }}node/{{ dashboard.courseId }}\" target=\"_blank\">View Course</a>
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t{% endfor %}

\t\t{% endif %}
\t</tbody>

</table>
", "modules/custom/custom_elearning/templates/instructor-dashboard.html.twig", "C:\\xampp\\htdocs\\elearning\\web\\modules\\custom\\custom_elearning\\templates\\instructor-dashboard.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 1, "if" => 25, "for" => 32);
        static $filters = array("escape" => 34);
        static $functions = array("url" => 1);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['escape'],
                ['url']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
