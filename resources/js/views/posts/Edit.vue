<template>
	<div>
		<b-container fluid class="mt-5">
			<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1" cols-xl="2">
				<b-col class="w-50 mb-3">
					<b-card border-variant="default" class="h-100">

						<b-card-title>Keywords<span class="h6 ml-1"><b-icon v-b-tooltip.hover title="Keyword allow your customer to placed order with you. Example: You add a keyword 'Fish' and your customer comment Fish + 1 as the keyword added." icon='question-circle' font-scale="1" shift-v="8" shift-h="-4"></b-icon></span></b-card-title>

						<b-form-tags :state="state" @input="resetInputValue" separator=" " v-model="keyword_tags" no-outer-focus class="mb-2">
							<template v-slot="{ tags, inputAttrs, inputHandlers, addTag }">

								<b-form-input
								v-bind="inputAttrs"
								v-on="inputHandlers"
								ref="new_keyword"
								v-model="new_keyword"
								placeholder="Add new keyword"
								class="form-control"
								trim
								:formatter="formatter"
								></b-form-input>

								<b-form-invalid-feedback :state="state">
									Duplicate tag value cannot be added again!
								</b-form-invalid-feedback>

								<ul
								v-if="keywords.length > 0"
								id="my-custom-tags-list"
								class="list-unstyled d-inline-flex flex-wrap mt-3"
								aria-live="polite"
								aria-atomic="false"
								aria-relevant="additions removals"
								>
									<b-card
									:bg-variant="tag.variant"
									v-for="(tag, index) in keywords"
									:key="index"
									tag="li"
									class="mt-1 mr-1"
									body-class="py-1"
									@click="findKeyword(tag)"
									>
										<strong>{{ tag.name }}</strong>
										<!-- <b-avatar @click="removeTag(tag.name)" variant="default" size="20" button icon="x-circle"></b-avatar> -->
									</b-card>
								</ul>
								<div class="mt-4 mb-3 text-center" v-else>
									<div>
										<b-icon icon="textarea-t" font-scale="7" @click="focusAddKeyword"></b-icon>
									</div>
									You havent add any keyword for this post yet.
								</div>
							</template>
						</b-form-tags>
					</b-card>
				</b-col>
				<b-col class="w-50 mb-3">
					<b-card class="h-100">
						<b-form @submit="edit_keyword" @reset="create_keyword">
							<b-row>
								<b-col>
									<b-form-group
								        id="input-group-1"
								        label="Keyword"
								        label-for="name"
								        description="The keyword must be unique on every post."
								      >
								        <b-form-input
								          id="name"
								          v-model="selected_keyword.name"
								          type="text"
								          required
								          placeholder="Enter a keyword"
								        ></b-form-input>
								      </b-form-group>
								</b-col>
							</b-row>
							<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1" cols-xl="2">
								<b-col class="mb-3">
									<b-form-checkbox
								      id="checkbox-1"
								      v-model="selected_keyword.is_inventory"
								      value="1"
								      unchecked-value="0"
								      class="mb-2"
								    >
								      Track quantity
								    </b-form-checkbox>
									<b-form-input v-if="selected_keyword.is_inventory == 1" type="text" placeholder="Quantity" v-model="selected_keyword.inventory" required></b-form-input>
									<b-form-text v-if="selected_keyword.is_inventory == 0" >This keyword quantity is infinity.</b-form-text>
								</b-col>
								<b-col>
									<b-form-checkbox
								      id="checkbox-1"
								      v-model="selected_keyword.free_shipping"
								      value="1"
								      unchecked-value="0"
								      class="mb-2"
								    >
								      This keyword is free shipping.
								    </b-form-checkbox>
								</b-col>
<!-- 								<b-col>
									<b-form-checkbox
								      id="checkbox-2"
								      v-model="selected_keyword.is_published"
								      value="1"
								      unchecked-value="0"
								      class="mb-2"
								    >
								      Publish now? 
								    </b-form-checkbox>
									<b-form-input v-if="selected_keyword.is_published == 1" type="text" placeholder="Quantity" v-model="selected_keyword.published_at" required></b-form-input>
									<b-form-text v-if="selected_keyword.is_published == 0" >This keyword quantity is infinity.</b-form-text>
								</b-col> -->
							</b-row>
							<div class="text-right">
	      						<b-button class="mt-3" type="reset" variant="outline-danger">Later</b-button>
								<b-button class="mt-3" type="submit" variant="primary">Publish now</b-button>
							</div>
						</b-form>
					</b-card>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>
<script type="text/javascript">
export default {
	data() {
		return {
			post: {},
			keyword_tags: [],
			keywords: [],
			new_keyword: "",
			selected_keyword: {
				name: "",
				free_shipping: 1,
				inventory: 0,
				is_inventory: 1,
				is_published: 1,
				published_at: ""
			}
		}
	},
	computed: {
      state() {
        return this.keyword_tags.indexOf(this.new_keyword.trim()) > -1 ? false : null
      }
    },
    watch: {
    	keyword_tags: function() {

    		var keywords = this.keywords
    		var tags = this.keyword_tags
    		var keyword_names = []

    		if( keywords.length > 0 ) {
    			keywords.forEach(function(keyword, key) {
    				keyword_names.push(keyword.name)
    			});

    			tags.forEach(function(tag, key) {
    				
    				if( keyword_names.includes(tag) === false ) {
    					keywords.push({id: '', name: tag, variant: 'warning'})
    				}
    			});
    		} else {
    			this.keyword_tags.forEach(function(tag, key) {
    				keywords.push({id: '', name: tag, variant: 'default'})
    			});
    		}
    	},
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
		create_keyword() {
			axios.post('/api/posts/keywords/new').then(function (response) {
				console.log(response.data.message['name'])
			})
		},
		findKeyword(arr) {
			console.log(arr)
		},
		onReset() {

		},
		focusAddKeyword() {
			this.$refs.new_keyword.focus()
		},
		removeTag(tag_target, confirmed = null) {
			var keywords = this.keywords
    		var tags = this.keyword_tags

    		this.$bvModal.msgBoxConfirm('Sure to delete ' + tag_target + '?', {
    			title: 'Delete keyword?',
    			size: 'sm',
    			buttonSize: 'sm',
    			okVariant: 'danger',
    			okTitle: 'YES',
    			cancelTitle: 'NO',
    			footerClass: 'p-2',
    			hideHeaderClose: false,
    			centered: true
    		})
    		.then(value => {

    			if( value === true ) {
	    			tags.forEach(function(tag, key) {

	    				if( tag_target == tag ) {
	    					tags.splice(tags.indexOf(tag_target), 1);
	    				}
	    			});

	    			keywords.forEach(function(keyword, key) {

	    				if( tag_target == keyword.name ) {
	    					keywords.splice(keywords.indexOf(tag_target), 1);
	    				}
	    			});
    			}

    		})
    		.catch(err => {

    		})
		},
		resetInputValue() {
			this.new_keyword = ''
		},
		formatter(value) {
	    	return value.toLowerCase()
	    },
		inputHandlers(tag) {
			console.log(this.new_keyword)
		},
		test_webhook() {
			axios.post('/api/webhook/create').then(function (response) {
				// console.log(response.data)
				// this.info = "2222"

				// console.log(this.info)
			})
		},
		edit_keyword() {

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
		}
	},
	mounted() {

		// axios.get('/api/posts/'+ this.$route.params.id)
		// .then(response => {
		// 	if( response.data.success == true ) {
		// 		this.post = response.data.data
		// 	} else {
		// 		this.$bvToast.toast(response.data.message, {
		// 			title: "Failed!!",
		// 			variant: "danger",
		// 			solid: true
		// 		})
		// 	}
		// })

		axios.get('/api/webhook/callback')
		.then(response => {

		})
	}
};
</script>