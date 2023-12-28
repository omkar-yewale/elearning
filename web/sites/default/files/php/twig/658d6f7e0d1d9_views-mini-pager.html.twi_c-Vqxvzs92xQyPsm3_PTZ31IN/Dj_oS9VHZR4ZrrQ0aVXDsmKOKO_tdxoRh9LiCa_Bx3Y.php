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

/* core/themes/olivero/templates/views/views-mini-pager.html.twig */
class __TwigTemplate_e0097b200b8d50a39e55a63d6f8b1286 extends Template
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
        // line 13
        if ((twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 13) || twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 13))) {
            // line 14
            echo "  <nav class=\"pager\" role=\"navigation\" aria-labelledby=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["heading_id"] ?? null), 14, $this->source), "html", null, true);
            echo "\">
    <h4 id=\"";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["heading_id"] ?? null), 15, $this->source), "html", null, true);
            echo "\" class=\"visually-hidden\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Pagination"));
            echo "</h4>
    <ul class=\"pager__items js-pager__items\">
      ";
            // line 18
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 18)) {
                // line 19
                echo "        ";
                ob_start();
                // line 20
                echo "          <li class=\"pager__item pager__item--control pager__item--previous\">
            <a href=\"";
                // line 21
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 21), "href", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
                echo "\" class=\"pager__link\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to previous page"));
                echo "\" rel=\"prev\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 21), "attributes", [], "any", false, false, true, 21), 21, $this->source), "href", "title", "rel", "class"), "html", null, true);
                echo ">
              <span class=\"visually-hidden\">";
                // line 22
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Previous page"));
                echo "</span>
              ";
                // line 23
                $this->loadTemplate("@olivero/../images/pager-previous.svg", "core/themes/olivero/templates/views/views-mini-pager.html.twig", 23)->display($context);
                // line 24
                echo "            </a>
          </li>
        ";
                $___internal_parse_0_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 19
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_spaceless($___internal_parse_0_));
                // line 27
                echo "      ";
            }
            // line 28
            echo "
      ";
            // line 30
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "current", [], "any", false, false, true, 30)) {
                // line 31
                echo "        <li class=\"pager__item pager__item--active\">
          ";
                // line 32
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "current", [], "any", false, false, true, 32), 32, $this->source), "html", null, true);
                echo "
        </li>
      ";
            }
            // line 35
            echo "
      ";
            // line 37
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 37)) {
                // line 38
                echo "        ";
                ob_start();
                // line 39
                echo "          <li class=\"pager__item pager__item--control pager__item--next\">
            <a href=\"";
                // line 40
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 40), "href", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
                echo "\" class=\"pager__link\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to next page"));
                echo "\" rel=\"next\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 40), "attributes", [], "any", false, false, true, 40), 40, $this->source), "href", "title", "rel"), "html", null, true);
                echo ">
              <span class=\"visually-hidden\">";
                // line 41
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Next page"));
                echo "</span>
              ";
                // line 42
                $this->loadTemplate("@olivero/../images/pager-previous.svg", "core/themes/olivero/templates/views/views-mini-pager.html.twig", 42)->display($context);
                // line 43
                echo "            </a>
          </li>
        ";
                $___internal_parse_1_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 38
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_spaceless($___internal_parse_1_));
                // line 46
                echo "      ";
            }
            // line 47
            echo "    </ul>
  </nav>
";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/olivero/templates/views/views-mini-pager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 47,  134 => 46,  132 => 38,  127 => 43,  125 => 42,  121 => 41,  113 => 40,  110 => 39,  107 => 38,  104 => 37,  101 => 35,  95 => 32,  92 => 31,  89 => 30,  86 => 28,  83 => 27,  81 => 19,  76 => 24,  74 => 23,  70 => 22,  62 => 21,  59 => 20,  56 => 19,  53 => 18,  46 => 15,  41 => 14,  39 => 13,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme override for a views mini-pager.
 *
 * Available variables:
 * - heading_id: Pagination heading ID.
 * - items: List of pager items.
 *
 * @see template_preprocess_views_mini_pager()
 */
#}
{% if items.previous or items.next %}
  <nav class=\"pager\" role=\"navigation\" aria-labelledby=\"{{ heading_id }}\">
    <h4 id=\"{{ heading_id }}\" class=\"visually-hidden\">{{ 'Pagination'|t }}</h4>
    <ul class=\"pager__items js-pager__items\">
      {# Print previous item if we are not on the first page. #}
      {% if items.previous %}
        {% apply spaceless %}
          <li class=\"pager__item pager__item--control pager__item--previous\">
            <a href=\"{{ items.previous.href }}\" class=\"pager__link\" title=\"{{ 'Go to previous page'|t }}\" rel=\"prev\"{{ items.previous.attributes|without('href', 'title', 'rel', 'class') }}>
              <span class=\"visually-hidden\">{{ 'Previous page'|t }}</span>
              {% include \"@olivero/../images/pager-previous.svg\" %}
            </a>
          </li>
        {% endapply %}
      {% endif %}

      {# Print current active page. #}
      {% if items.current %}
        <li class=\"pager__item pager__item--active\">
          {{ items.current }}
        </li>
      {% endif %}

      {# Print next item if we are not on the last page. #}
      {% if items.next %}
        {% apply spaceless %}
          <li class=\"pager__item pager__item--control pager__item--next\">
            <a href=\"{{ items.next.href }}\" class=\"pager__link\" title=\"{{ 'Go to next page'|t }}\" rel=\"next\"{{ items.next.attributes|without('href', 'title', 'rel') }}>
              <span class=\"visually-hidden\">{{ 'Next page'|t }}</span>
              {% include \"@olivero/../images/pager-previous.svg\" %}
            </a>
          </li>
        {% endapply %}
      {% endif %}
    </ul>
  </nav>
{% endif %}
", "core/themes/olivero/templates/views/views-mini-pager.html.twig", "C:\\xampp\\htdocs\\elearning\\web\\core\\themes\\olivero\\templates\\views\\views-mini-pager.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 13, "apply" => 19, "include" => 23);
        static $filters = array("escape" => 14, "t" => 15, "without" => 21, "spaceless" => 19);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'apply', 'include'],
                ['escape', 't', 'without', 'spaceless'],
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
