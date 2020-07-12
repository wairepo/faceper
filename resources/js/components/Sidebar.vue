<template>
	<div>
		<b-button size="sm" variant="primary" v-b-toggle.sidebar-backdrop><b-icon icon="layout-text-sidebar"></b-icon></b-button>
		<b-sidebar
		id="sidebar-backdrop"
		title="Sidebar with backdrop"
		backdrop-variant="light"
		no-header-close
		backdrop
		shadow
		>
		<nav class="mb-3">
			<router-link class="nav-item" 
			to="/"><a :class="[!currentPage.includes('posts') && !currentPage.includes('orders') && !currentPage.includes('customers') && !currentPage.includes('settings') ? 'bg-secondary' : '']" class="nav-link text-dark">Dashboard</a></router-link>
			<router-link class="nav-item bg-primary" to="/posts"><a :class="[currentPage.includes('posts') ? 'bg-secondary' : '']" class="nav-link text-dark">LIVE Posts</a></router-link>
			<router-link class="nav-item" to="/orders"><a :class="[currentPage.includes('orders') ? 'bg-secondary' : '']" class="nav-link text-dark">Orders</a></router-link>
			<router-link class="nav-item" to="/customers"><a :class="[currentPage.includes('customers') ? 'bg-secondary' : '']" class="nav-link text-dark">Customers</a></router-link>
			<router-link class="nav-item" to="/settings"><a :class="[currentPage.includes('settings') ? 'bg-secondary' : '']" class="nav-link text-dark">Settings</a></router-link>
		</nav>
		<template v-slot:footer="{ hide }">
			<div class="d-flex mr-auto text-light align-items-center px-3 py-2">
				<strong class="mr-auto"><router-link class="nav-item active-pro" to="/"><a class="nav-link" @click="logout()">Logout</a></router-link></strong>
				<b-button size="sm" variant="primary" @click="hide"><b-icon icon="layout-text-sidebar"></b-icon></b-button>
			</div>
		</template>
	</b-sidebar>
</div>
</template>
<style type="text/css">
	.logo {
		text-align: center;
	}
</style>
<script type="text/javascript">
export default {
	data () {
		return {
			user_name: "Kok Wai",
			activeClass: 'active',
		}
	},
	computed: {
		// reversedMessage: function () {
	 //      return this.message.split('').reverse().join('')
	 //    },
	    currentPage: function () {
	    	return this.$route.path;
	    }
	},
	methods: {
		logout() {
			axios.post('/logout')
			.then(() => location.href = '/login')
		}
	},
	mounted() {

	    console.log(localStorage)
	}
};
</script>