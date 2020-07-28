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
						<b-table responsive hover :items="items" :fields="fields"></b-table>
					</b-col>
				</b-row>
			</b-card>
		</b-container>

		<b-modal
		centered
		id="createPostModal" 
		title="Add Post"
		ref="modal"
		@show="resetModal"
		@hidden="resetModal"
		>
			<form ref="form" @submit.stop.prevent="handleSubmit">
				<b-form-group
				:state="state.url"
				:invalid-feedback="state.message"
				>

					<b-form-input
					:disabled="load_iframe"
					id="posturl"
					v-model="post_url"
					:state="state.url"
					required
					placeholder="https://www.facebook.com/"
					aria-describedby="posturl-help"
					type="url"
					trim
					size="lg"
					></b-form-input>
					<b-form-text id="posturl-help">
						Facebook URL can be found on Facebook that post have been created.
					</b-form-text>
				</b-form-group>
			</form>

			<b-overlay
			:show="load_iframe"
			spinner-variant="primary"
			spinner-type="grow"
			spinner-small
			rounded="sm"
			>
				<b-embed
					v-if="iframe_url"
				    type="iframe"
				    aspect="16by9"
				    :src="iframe_url"
				  ></b-embed>

			</b-overlay>

			<template v-slot:modal-footer="{ ok, cancel }">
				<b-button size="sm" variant="dark" @click="resetModal()">
					Cancel
				</b-button>
				<b-button size="sm" variant="primary" @click="handleSubmit()">
					Add
				</b-button>
			</template>

			<b-toast id="check-fb-url-toast" variant="warning" title="Wrong URL format" auto-hide-delay="2000">
				The Facebook URL is Invalid, unable to get from Facebook.
			</b-toast>
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
				url: false,
				message: "Facebook URL not found"
			},
			post_url: "",
			post: {
				url: "",
				page_name: "",
				post_id: "",
				type: "",
				data: {}
			},
			iframe_url: "",
			load_iframe: false
		}
	},
	beforeDestroy() {
      // this.clearTimeout()
    },
    watch: {
    	post_url: function () {

    		var app_id = this.$store.state.env.fb_app_id

    		var string = this.post_url
    		// var valid_url = true
    		var error_msg = ""

    		this.state.url = true;

    		if( string.substring(0,24) == "https://www.facebook.com" ) {

    			var stringArr = string.split('/')

    			this.post.url = this.post_url
    			this.post.page_name = stringArr[3]
    			this.post.post_id = stringArr[5]
    			this.post.type = stringArr[4]

    			if( this.post.type != "videos" ) {

    				this.$bvToast.show('check-fb-url-toast')

    				return false;
    			}

    			this.load_iframe = true

				axios.post('/api/posts/check_valid_url', this.post)
				.then(response => {

					if( response.data.success === true ) {

						this.post.data = response.data.data

						this.iframe_url = "https://www.facebook.com/plugins/post.php?href=https://www.facebook.com/" + response.data.data.permalink_url + "&show_text=false&width=500&appId="+ app_id +"&height=250"


					} else {

						this.iframe_url = ""
						// valid_url = false
						if( response.data.message ) {
							error_msg = response.data.message
						} else {
							error_msg = response.data.data.message
						}

						this.post.data = []
						this.state.url = false;
						this.state.message = error_msg;
		    			this.$bvToast.show('check-fb-url-toast')
					}

					this.load_iframe = false
				})

    		} else {
    			this.state.url = false;
    		}
    	}
    },
	methods: {
		test_webhook() {
			axios.post('/api/webhook/create').then(function (response) {
				// console.log(response.data)
				// this.info = "2222"

				// console.log(this.info)
			})
		},
		handleSubmit() {
        // Exit when the form isn't valid
        
        if( this.post.data.length == 0 ) {
        	return false;
        }

        if (!this.checkFormValidity()) {
          return false;
        }

        axios.post('/api/posts/create', this.post)
        .then(response => {


        	if( response.data.success == true ) {

        		this.$bvToast.toast(response.data.message, {
        			title: "Success!!",
        			variant: "success",
        			solid: true
        		})

        		this.$router.push({ name: 'edit_post' , params: {id: response.data.data.id}});

        	} else {
        		this.$bvToast.toast(response.data.message, {
        			title: "Failed!!",
        			variant: "danger",
        			solid: true
        		})
        	}
        })


        this.$nextTick(() => {
          this.$bvModal.hide('modal-prevent-closing')
        })
      },
      resetModal() {
        this.post_url = ""
        this.iframe_url = ""
        this.state.url = null
      	this.$root.$emit('bv::hide::modal', 'createPostModal')
      },
      handleOk(bvModalEvt) {

        bvModalEvt.preventDefault()

        this.handleSubmit()
      },
      checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.state.url = valid
        return valid
      },
	},
	created() {

		// this.busy = false
		// this.post.url = ""

		// axios.get('/api/posts').then(function (response) {
		// 	// console.log(response.data)
		// 	// this.info = "2222"

		// 	// console.log(this.info)
		// })

	}
};
</script>