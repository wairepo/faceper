<template>
	<div>
		<sidebar></sidebar>
		<div class="main-panel">
			<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<a class="navbar-brand" href="javascript:;"></a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="sr-only">Toggle navigation</span>
						<span class="navbar-toggler-icon icon-bar"></span>
						<span class="navbar-toggler-icon icon-bar"></span>
						<span class="navbar-toggler-icon icon-bar"></span>
					</button>
				</div>
			</nav>
			<div class="wrapper">
				<router-view/>
			</div>
		</div>
	</div>
</template>
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

