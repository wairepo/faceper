<template>
	<div>
		Ready to live now
		<span>{{ info }}</span>
	</div>
</template>
<script type="text/javascript">
export default {
	data() {
		return {
			info: ""
		}
	},
	mounted() {
		axios.get('/api/livenow').then(response => (

			console.log(response.data)

			))

	}
};
</script>