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

/* field--text.html.twig */
class __TwigTemplate_dfd51850693cb59731b8eca18239a3f9 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 20
        $context["attributes"] = twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "clearfix"], "method", false, false, true, 20);
        // line 1
        $this->parent = $this->loadTemplate("field.html.twig", "field--text.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "field--text.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 1,  43 => 20,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"field.html.twig\" %}
{#
/**
 * @file
 * Theme override for a text field.
 *
 * A 'clearfix' class is added, because 'text' fields have a 'format' property
 * that allows a Text Format to be associated with the entered text, which then
 * applies filtering on output. A common use case is to align images to the left
 * or right, and without this 'clearfix' class, such aligned images may be
 * rendered outside of the 'text' field formatter's boundaries, and hence
 * overlap with other fields. By setting the 'clearfix' class on all 'text'
 * fields, we prevent that.
 *
 * @see https://www.drupal.org/node/2358529
 *
 * @ingroup themeable
 */
#}
{% set attributes = attributes.addClass('clearfix') %}
", "field--text.html.twig", "core/themes/olivero/templates/field/field--text.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 20);
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set'],
                [],
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
