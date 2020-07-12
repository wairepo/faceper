import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import list_order from '@/js/layouts/orders/List';
import list_customer from '@/js/layouts/customers/List';
import settings from '@/js/layouts/settings/Settings';
import Live_Now from '@/js/layouts/live_now/List';
import not_found from '@/js/views/404';
import login from '@/js/layouts/auth/Login';
import pages from '@/js/layouts/auth/PickPage';

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [

		{
			path: '/',
			name: 'home',
			meta: { layout: "main-page" },
			component: Home
		},
		{
			path: '/livenow',
			name: 'livenow',
			meta: { layout: "main-page" },
			component: Live_Now
		},
		{
			path: '/settings',
			name: 'settings',
			meta: { layout: "main-page" },
			component: settings
		},
		{
			path: '/orders',
			name: 'orders',
			meta: { layout: "main-page" },
			component: list_order
		},
		{
			path: '/customers',
			name: 'customers',
			meta: { layout: "main-page" },
			component: list_customer
		},
		{
			path: '/404',
			name: 'not_found',
			meta: { layout: "blank" },
			component: not_found
		},
		{
			path: '/login',
			name: 'login',
			meta: { layout: "blank" },
			component: login
		},
		{
			path: '/pages',
			name: 'pages',
			meta: { layout: "blank" },
			component: pages
		}

	]
});

export default router;
