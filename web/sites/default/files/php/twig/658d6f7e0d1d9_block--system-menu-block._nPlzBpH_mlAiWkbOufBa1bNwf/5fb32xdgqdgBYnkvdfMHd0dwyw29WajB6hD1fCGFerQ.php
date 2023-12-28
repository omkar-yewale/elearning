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

/* core/themes/olivero/templates/block/block--system-menu-block.html.twig */
class __TwigTemplate_560a3d145e82c3a993bfa91172232f48 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 36
        $context["classes"] = [0 => "block", 1 => "block-menu", 2 => "navigation", 3 => ("menu--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 40
($context["derivative_plugin_id"] ?? null), 40, $this->source)))];
        // line 43
        $context["heading_id"] = ($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "id", [], "any", false, false, true, 43), 43, $this->source) . \Drupal\Component\Utility\Html::getId("-menu"));
        // line 44
        echo "<nav ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 44), "setAttribute", [0 => "aria-labelledby", 1 => ($context["heading_id"] ?? null)], "method", false, false, true, 44), "setAttribute", [0 => "role", 1 => "navigation"], "method", false, false, true, 44), 44, $this->source), "html", null, true);
        echo ">
  ";
        // line 46
        echo "  ";
        if ( !twig_get_attribute($this->env, $this->source, ($context["configuration"] ?? null), "label_display", [], "any", false, false, true, 46)) {
            // line 47
            echo "    ";
            $context["title_attributes"] = twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => "visually-hidden"], "method", false, false, true, 47);
            // line 48
            echo "  ";
        }
        // line 49
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 49, $this->source), "html", null, true);
        echo "
  <h2";
        // line 50
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => "block__title"], "method", false, false, true, 50), "setAttribute", [0 => "id", 1 => ($context["heading_id"] ?? null)], "method", false, false, true, 50), 50, $this->source), "html", null, true);
        echo ">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["configuration"] ?? null), "label", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
        echo "</h2>
  ";
        // line 51
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 51, $this->source), "html", null, true);
        echo "
  ";
        // line 53
        echo "  ";
        $this->displayBlock('content', $context, $blocks);
        // line 56
        echo "</nav>
";
    }

    // line 53
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 54
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 54, $this->source), "html", null, true);
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "core/themes/olivero/templates/block/block--system-menu-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 54,  82 => 53,  77 => 56,  74 => 53,  70 => 51,  64 => 50,  59 => 49,  56 => 48,  53 => 47,  50 => 46,  45 => 44,  43 => 43,  41 => 40,  40 => 36,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Olivero's override for the main menu navigation block.
 *
 * Available variables:
 * - plugin_id: The ID of the block implementation.
 * - label: The configured label of the block if visible.
 * - configuration: A list of the block's configuration values.
 *   - label: The configured label for the block.
 *   - label_display: The display settings for the label.
 *   - provider: The module or other provider that provided this block plugin.
 *   - Block plugin specific settings will also be stored here.
 * - in_preview: Whether the plugin is being rendered in preview mode.
 * - content: The content of this block.
 * - attributes: HTML attributes for the containing element.
 *   - id: A valid HTML ID and guaranteed unique.
 * - title_attributes: HTML attributes for the title element.
 * - content_attributes: HTML attributes for the content element.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 *
 * Headings should be used on navigation menus that consistently appear on
 * multiple pages. When this menu block's label is configured to not be
 * displayed, it is automatically made invisible using the 'visually-hidden' CSS
 * class, which still keeps it visible for screen-readers and assistive
 * technology. Headings allow screen-reader and keyboard only users to navigate
 * to or skip the links.
 * See https://juicystudio.com/article/screen-readers-display-none.php and
 * https://www.w3.org/TR/WCAG-TECHS/H42.html for more information.
 */
#}
{%
  set classes = [
  'block',
  'block-menu',
  'navigation',
  'menu--' ~ derivative_plugin_id|clean_class,
]
%}
{% set heading_id = attributes.id ~ '-menu'|clean_id %}
<nav {{ attributes.addClass(classes).setAttribute('aria-labelledby', heading_id).setAttribute('role', 'navigation') }}>
  {# Label. If not displayed, we still provide it for screen readers. #}
  {% if not configuration.label_display %}
    {% set title_attributes = title_attributes.addClass('visually-hidden') %}
  {% endif %}
  {{ title_prefix }}
  <h2{{ title_attributes.addClass('block__title').setAttribute('id', heading_id) }}>{{ configuration.label }}</h2>
  {{ title_suffix }}
  {# Menu. #}
  {% block content %}
    {{ content }}
  {% endblock %}
</nav>
", "core/themes/olivero/templates/block/block--system-menu-block.html.twig", "C:\\xampp\\htdocs\\elearning\\web\\core\\themes\\olivero\\templates\\block\\block--system-menu-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 36, "if" => 46, "block" => 53);
        static $filters = array("clean_class" => 40, "clean_id" => 43, "escape" => 44);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'clean_id', 'escape'],
                []
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
