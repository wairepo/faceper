<template>
<div>
    <div class="container">
<!--         <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control is-invalid" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control is-invalid" name="password" required autocomplete="current-password">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <button v-on:click="facebook_login()" class="btn btn-primary">Login with Facebook</button>
    </div>
    
</div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            info: ""
        }
    },
    methods: {
        facebook_login: function (event) {

            axios.get('/redirect', {
            })
            .then(function (response) {
                console.log(response);
            })
        }
    },
    mounted() {
        // axios.get('/api/livenow').then(response => (

        //     console.log(response.data)

        //     ))

    }
};
</script>