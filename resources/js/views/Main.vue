<template>
	<div>
		<sidebar></sidebar>
		<div class="">
<!-- 			<nav class="sidebarbar sidebarbar-expand-lg sidebarbar-transparent sidebarbar-absolute fixed-top">
				<div class="container-fluid">
					<div class="sidebarbar-wrapper">
						<a class="sidebarbar-brand" href="javascript:;"></a>
					</div>
					<button class="sidebarbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle sidebarigation">
						<span class="sr-only">Toggle navigation</span>
						<span class="sidebarbar-toggler-icon icon-bar"></span>
						<span class="sidebarbar-toggler-icon icon-bar"></span>
						<span class="sidebarbar-toggler-icon icon-bar"></span>
					</button>
				</div>
				<hr>
			</nav> -->
			<!-- <div class="wrapper"> -->
				<router-view/>
			<!-- </div> -->
		</div>
	</div>
</template>
<style type="text/css">
/*	.fixed-top {
		margin: -12px -10px 10px;
		border: 0;
		border-bottom: 1px solid #c9c7c7;
		width: 100%;
	}*/
</style>
<script type="text/javascript">
	import sidebar from '@/js/components/Sidebar';
	// import topHeader from '@/js/components/Header';

	export default {
		components: {
			sidebar,
			// topHeader
		}
	};
</script>

