<template>
	<div>
		<b-container fluid="sm">
			<b-table striped hover :items="items" :fields="fields"></b-table>
		</b-container>
	</div>
</template>
<script type="text/javascript">
export default {
	data() {
		return {
			info: "asdasd",
			fields: ['first_name', 'last_name', 'age'],
			items: [
				{ age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
				{ age: 21, first_name: 'Larsen', last_name: 'Shaw' },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson' },
				{ age: 38, first_name: 'Jami', last_name: 'Carney' }
			]
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