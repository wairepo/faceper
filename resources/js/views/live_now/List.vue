<template>
	<div>
		<b-container fluid="lg">
			<b-row align-h="between" class="">
				<b-col cols="auto" class="mr-auto p-3"><h1>All Posts<b-button squared @click="test_webhook()">Test Webhook</b-button></h1></b-col>
				<b-col cols="auto" class="p-3"><b-button squared variant="primary" v-b-modal.createPostModal>Add Post</b-button></b-col>
			</b-row>
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

		<b-modal
		centered
		id="createPostModal" 
		title="Add new Post"
		ref="modal"
		@show="resetModal"
		@hidden="resetModal"
		>
			<form ref="form" @submit.stop.prevent="handleSubmit">
				<b-form-group
				:state="state.url"
				invalid-feedback="Facebook URL not found"
				>
					<b-overlay :show="busy" rounded="lg" opacity="0.6">
						<template v-slot:overlay>
							<div class="d-flex align-items-center">
								<b-spinner small type="grow" variant="secondary"></b-spinner>
								<b-spinner type="grow" variant="dark"></b-spinner>
								<b-spinner small type="grow" variant="secondary"></b-spinner>
								<span class="sr-only">Please wait...</span>
							</div>
						</template>
						<b-form-input
						:disabled="busy"
						id="posturl"
						v-model="post.url"
						:state="state.url"
						required
						placeholder="Paste Facebook URL here"
						aria-describedby="posturl-help"
						type="url"
						trim
						size="lg"
						></b-form-input>

					</b-overlay>
					<b-form-text id="posturl-help">
						Facebook URL can be found on Facebook that post have been created.
					</b-form-text>
				</b-form-group>
			</form>
			<template v-slot:modal-footer="{ ok, cancel }">
				<b-button size="sm" variant="dark" @click="resetModal()">
					Cancel
				</b-button>
				<b-button size="sm" variant="primary" @click="handleSubmit()">
					Add
				</b-button>
			</template>
		</b-modal>
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
			fields: ['first_name', 'last_name', 'last_name1', 'last_name2', 'last_name3', 'age'], // Testing purpose
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
			], // Testing purpose
			state: {
				url: false
			},
			post: {
				url: ""
			},
			busy: false
		}
	},
	beforeDestroy() {
      this.clearTimeout()
    },
	methods: {
		test_webhook() {
			axios.post('/api/webhook/create').then(function (response) {
				console.log(response.data)
				// this.info = "2222"

				// console.log(this.info)
			})
		},
		handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return false;
        }

        console.log(this.post.url)

        // Push the name to submitted names
        // this.submittedNames.push(this.post.url)
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-prevent-closing')
        })
      },
      resetModal() {
        this.post.url = ''
        this.state.url = null
      this.$root.$emit('bv::hide::modal', 'createPostModal')
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.state.url = valid
        return valid
      },
	},
	created() {

		this.busy = false
		this.post.url = ""

		axios.get('/api/posts').then(function (response) {
			console.log(response.data)
			// this.info = "2222"

			// console.log(this.info)
		})

	}
};
</script>