<template>
    <div>
        <b-container fluid="md">
            <b-form>
                <b-row class="justify-content-md-center" align-v="center">
                    <b-col></b-col>
                    <b-col md="6">

                        <b-form-group id="input-group-3" label="Choose your Facebook page" label-for="input-3">
                            <b-form-select
                            v-model="page"
                            :options="list_pages"
                            class="mb-3"
                            value-field="value"
                            text-field="name"
                            ></b-form-select>
                        </b-form-group>

                    </b-col>
                    <b-col></b-col>
                </b-row>
                
                <b-button @click.prevent="choose_page()" variant="success" class="text-right">Submit</b-button>
            </b-form>
        </b-container>
    </div>
</template>

<script type="text/javascript">
module.exports = {
    data() {
        return {
            toastCount: 0,
            list_pages: [],
            page: {
                id: "",
                name: "",
                category: ""
            }
        }
    },
    computed: {

    },
    methods: {
        makeToast(append = false) {
            this.toastCount++
            this.$bvToast.toast(`This is toast number ${this.toastCount}`, {
              title: 'BootstrapVue Toast',
              autoHideDelay: 5000,
              appendToast: append
          })
        },
        choose_page() {

            axios.post('/api/create_page', this.page)
            .then(response => {
                if( response.data['success'] == true ) {
                    this.$router.push("/")
                }
            })
        }
    },
    mounted() {
        axios.get('/api/choose_page', {
        })
        .then(response => {

            if( response.data['success'] == true ) {
                this.list_pages = response.data['data']
            } else {
                this.$router.push("/")
            }
            
        })
    }
};
</script>