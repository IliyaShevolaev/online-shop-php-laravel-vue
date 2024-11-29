<template>
    <div>
        <input v-model="email" type="email" placeholder="Enter email..." class="form-control">
        <input v-model="password" type="password" placeholder="Enter password..." class="form-control">
        <button @click.prevent="login" class="btn btn-primary" type="submit">Submit</button>
        <button @click.prevent="test" class="btn btn-success" type="submit">Test</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    mounted() {
        this.authCheck();
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    'email': this.email,
                    'password': this.password,
                }).then(response => {
                    console.log(response);
                });
            });
        },

        test() {
            axios.get('/api/get').then(res => {console.log(res)});
        },

        authCheck() {
            axios.get('/api/is-authorized')
            .then(res => {
                console.log(res.data.value);
            });
        }
    },

    data() {
        return {
            isAuth: null,

            email: null, 
            password: null,
        }
    },
}
</script>

<style></style>