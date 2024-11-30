<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Filters</h5>
                <button type="button" class="btn-close" @click="closeFilters"><i class="bi bi-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="applyFilters">
                    <div class="mb-3">
                        <label class="form-label">Price Range</label>
                        <div class="d-flex align-items-center">
                            <input type="number" class="form-control me-2" placeholder="Min Price"
                                v-model.number="priceMin">
                            <input type="number" class="form-control" placeholder="Max Price" v-model.number="priceMax">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <select class="form-select" id="categories" v-model="filters.category">
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.title }}
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Genres</label>
                        <div class="d-flex flex-wrap">
                            <div v-for="genre in genres" :key="genre.id" class="form-check me-3">
                                <input class="form-check-input" type="checkbox" :id="`genre-${genre.id}`"
                                    :value="genre.id" v-model="filters.genres">
                                <label class="form-check-label" :for="`genre-${genre.id}`">
                                    {{ genre.title }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" @click="closeFilters">Close</button>
                        <button type="submit" class="btn btn-primary">Find</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: null,
            priceMin: null,
            priceMax: null,
            genres: null,

            filters: {
                price: null,
                category: null,
                genres: [],
            },
        }
    },

    mounted() {
        this.getFiltersList();
    },

    methods: {
        closeFilters() {
            this.$emit('close');
        },

        postFilter(data) {
            axios.post('/api/products/filter', data)
                .then(res => {
                    this.$store.commit('setProductsFromFilter', res.data.data);
                    this.$store.commit('incrementFilterKey');
                    this.$router.push({ name: 'product.filter' });
                });
        },

        applyFilters() {
            if (this.priceMin !== null || this.priceMax !== null) {
                this.price = {
                    from: this.priceMin,
                    to: this.priceMax,
                };
            }

            this.postFilter({
                price: this.price,
                category_id: this.filters.category,
                genres: this.filters.genres,
            });

            this.closeFilters();
        },

        getFiltersList() {
            axios.get('/api/products/filter/list')
                .then(res => {
                    this.categories = res.data.categories;
                    this.genres = res.data.genres;
                });
        },
    },
}
</script>

<style scoped>
.modal-dialog {
    background-color: white;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    padding: 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: none;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #004c99;
}

.btn-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #004c99;
    cursor: pointer;
}

.modal-body {
    margin-top: 1rem;
}
</style>