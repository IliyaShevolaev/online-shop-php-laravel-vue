<template>
    <div class="d-flex justify-content-center w-50 mx-auto">
        <div class="d-flex w-50">
            <input v-model="this.findText" class="form-control me-2 rounded-pill" type="search" placeholder="Search"
                aria-label="Поиск">
            <button @click.prevent="findProducts" class="btn btn-primary rounded-pill" type="submit">
                <i class="bi bi-search fs-4"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            findText: '',
        }
    },

    methods: {
        findProducts() {
            this.postFilter({
                title: this.findText,
            });

            this.findText = '';
        },

        postFilter(data) {
            axios.post('/api/products/filter', data)
                .then(res => {
                    this.$store.commit('setProductsFromFilter', res.data.data);
                    this.$store.commit('incrementFilterKey');
                    this.$router.push({ name: 'product.filter' });
                });
        },
    },
}
</script>

<style scoped>
.custom-navbar .form-control {
    border-radius: 30px;
    padding: 10px;
}
</style>