<template>
	<div>
		<div class=" mb-5 mr-auto" >Height 100%</div>
  		<hr style="width:100%;text-align:left;margin-left:0">
		<b-container fluid="lg">
			<b-card 
			footer="Card Footer"
			footer-tag="footer"
			>
			<b-row class="text-center">
				<b-col>

				</b-col>
			</b-row>
			<b-row class="text-center">
				<b-col>
					<b-table hover :items="items" :fields="fields"></b-table>
				</b-col>
			</b-row>
		</b-card>
	</b-container>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
</template>
<script type="text/javascript">
export default {
	data() {
		return {
			info: "asdasd",
			fields: ['first_name', 'last_name', 'last_name1', 'last_name2', 'last_name3', 'age'],
			items: [
				{ age: 40, first_name: 'Dickerson', last_name: 'Macdonald', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 21, first_name: 'Larsen', last_name: 'Shaw', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 89, first_name: 'Geneva', last_name: 'Wilson', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  },
				{ age: 38, first_name: 'Jami', last_name: 'Carney', last_name1: 'Macdonald' , last_name2: 'Macdonald' , last_name3: 'Macdonald'  }
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