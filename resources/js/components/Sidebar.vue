<template>
	<div class="sidebar" data-color="rose" data-background-color="white">
		<div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
			{{ message }} - {{ reversedMessage }}
		</a></div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<router-link tag="li" class="nav-item" 
				:class="[!currentPage.includes('livenow') && !currentPage.includes('orders') && !currentPage.includes('customers') && !currentPage.includes('settings') ? activeClass : '']" 
				to="/"><a class="nav-link">Dashboard</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('livenow') ? activeClass : '']" to="/livenow"><a class="nav-link">Go Live NOW!</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('orders') ? activeClass : '']" to="/orders"><a class="nav-link">Orders</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('customers') ? activeClass : '']" to="/customers"><a class="nav-link">Customers</a></router-link>
				<router-link tag="li" class="nav-item" :class="[currentPage.includes('settings') ? activeClass : '']" to="/settings"><a class="nav-link">Settings</a></router-link>
				<router-link tag="li" class="nav-item active-pro" to="/404"><a class="nav-link">Logout</a></router-link>
			</ul>
		</div>
	</div>
</template>

<script type="text/javascript">
export default {
	data () {
		return {
			message: 'kok wai',
			activeClass: 'active'
		}
	},
	computed: {
		reversedMessage: function () {
	      return this.message.split('').reverse().join('')
	    },
	    currentPage: function () {
	    	return this.$route.path;
	    }
	}
};
</script>