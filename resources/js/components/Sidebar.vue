<template>
	<div class="sidebar" data-color="rose" data-background-color="white">
		<div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
			FUCKIE
		</a></div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<router-link tag="li" class="nav-item active" to="/"><a class="nav-link">Dashboard</a></router-link>
				<router-link tag="li" class="nav-item" to="/livenow"><a class="nav-link">Go Live NOW!</a></router-link>
				<router-link tag="li" class="nav-item" to="/orders"><a class="nav-link">Orders</a></router-link>
				<router-link tag="li" class="nav-item" to="/customers"><a class="nav-link">Customers</a></router-link>
				<router-link tag="li" class="nav-item" to="/settings"><a class="nav-link">Settings</a></router-link>
				<router-link tag="li" class="nav-item active-pro" to="/404"><a class="nav-link">Logout</a></router-link>
			</ul>
		</div>
	</div>
</template>