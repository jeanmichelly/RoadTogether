<?php

/* ::layout.html.twig */
class __TwigTemplate_3b90b62128cf3da30cc1df276545c5be8db4c60ec78d0b0dea3183a136fece76 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
<!DOCTYPE html>
<html>
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

  <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

   ";
        // line 11
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "</head>



<body>
  <div class=\"container\">
    <div id=\"header\" class=\"hero-unit\">
      <h1>Ma plateforme d'annonces</h1>
      <p>
        Ce projet est propulsé par Symfony2,
        et construit grâce au MOOC OpenClassrooms et SensioLabs.
      </p>
      <p>
        <a class=\"btn btn-primary btn-lg\" href=\"http://fr.openclassrooms.com/informatique/cours/developpez-votre-site-web-avec-le-framework-symfony2\">
          Participer au MOOC »
        </a>
      </p>
    </div>


    <div class=\"row\">
      <div id=\"menu\" class=\"span3\">
        <h3>Les annonces</h3>
        <ul class=\"nav nav-pills nav-stacked\">
          <li><a href=\"";
        // line 41
        echo $this->env->getExtension('routing')->getPath("cv_platform_home");
        echo "\">Accueil</a></li>
           <li><a href=\"";
        // line 42
        echo $this->env->getExtension('routing')->getPath("cv_platform_search_rides");
        echo "\">Rechercher des annonces</a> </li>
          <li><a href=\"";
        // line 43
        echo $this->env->getExtension('routing')->getPath("cv_platform_add");
        echo "\">Ajouter une annonce</a> </li>
          <li><a href=\"";
        // line 44
        echo $this->env->getExtension('routing')->getPath("cv_platform_my_rides");
        echo "\">Mes annonces</a> </li>
          <li><a href=\"";
        // line 45
        echo $this->env->getExtension('routing')->getPath("cv_profile_edit");
        echo "\">Mon profil</a> </li>
        </ul>
       
         ";
        // line 51
        echo "          ";
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 52
            echo "            <h3>Membre</h3>
            <ul class=\"nav nav-pills nav-stacked\">
              <li>";
            // line 54
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logged_in_as", array("%username%" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array())), "FOSUserBundle"), "html", null, true);
            echo "</li>
              <li><a href=\"";
            // line 55
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logout", array(), "FOSUserBundle"), "html", null, true);
            echo "</a></li>
            </ul>
          ";
            // line 58
            echo "          ";
        } elseif (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method") != "fos_user_security_login")) {
            // line 59
            echo "            <h3>Identification</h3>
            ";
            // line 60
            echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("CVUserBundle:Security:login"));
            echo "
          ";
        }
        // line 62
        echo "

      </div>
      <div id=\"content\" class=\"span9\">
        ";
        // line 66
        $this->displayBlock('body', $context, $blocks);
        // line 68
        echo "      </div>

    </div>

    <hr>

    <footer>
      <p>The sky's the limit © ";
        // line 75
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " and beyond.</p>
    </footer>
  </div>

    ";
        // line 79
        $this->displayBlock('javascripts', $context, $blocks);
        // line 89
        echo "
</body>
</html>";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "CV Plateforme";
    }

    // line 11
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 12
        echo "      ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "ca2a3f2_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main_part_1_bootstrap-responsive_1.css");
            // line 14
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
            // asset "ca2a3f2_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main_part_1_bootstrap-responsive.min_2.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
            // asset "ca2a3f2_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main_part_1_bootstrap_3.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
            // asset "ca2a3f2_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2_3") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main_part_1_bootstrap.min_4.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
            // asset "ca2a3f2_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2_4") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main_part_1_jquery.datetimepicker_5.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
            // asset "ca2a3f2_5"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2_5") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main_part_1_main_6.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
        } else {
            // asset "ca2a3f2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ca2a3f2") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/main.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" type=\"text/css\" />
      ";
        }
        unset($context["asset_url"]);
        // line 16
        echo "    ";
    }

    // line 66
    public function block_body($context, array $blocks = array())
    {
        // line 67
        echo "        ";
    }

    // line 79
    public function block_javascripts($context, array $blocks = array())
    {
        // line 80
        echo "      ";
        // line 81
        echo "      <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js\"></script>
      <script>window.jQuery || document.write('<script src=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.min.js"), "html", null, true);
        echo "\"><\\/script>')</script>
      ";
        // line 84
        echo "      ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "070569e_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main_part_1_bootstrap_1.js");
            // line 86
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
            // asset "070569e_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main_part_1_bootstrap.min_2.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
            // asset "070569e_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main_part_1_jquery.datetimepicker_3.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
            // asset "070569e_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e_3") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main_part_1_jquery_4.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
            // asset "070569e_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e_4") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main_part_1_jquery.min_5.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
            // asset "070569e_5"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e_5") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main_part_1_main_6.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
        } else {
            // asset "070569e"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_070569e") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/main.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
      ";
        }
        unset($context["asset_url"]);
        // line 88
        echo "    ";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  278 => 88,  234 => 86,  229 => 84,  225 => 82,  222 => 81,  220 => 80,  217 => 79,  213 => 67,  210 => 66,  206 => 16,  162 => 14,  157 => 12,  154 => 11,  148 => 9,  142 => 89,  140 => 79,  133 => 75,  124 => 68,  122 => 66,  116 => 62,  111 => 60,  108 => 59,  105 => 58,  98 => 55,  94 => 54,  90 => 52,  87 => 51,  81 => 45,  77 => 44,  73 => 43,  69 => 42,  65 => 41,  39 => 17,  37 => 11,  32 => 9,  23 => 2,);
    }
}
