<template>
	<div>
		<b-container fluid="lg">
			<b-card >
				<b-row class="text-center p-3">
					<b-col>

					</b-col>
				</b-row>
				<b-row class="text-center">
					<b-col>
						<b-table striped hover :items="items" :fields="fields"></b-table>
					</b-col>
				</b-row>
			</b-card>
			
			<b-card no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item active>Active</b-nav-item>
        <b-nav-item>Inactive</b-nav-item>
        <b-nav-item disabled>Disabled</b-nav-item>
      </b-nav>
    </b-card-header>

    <b-card-body class="text-center">
      <b-card-title>Card Title</b-card-title>

      <b-card-text>
        With supporting text below as a natural lead-in to additional content.
      </b-card-text>

      <b-button variant="primary">Go somewhere</b-button>
    </b-card-body>
  </b-card>
		</b-container>
	</div>
</template>
<script type="text/javascript">
export default {
	data() {
		return {
			info: "asdasd",
			fields: ['first_name', 'last_name', 'last_name1', 'last_name2', 'age'],
			items: [
				{ age: 40, first_name: 'Dickerson', last_name: 'Macdonald', last_name1: 'Macdonald' , last_name2: 'Macdonald'  },
				{ age: 21, first_name: 'Larsen', last_name: 'Shaw', last_name1: 'Macdonald' , last_name2: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald'  },
				{ age: 38, first_name: 'Jami', last_name: 'Carney', last_name1: 'Macdonald' , last_name2: 'Macdonald'  }
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