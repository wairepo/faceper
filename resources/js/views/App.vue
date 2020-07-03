<template>
	<div id="app">
		<component :is="layout">
			<router-view/>
		</component>
	</div>
</template>

<script type="text/javascript">

	const default_layout = "main-page"

	export default {
		computed: {
			layout() {
				return (this.$route.meta.layout || default_layout)
			}
		}
	};
</script>
