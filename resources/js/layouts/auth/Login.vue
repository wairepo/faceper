<template>
<div>
    <div class="container">
        
        <div>
            <b-button v-b-modal.modal-center class="none"></b-button>

            <b-modal id="modal-center" centered title="Faceper Login" 
            hide-footer 
            hide-header-close 
            visible 
            no-close-on-backdrop 
            no-close-on-esc>

            <b-form @submit="onSubmit">

                <b-form-group id="input-group-1">
                    <b-form-input
                    id="input-1"
                    v-model="form.email"
                    type="email"
                    required
                    placeholder="邮件"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-2">
                    <b-form-input
                    id="input-2"
                    v-model="form.password"
                    type="password"
                    required
                    placeholder="密码"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-3">
                    <b-button type="submit" variant="primary" block>Login</b-button>
                </b-form-group>

                <b-form-group id="input-group-4">
                    <span class="separator">OR</span>
                </b-form-group>

                <b-form-group id="input-group-5">
                    <b-button v-on:click="facebook_login()" variant="primary" block>Login with Facebook</b-button>
                </b-form-group>
            </b-form>
            </b-modal>
        </div>
    </div>
    
</div>
</template>
<style type="text/css">
.none {
    display: none;
}
.separator {
    display: flex;
    align-items: center;
    text-align: center;
}
.separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #000;
}
.separator::before {
    margin-right: .25em;
}
.separator::after {
    margin-left: .25em;
}
</style>
<script type="text/javascript">
export default {
    data() {
        return {
            form: {
                email: "",
                password: ""
            }
        }
    },
    methods: {
        facebook_login: function (event) {

            axios.get('/redirect', {
            })
            .then(function (response) {
                // console.log(response);
            })
        },
        onSubmit(evt) {
            evt.preventDefault()
            alert(JSON.stringify(this.form))
        },
    },
    mounted() {

    }
};
</script>