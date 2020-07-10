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
			info: "asdasd"
		}
	},
	created() {

		this.info = "bvbvbvb"

		axios.get('/api/livenow').then(function (response) {
			// console.log(response.data)
			// this.info = "2222"

			// console.log(this.info)
		})

	}
};
</script>