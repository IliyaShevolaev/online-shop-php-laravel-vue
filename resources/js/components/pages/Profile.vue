<template>
    <div>
        <h1>HEY</h1>
        <button @click.prevent="logout" class="btn btn-outline-danger">Log out</button>
    </div>
</template>

<script>
import axios from 'axios';


export default {

    methods: {
        logout() {
            axios.post('/logout')
            .then(() => {
                this.$router.push({name: 'page.main'});
            });
        }
    },

    data() {
        return {
            
        }
    },
}
</script>

<style></style>