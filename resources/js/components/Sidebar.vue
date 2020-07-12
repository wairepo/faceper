<template>
	<div class="sidebar" data-color="rose" data-background-color="white">
		<div class="logo">
			{{ user_name }}
		</div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<router-link tag="li" class="nav-item" 
				:class="[!currentPage.includes('livenow') && !currentPage.includes('orders') && !currentPage.includes('customers') && !currentPage.includes('settings') ? activeClass : '']" 
				to="/"><a class="nav-link">Dashboard</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('livenow') ? activeClass : '']" to="/livenow"><a class="nav-link">Go Live NOW!</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('orders') ? activeClass : '']" to="/orders"><a class="nav-link">Orders</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('customers') ? activeClass : '']" to="/customers"><a class="nav-link">Customers</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('settings') ? activeClass : '']" to="/settings"><a class="nav-link">Settings</a></router-link>
				<router-link tag="li" class="nav-item active-pro" to="/"><a class="nav-link" @click="logout()">Logout</a></router-link>
			</ul>
		</div>
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
			activeClass: 'active'
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