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
		axios.get('/api/livenow', {}).then(function (response) {
			$this.info = response.data
		})



	}
};
</script>