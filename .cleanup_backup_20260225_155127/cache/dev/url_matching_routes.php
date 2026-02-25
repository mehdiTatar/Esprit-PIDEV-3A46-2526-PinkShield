<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/admin/manage-admins' => [[['_route' => 'admin_index', '_controller' => 'App\\Controller\\AdminController::index'], null, null, null, false, false, null]],
        '/admin/health-logs' => [[['_route' => 'admin_health_logs', '_controller' => 'App\\Controller\\AdminController::healthLogs'], null, null, null, false, false, null]],
        '/admin/health-stats' => [[['_route' => 'admin_health_stats', '_controller' => 'App\\Controller\\AdminController::healthStats'], null, null, null, false, false, null]],
        '/admin/manage-blog' => [[['_route' => 'admin_manage_blog', '_controller' => 'App\\Controller\\AdminController::manageBlog'], null, null, null, false, false, null]],
        '/admin/new' => [[['_route' => 'admin_new', '_controller' => 'App\\Controller\\AdminController::new'], null, null, null, false, false, null]],
        '/appointment' => [[['_route' => 'appointment_index', '_controller' => 'App\\Controller\\AppointmentController::index'], null, null, null, true, false, null]],
        '/appointment/fc/load-events' => [[['_route' => 'fc_load_events', '_controller' => 'App\\Controller\\AppointmentController::loadEvents'], null, ['GET' => 0], null, false, false, null]],
        '/appointment/new' => [[['_route' => 'appointment_new', '_controller' => 'App\\Controller\\AppointmentController::new'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\AuthController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\AuthController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\AuthController::register'], null, null, null, false, false, null]],
        '/register/patient' => [[['_route' => 'register_patient', '_controller' => 'App\\Controller\\AuthController::registerPatient'], null, null, null, false, false, null]],
        '/register/doctor' => [[['_route' => 'register_doctor', '_controller' => 'App\\Controller\\AuthController::registerDoctor'], null, null, null, false, false, null]],
        '/blog' => [[['_route' => 'blog_index', '_controller' => 'App\\Controller\\BlogController::index'], null, null, null, true, false, null]],
        '/blog/new' => [[['_route' => 'blog_new', '_controller' => 'App\\Controller\\BlogController::new'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/dashboard' => [[['_route' => 'dashboard', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/admin/dashboard' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\DashboardController::adminDashboard'], null, null, null, false, false, null]],
        '/doctor/dashboard' => [[['_route' => 'doctor_dashboard', '_controller' => 'App\\Controller\\DashboardController::doctorDashboard'], null, null, null, false, false, null]],
        '/user/dashboard' => [[['_route' => 'user_dashboard', '_controller' => 'App\\Controller\\DashboardController::userDashboard'], null, null, null, false, false, null]],
        '/doctor' => [[['_route' => 'doctor_index', '_controller' => 'App\\Controller\\DoctorController::index'], null, null, null, true, false, null]],
        '/doctor/new' => [[['_route' => 'doctor_new', '_controller' => 'App\\Controller\\DoctorController::new'], null, null, null, false, false, null]],
        '/notifications' => [[['_route' => 'notifications_index', '_controller' => 'App\\Controller\\NotificationController::index'], null, null, null, true, false, null]],
        '/notifications/api/list' => [[['_route' => 'notifications_api_list', '_controller' => 'App\\Controller\\NotificationController::apiList'], null, null, null, false, false, null]],
        '/parapharmacy' => [[['_route' => 'parapharmacy_index', '_controller' => 'App\\Controller\\ParapharmacieController::index'], null, null, null, true, false, null]],
        '/rating/doctors' => [[['_route' => 'rating_doctors_list', '_controller' => 'App\\Controller\\RatingController::doctorsList'], null, null, null, false, false, null]],
        '/user' => [[['_route' => 'user_index', '_controller' => 'App\\Controller\\UserController::index'], null, null, null, true, false, null]],
        '/user/new' => [[['_route' => 'user_new', '_controller' => 'App\\Controller\\UserController::new'], null, null, null, false, false, null]],
        '/wishlist' => [[['_route' => 'wishlist_index', '_controller' => 'App\\Controller\\WishlistController::index'], null, null, null, true, false, null]],
        '/tracking' => [[['_route' => 'tracking_index', '_controller' => 'App\\Controller\\TrackingController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/a(?'
                    .'|dmin/(?'
                        .'|health\\-logs/(\\d+)/delete(*:80)'
                        .'|(\\d+)/edit(*:97)'
                        .'|(\\d+)/delete(*:116)'
                        .'|(\\d+)(*:129)'
                    .')'
                    .'|ppointment/([^/]++)(?'
                        .'|/(?'
                            .'|c(?'
                                .'|onfirm(*:174)'
                                .'|ancel(*:187)'
                            .')'
                            .'|e(?'
                                .'|dit(*:203)'
                                .'|mail\\-doctor(*:223)'
                            .')'
                            .'|invoice(*:239)'
                            .'|suggestion(*:257)'
                        .')'
                        .'|(*:266)'
                    .')'
                .')'
                .'|/blog/(?'
                    .'|(\\d+)(*:290)'
                    .'|(\\d+)/edit(*:308)'
                    .'|(\\d+)/delete(*:328)'
                    .'|comment/(?'
                        .'|(\\d+)/edit(*:357)'
                        .'|(\\d+)/delete(*:377)'
                    .')'
                .')'
                .'|/doctor/([^/]++)(?'
                    .'|/(?'
                        .'|edit(*:414)'
                        .'|de(?'
                            .'|lete(*:431)'
                            .'|activate(*:447)'
                        .')'
                        .'|activate(*:464)'
                        .'|toggle\\-status(*:486)'
                    .')'
                    .'|(*:495)'
                .')'
                .'|/notifications/api/mark\\-read/([^/]++)(*:542)'
                .'|/rating/doctor/([^/]++)/rate(*:578)'
                .'|/tracking/(?'
                    .'|edit/([^/]++)(*:612)'
                    .'|delete/([^/]++)(*:635)'
                .')'
                .'|/user/([^/]++)(?'
                    .'|/(?'
                        .'|edit(*:669)'
                        .'|de(?'
                            .'|lete(*:686)'
                            .'|activate(*:702)'
                        .')'
                        .'|activate(*:719)'
                    .')'
                    .'|(*:728)'
                .')'
                .'|/wishlist/(?'
                    .'|add/([^/]++)(*:762)'
                    .'|remove(?'
                        .'|/([^/]++)(*:788)'
                        .'|\\-by\\-product/([^/]++)(*:818)'
                    .')'
                    .'|check/([^/]++)(*:841)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        80 => [[['_route' => 'admin_health_log_delete', '_controller' => 'App\\Controller\\AdminController::healthLogDelete'], ['id'], null, null, false, false, null]],
        97 => [[['_route' => 'admin_edit', '_controller' => 'App\\Controller\\AdminController::edit'], ['id'], null, null, false, false, null]],
        116 => [[['_route' => 'admin_delete', '_controller' => 'App\\Controller\\AdminController::delete'], ['id'], null, null, false, false, null]],
        129 => [[['_route' => 'admin_show', '_controller' => 'App\\Controller\\AdminController::show'], ['id'], null, null, false, true, null]],
        174 => [[['_route' => 'appointment_confirm', '_controller' => 'App\\Controller\\AppointmentController::confirm'], ['id'], null, null, false, false, null]],
        187 => [[['_route' => 'appointment_cancel', '_controller' => 'App\\Controller\\AppointmentController::cancel'], ['id'], null, null, false, false, null]],
        203 => [[['_route' => 'appointment_edit', '_controller' => 'App\\Controller\\AppointmentController::edit'], ['id'], null, null, false, false, null]],
        223 => [[['_route' => 'appointment_email_doctor', '_controller' => 'App\\Controller\\AppointmentController::emailDoctor'], ['id'], ['POST' => 0], null, false, false, null]],
        239 => [[['_route' => 'appointment_invoice', '_controller' => 'App\\Controller\\AppointmentController::generateInvoice'], ['id'], null, null, false, false, null]],
        257 => [[['_route' => 'appointment_suggestion', '_controller' => 'App\\Controller\\AppointmentController::suggestAppointment'], ['id'], null, null, false, false, null]],
        266 => [[['_route' => 'appointment_show', '_controller' => 'App\\Controller\\AppointmentController::show'], ['id'], null, null, false, true, null]],
        290 => [[['_route' => 'blog_show', '_controller' => 'App\\Controller\\BlogController::show'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        308 => [[['_route' => 'blog_edit', '_controller' => 'App\\Controller\\BlogController::edit'], ['id'], null, null, false, false, null]],
        328 => [[['_route' => 'blog_delete', '_controller' => 'App\\Controller\\BlogController::delete'], ['id'], null, null, false, false, null]],
        357 => [[['_route' => 'comment_edit', '_controller' => 'App\\Controller\\BlogController::editComment'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        377 => [[['_route' => 'comment_delete', '_controller' => 'App\\Controller\\BlogController::deleteComment'], ['id'], null, null, false, false, null]],
        414 => [[['_route' => 'doctor_edit', '_controller' => 'App\\Controller\\DoctorController::edit'], ['id'], null, null, false, false, null]],
        431 => [[['_route' => 'doctor_delete', '_controller' => 'App\\Controller\\DoctorController::delete'], ['id'], null, null, false, false, null]],
        447 => [[['_route' => 'doctor_deactivate', '_controller' => 'App\\Controller\\DoctorController::deactivate'], ['id'], ['POST' => 0], null, false, false, null]],
        464 => [[['_route' => 'doctor_activate', '_controller' => 'App\\Controller\\DoctorController::activate'], ['id'], ['POST' => 0], null, false, false, null]],
        486 => [[['_route' => 'doctor_toggle_status', '_controller' => 'App\\Controller\\DoctorController::toggleStatus'], ['id'], ['POST' => 0], null, false, false, null]],
        495 => [[['_route' => 'doctor_show', '_controller' => 'App\\Controller\\DoctorController::show'], ['id'], null, null, false, true, null]],
        542 => [[['_route' => 'notification_mark_read', '_controller' => 'App\\Controller\\NotificationController::markRead'], ['id'], ['POST' => 0], null, false, true, null]],
        578 => [[['_route' => 'rating_rate_doctor', '_controller' => 'App\\Controller\\RatingController::rateDoctor'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        612 => [[['_route' => 'tracking_edit', '_controller' => 'App\\Controller\\TrackingController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        635 => [[['_route' => 'tracking_delete', '_controller' => 'App\\Controller\\TrackingController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        669 => [[['_route' => 'user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], null, null, false, false, null]],
        686 => [[['_route' => 'user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], null, null, false, false, null]],
        702 => [[['_route' => 'user_deactivate', '_controller' => 'App\\Controller\\UserController::deactivate'], ['id'], ['POST' => 0], null, false, false, null]],
        719 => [[['_route' => 'user_activate', '_controller' => 'App\\Controller\\UserController::activate'], ['id'], ['POST' => 0], null, false, false, null]],
        728 => [[['_route' => 'user_show', '_controller' => 'App\\Controller\\UserController::show'], ['id'], null, null, false, true, null]],
        762 => [[['_route' => 'wishlist_add', '_controller' => 'App\\Controller\\WishlistController::add'], ['productId'], ['POST' => 0], null, false, true, null]],
        788 => [[['_route' => 'wishlist_remove', '_controller' => 'App\\Controller\\WishlistController::remove'], ['wishlistId'], ['POST' => 0], null, false, true, null]],
        818 => [[['_route' => 'wishlist_remove_by_product', '_controller' => 'App\\Controller\\WishlistController::removeByProduct'], ['productId'], ['POST' => 0], null, false, true, null]],
        841 => [
            [['_route' => 'wishlist_check', '_controller' => 'App\\Controller\\WishlistController::check'], ['productId'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
