<template>
	<div class="wrapper">
		<sidebar></sidebar>
		<div class="main-panel">
			<!-- <topHeader></topHeader> -->
			<div class="content">
				<router-view/>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import sidebar from '@/js/components/Sidebar';
	import topHeader from '@/js/components/Header';

	export default {
		components: {
			sidebar,
			topHeader
		}
	};
</script>

