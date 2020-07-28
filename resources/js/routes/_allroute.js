
import Home from '@/js/views/home/Dashboard';
import list_order from '@/js/views/orders/List';
import list_customer from '@/js/views/customers/List';
import settings from '@/js/views/settings/Settings';
import not_found from '@/js/views/404';
import login from '@/js/views/auth/Login';
import pages from '@/js/views/auth/PickPage';
import privacy from '@/js/views/contactus/Privacy';

import list_post from '@/js/views/posts/List';
import edit_post from '@/js/views/posts/Edit';

router.addRoutes([

    { path: '/', name: 'home', meta: { layout: "main-page" }, component: Home }, //Dashboard
    { path: '/settings', name: 'settings', meta: { layout: "main-page" }, component: settings },
    { path: '/orders', name: 'orders', meta: { layout: "main-page" }, component: list_order },
    { path: '/customers', name: 'customers', meta: { layout: "main-page" }, component: list_customer },
    { path: '/404', name: 'not_found', meta: { layout: "blank" }, component: not_found },
    { path: '/login', name: 'login', meta: { layout: "blank" }, component: login },
    { path: '/pages', name: 'pages', meta: { layout: "blank" }, component: pages },

    // Post
    { path: '/posts', name: 'list_post', meta: { layout: "main-page" }, component: list_post },
    { path: '/posts/:id', name: 'edit_post', meta: { layout: "main-page" }, component: edit_post },

    { path: '/privacy-policy', name: 'privacy', meta: { layout: "blank" }, component: privacy }
])
