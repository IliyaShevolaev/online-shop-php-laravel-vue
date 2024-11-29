<template>
    <div>
        <h1>HEY</h1>
    </div>
</template>

<script>
import axios from 'axios';

export default {

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