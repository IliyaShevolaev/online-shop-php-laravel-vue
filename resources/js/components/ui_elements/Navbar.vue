<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <router-link to="/" class="navbar-brand">
                    SmartMart
                </router-link>

                <button class="btn btn-light rounded-pill me-3 btn-catalog" @click="openFilters">
                    Catalog
                </button>

                <div class="d-flex justify-content-center w-50 mx-auto">
                    <form class="d-flex w-50">
                        <input class="form-control me-2 rounded-pill" type="search" placeholder="Search"
                            aria-label="Поиск">
                        <button class="btn btn-primary rounded-pill" type="submit">
                            <i class="bi bi-search fs-4"></i>
                        </button>
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item text-center">
                            <router-link to="/profile" class="nav-link active" aria-current="page">
                                <i class="bi bi-person fs-2"></i>
                                <div>Profile</div>
                            </router-link>
                        </li>
                        <li class="nav-item text-center">
                            <router-link to="/cart" class="nav-link active" aria-current="page">
                                <i class="bi bi-cart2 fs-2"></i>
                                <div>Cart</div>
                            </router-link>
                        </li>
                        <li class="nav-item text-center">
                            <router-link to="/favorites" class="nav-link active" aria-current="page">
                                <i class="bi bi-bookmarks fs-2"></i>
                                <div>Favorites</div>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div v-if="showFilters" class="modal-backdrop">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Filters</h5>
                        <button type="button" class="btn-close" @click="closeFilters"><i
                                class="bi bi-x-circle"></i></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="applyFilters">
                            <div class="mb-3">
                                <label class="form-label">Price Range</label>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="form-control me-2" placeholder="Min Price"
                                        v-model.number="priceMin">
                                    <input type="number" class="form-control" placeholder="Max Price"
                                        v-model.number="priceMax">
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
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            showFilters: false,
            categories: null,
            priceMin: null,
            priceMax: null,
            genres: null,

            filters: {
                price: null,
                category: null,
                genres: [],
            },
        };
    },

    mounted() {
        this.getFiltersList();
    },

    methods: {
        openFilters() {
            this.showFilters = true;
        },
        closeFilters() {
            this.showFilters = false;
        },
        applyFilters() {
            if (this.priceMin !== null || this.priceMax !== null) {
                this.price = {
                    from: this.priceMin,
                    to: this.priceMax,
                };
            }

            axios.post('/api/products/filter', {
                price: this.price,
                category_id: this.filters.category,
                genres: this.filters.genres,
            }).then(res => {
                this.$store.commit('setProductsFromFilter', res.data.data);
                this.$store.commit('incrementFilterKey'); 
                this.$router.push({ name: 'product.filter' });
            });

            this.closeFilters();
        },

        getFiltersList() {
            axios.get('/api/products/filter/list')
                .then(res => {
                    this.categories = res.data.categories;
                    this.genres = res.data.genres;
                });
        }
    },

};

</script>

<style scoped>
.custom-navbar .navbar-brand:focus {
    outline: none;
    box-shadow: none;
}

.custom-navbar {
    background-color: #004c99 !important;
    border-bottom: 2px solid #0066cc;
}

.custom-navbar .navbar-brand {
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
    color: #ffffff;
    text-transform: uppercase;
}

.custom-navbar .navbar-nav .nav-link {
    color: #ffffff;
    font-weight: 500;
    transition: all 0.3s ease;
}

.custom-navbar .navbar-nav .nav-link:hover {
    color: #003366;
    text-decoration: none;
}

.custom-navbar .form-control {
    border-radius: 30px;
    padding: 10px;
}

.custom-navbar .btn-primary {
    border-radius: 30px;
    padding: 10px 20px;
    background-color: #0066cc;
    color: white;
    border: none;
}

.custom-navbar .btn-primary:hover {
    background-color: #004c99;
    color: white;
}

.btn-catalog {
    padding: 10px 20px;
    font-weight: 500;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
    border: 2px solid #ffffff;
}

.btn-catalog:hover {
    background-color: #ffffff;
    color: #004c99;
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}

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
