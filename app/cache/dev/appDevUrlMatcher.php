<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/css/aa354d4')) {
            // _assetic_aa354d4
            if ($pathinfo === '/css/aa354d4.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'aa354d4',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_aa354d4',);
            }

            // _assetic_aa354d4_0
            if ($pathinfo === '/css/aa354d4_jquery.datetimepicker_1.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'aa354d4',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_aa354d4_0',);
            }

        }

        if (0 === strpos($pathinfo, '/js/9671197')) {
            // _assetic_9671197
            if ($pathinfo === '/js/9671197.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 9671197,  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_9671197',);
            }

            if (0 === strpos($pathinfo, '/js/9671197_jquery')) {
                // _assetic_9671197_0
                if ($pathinfo === '/js/9671197_jquery_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 9671197,  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_9671197_0',);
                }

                // _assetic_9671197_1
                if ($pathinfo === '/js/9671197_jquery.datetimepicker_2.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 9671197,  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_9671197_1',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/css/main')) {
            // _assetic_ca2a3f2
            if ($pathinfo === '/css/main.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2',);
            }

            if (0 === strpos($pathinfo, '/css/main_part_1_')) {
                if (0 === strpos($pathinfo, '/css/main_part_1_bootstrap')) {
                    if (0 === strpos($pathinfo, '/css/main_part_1_bootstrap-responsive')) {
                        // _assetic_ca2a3f2_0
                        if ($pathinfo === '/css/main_part_1_bootstrap-responsive_1.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2_0',);
                        }

                        // _assetic_ca2a3f2_1
                        if ($pathinfo === '/css/main_part_1_bootstrap-responsive.min_2.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2_1',);
                        }

                    }

                    // _assetic_ca2a3f2_2
                    if ($pathinfo === '/css/main_part_1_bootstrap_3.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => 2,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2_2',);
                    }

                    // _assetic_ca2a3f2_3
                    if ($pathinfo === '/css/main_part_1_bootstrap.min_4.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => 3,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2_3',);
                    }

                }

                // _assetic_ca2a3f2_4
                if ($pathinfo === '/css/main_part_1_jquery.datetimepicker_5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => 4,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2_4',);
                }

                // _assetic_ca2a3f2_5
                if ($pathinfo === '/css/main_part_1_main_6.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ca2a3f2',  'pos' => 5,  '_format' => 'css',  '_route' => '_assetic_ca2a3f2_5',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js/main')) {
            // _assetic_070569e
            if ($pathinfo === '/js/main.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_070569e',);
            }

            if (0 === strpos($pathinfo, '/js/main_part_1_')) {
                if (0 === strpos($pathinfo, '/js/main_part_1_bootstrap')) {
                    // _assetic_070569e_0
                    if ($pathinfo === '/js/main_part_1_bootstrap_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_070569e_0',);
                    }

                    // _assetic_070569e_1
                    if ($pathinfo === '/js/main_part_1_bootstrap.min_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_070569e_1',);
                    }

                }

                if (0 === strpos($pathinfo, '/js/main_part_1_jquery')) {
                    // _assetic_070569e_2
                    if ($pathinfo === '/js/main_part_1_jquery.datetimepicker_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_070569e_2',);
                    }

                    // _assetic_070569e_3
                    if ($pathinfo === '/js/main_part_1_jquery_4.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_070569e_3',);
                    }

                    // _assetic_070569e_4
                    if ($pathinfo === '/js/main_part_1_jquery.min_5.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_070569e_4',);
                    }

                }

                // _assetic_070569e_5
                if ($pathinfo === '/js/main_part_1_main_6.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '070569e',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_070569e_5',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // cv_profile_edit
        if ($pathinfo === '/myprofile/edit') {
            return array (  '_controller' => 'CV\\ProfileBundle\\Controller\\ProfileController::editAction',  '_route' => 'cv_profile_edit',);
        }

        // cv_profile_edit_car
        if (0 === strpos($pathinfo, '/car/edit') && preg_match('#^/car/edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_profile_edit_car')), array (  '_controller' => 'CV\\ProfileBundle\\Controller\\ProfileController::editCarAction',));
        }

        if (0 === strpos($pathinfo, '/p')) {
            // cv_profile_edit_preference
            if (0 === strpos($pathinfo, '/preference/edit') && preg_match('#^/preference/edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_profile_edit_preference')), array (  '_controller' => 'CV\\ProfileBundle\\Controller\\ProfileController::editPreferenceAction',));
            }

            if (0 === strpos($pathinfo, '/platform')) {
                // cv_platform_home
                if (preg_match('#^/platform(?:/(?P<page>\\d*))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_home')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::indexAction',  'page' => 1,));
                }

                if (0 === strpos($pathinfo, '/platform/ad')) {
                    // cv_platform_view
                    if (0 === strpos($pathinfo, '/platform/advert') && preg_match('#^/platform/advert/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_view')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::viewAction',));
                    }

                    // cv_platform_add
                    if ($pathinfo === '/platform/add') {
                        return array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::addAction',  '_route' => 'cv_platform_add',);
                    }

                }

                // cv_platform_edit
                if (0 === strpos($pathinfo, '/platform/edit') && preg_match('#^/platform/edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_edit')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::editAction',));
                }

                // cv_platform_delete
                if (0 === strpos($pathinfo, '/platform/delete') && preg_match('#^/platform/delete/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_delete')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::deleteAction',));
                }

                // cv_platform_my_rides
                if (0 === strpos($pathinfo, '/platform/my-rides') && preg_match('#^/platform/my\\-rides(?:/(?P<page>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_my_rides')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::ongoingRidesUserAction',  'page' => 1,));
                }

                // cv_platform_search_rides
                if ($pathinfo === '/platform/search-rides') {
                    return array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::searchRidesUserAction',  '_route' => 'cv_platform_search_rides',);
                }

                // cv_platform_focus_rides
                if (0 === strpos($pathinfo, '/platform/focus-rides') && preg_match('#^/platform/focus\\-rides/(?P<departure>[^/]++)/(?P<arrival>[^/]++)/(?P<departure_date>[^/]++)(?:/(?P<page>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_focus_rides')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::focusRidesUserAction',  'page' => 1,));
                }

                // cv_platform_booking_ride
                if (0 === strpos($pathinfo, '/platform/booking-ride') && preg_match('#^/platform/booking\\-ride/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_booking_ride')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::bookingRideAction',));
                }

                // cv_platform_confirm_booking_ride
                if (0 === strpos($pathinfo, '/platform/confirm-booking-ride') && preg_match('#^/platform/confirm\\-booking\\-ride/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cv_platform_confirm_booking_ride')), array (  '_controller' => 'CV\\PlatformBundle\\Controller\\AdvertController::confirmBookingRideAction',));
                }

                if (0 === strpos($pathinfo, '/platform/test')) {
                    // cv_platform_test
                    if ($pathinfo === '/platform/test') {
                        return array (  '_controller' => 'CV\\PlatformBundle\\Controller\\TestController::indexAction',  '_route' => 'cv_platform_test',);
                    }

                    // cv_platform_test_rides_filtered
                    if ($pathinfo === '/platform/test/rides_filtered') {
                        return array (  '_controller' => 'CV\\PlatformBundle\\Controller\\TestController::requestRidesFilteredAction',  '_route' => 'cv_platform_test_rides_filtered',);
                    }

                    // cv_platform_test_ongoing_rides_user
                    if ($pathinfo === '/platform/test/ongoing_rides_user') {
                        return array (  '_controller' => 'CV\\PlatformBundle\\Controller\\TestController::ongoingRidesUserAction',  '_route' => 'cv_platform_test_ongoing_rides_user',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'CV\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'CV\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'CV\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }

        }

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if (rtrim($pathinfo, '/') === '/register') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'CV\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }

                if (0 === strpos($pathinfo, '/register/c')) {
                    // fos_user_registration_check_email
                    if ($pathinfo === '/register/check-email') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_check_email;
                        }

                        return array (  '_controller' => 'CV\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    }
                    not_fos_user_registration_check_email:

                    if (0 === strpos($pathinfo, '/register/confirm')) {
                        // fos_user_registration_confirm
                        if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirm;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'CV\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                        }
                        not_fos_user_registration_confirm:

                        // fos_user_registration_confirmed
                        if ($pathinfo === '/register/confirmed') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirmed;
                            }

                            return array (  '_controller' => 'CV\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        }
                        not_fos_user_registration_confirmed:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_send_email
                if ($pathinfo === '/resetting/send-email') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ($pathinfo === '/resetting/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

            }

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
