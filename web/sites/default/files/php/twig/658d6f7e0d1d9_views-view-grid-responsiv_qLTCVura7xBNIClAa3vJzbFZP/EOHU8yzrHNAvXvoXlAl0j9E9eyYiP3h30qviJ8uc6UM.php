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

/* core/modules/views/templates/views-view-grid-responsive.html.twig */
class __TwigTemplate_1c31341eda1b819c939a082c524a5d98 extends Template
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
        // line 27
        echo "
";
        // line 28
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("views/views.responsive-grid"), "html", null, true);
        echo "

";
        // line 31
        $context["classes"] = [0 => "views-view-responsive-grid", 1 => ("views-view-responsive-grid--" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 33
($context["options"] ?? null), "alignment", [], "any", false, false, true, 33), 33, $this->source))];
        // line 36
        echo "
";
        // line 37
        $context["responsive_grid_styles"] = [0 => (("--views-responsive-grid--column-count:" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 38
($context["options"] ?? null), "columns", [], "any", false, false, true, 38), 38, $this->source)) . ";"), 1 => (("--views-responsive-grid--cell-min-width:" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 39
($context["options"] ?? null), "cell_min_width", [], "any", false, false, true, 39), 39, $this->source)) . "px;"), 2 => (("--views-responsive-grid--layout-gap:" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 40
($context["options"] ?? null), "grid_gutter", [], "any", false, false, true, 40), 40, $this->source)) . "px;")];
        // line 43
        echo "
";
        // line 44
        if (($context["title"] ?? null)) {
            // line 45
            echo "  <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 45, $this->source), "html", null, true);
            echo "</h3>
";
        }
        // line 47
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 47), "setAttribute", [0 => "style", 1 => twig_join_filter($this->sandbox->ensureToStringAllowed(($context["responsive_grid_styles"] ?? null), 47, $this->source))], "method", false, false, true, 47), 47, $this->source), "html", null, true);
        echo ">
  ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 49
            echo "    <div class=\"views-view-responsive-grid__item\">
      <div class=\"views-view-responsive-grid__item-inner\">";
            // line 51
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, true, 51), 51, $this->source), "html", null, true);
            // line 52
            echo "</div>
    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/views/templates/views-view-grid-responsive.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 55,  83 => 52,  81 => 51,  78 => 49,  74 => 48,  69 => 47,  63 => 45,  61 => 44,  58 => 43,  56 => 40,  55 => 39,  54 => 38,  53 => 37,  50 => 36,  48 => 33,  47 => 31,  42 => 28,  39 => 27,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for views to display rows in a responsive grid.
 *
 * Available variables:
 * - attributes: HTML attributes for the wrapping element.
 * - title: The title of this group of rows.
 * - view: The view object.
 * - rows: The rows contained in this view.
 * - options: The view plugin style options.
 *   - alignment: a string set to either 'horizontal' or 'vertical'.
 *   - columns: A number representing the max number of columns.
 *   - cell_min_width: A number representing the minimum width of the grid cell.
 *   - grid_gutter: A number representing the space between the grid cells.
 * - items: A list of grid items.
 *   - attributes: HTML attributes for each row or column.
 *   - content: A list of columns or rows. Each row or column contains:
 *     - attributes: HTML attributes for each row or column.
 *     - content: The row or column contents.
 *
 * @see template_preprocess_views_view_grid_responsive()
 *
 * @ingroup themeable
 */
#}

{{ attach_library('views/views.responsive-grid') }}

{%
  set classes = [
    'views-view-responsive-grid',
    'views-view-responsive-grid--' ~ options.alignment,
  ]
%}

{% set responsive_grid_styles = [
    '--views-responsive-grid--column-count:'  ~ options.columns ~ ';',
    '--views-responsive-grid--cell-min-width:'  ~ options.cell_min_width ~ 'px;',
    '--views-responsive-grid--layout-gap:'  ~ options.grid_gutter ~ 'px;',
  ]
%}

{% if title %}
  <h3>{{ title }}</h3>
{% endif %}
<div{{ attributes.addClass(classes).setAttribute('style', responsive_grid_styles|join()) }}>
  {% for item in items %}
    <div class=\"views-view-responsive-grid__item\">
      <div class=\"views-view-responsive-grid__item-inner\">
        {{- item.content -}}
      </div>
    </div>
  {% endfor %}
</div>
", "core/modules/views/templates/views-view-grid-responsive.html.twig", "C:\\xampp\\htdocs\\elearning\\web\\core\\modules\\views\\templates\\views-view-grid-responsive.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 31, "if" => 44, "for" => 48);
        static $filters = array("escape" => 28, "join" => 47);
        static $functions = array("attach_library" => 28);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['escape', 'join'],
                ['attach_library']
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
