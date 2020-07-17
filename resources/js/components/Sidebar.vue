<template>
	<div>
		
		<b-sidebar
		id="sidebar-backdrop"
		backdrop-variant="light"
		no-header-close
		backdrop
		shadow
		>
		<div class="h-10 mb-5 mr-auto" >
			<b-avatar src="https://placekitten.com/300/300" size="6rem" class="ml-3"></b-avatar>
			<hr style="width:100%;text-align:left;margin-left:0">
		</div>
		<b-list-group>
			<b-list-group-item href="/" :variant="!currentPage.includes('posts') && !currentPage.includes('orders') && !currentPage.includes('customers') && !currentPage.includes('settings') ? 'secondary' : '' " class="b-none d-flex justify-content-between align-items-center">
				Dashboard
			</b-list-group-item>

			<b-list-group-item href="/posts" :variant="currentPage.includes('posts') ? 'secondary' : ''" class="b-none d-flex justify-content-between align-items-center">
				LIVE Posts
			</b-list-group-item>

			<b-list-group-item href="/orders" :variant="currentPage.includes('orders') ? 'secondary' : ''" class="b-none d-flex justify-content-between align-items-center">
				Orders
				<b-badge variant="danger" pill>14</b-badge>
			</b-list-group-item>

			<b-list-group-item href="/customers" :variant="currentPage.includes('customers') ? 'secondary' : ''" class="b-none d-flex justify-content-between align-items-center">
				Customers
			</b-list-group-item>

			<b-list-group-item href="/settings" :variant="currentPage.includes('settings') ? 'secondary' : ''" class="b-none d-flex justify-content-between align-items-center">
				Settings
			</b-list-group-item>
		</b-list-group>
		<template v-slot:footer="{ hide }">
			<div class="d-flex mr-auto text-light align-items-center px-3 py-2">
				<strong class="mr-auto"><router-link class="nav-item active-pro" to="/"><a class="nav-link" @click="logout()">Logout</a></router-link></strong>
				<b-button size="sm" variant="primary" @click="hide"><b-icon icon="arrow-bar-left"></b-icon></b-button>
			</div>
		</template>
	</b-sidebar>
</div>
</template>
<style type="text/css">
	.fixed_top {
		position: fixed;
	}

	.b-none {
		border: none;
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
	    },
	    
	},
	methods: {
		logout() {
			axios.post('/logout')
			.then(() => location.href = '/login')
		}
	},
	mounted() {

	}
};
</script>