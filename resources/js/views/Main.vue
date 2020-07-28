<template>
	<div>
		<div class="mr-auto mb-5">
			<b-button class="position-fixed" size="sm" variant="primary" v-b-toggle.sidebar-backdrop><b-icon icon="arrow-bar-right"></b-icon></b-button>
		</div>
		<hr style="width:100%;text-align:left;margin-left:0">
		<router-view/>
		<sidebar></sidebar>
	</div>
</template>

<script type="text/javascript">
import sidebar from '@/js/components/Sidebar';

export default {
	components: {
		sidebar
	}
};
</script>

