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

                <FindBar></FindBar>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item text-center">
                            <button @click.prevent="openAuthModal" class="nav-link active" aria-current="page">
                                <i class="bi bi-person fs-2"></i>
                                <div>Profile</div>
                            </button>
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

        <div v-if="showAuthModal" class="modal-backdrop">
            <AuthModal @close="closeAuthModal"></AuthModal>
        </div>

        <div v-if="showFilters" class="modal-backdrop">
            <FiltersModal :categories="this.categories" :genres="this.genres" ref="filtersModal"
                @close="closeFiltersModal">
            </FiltersModal>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import AuthModal from './AuthModal.vue';
import FiltersModal from './FiltersModal.vue';
import FindBar from './FindBar.vue';

export default {
    components: {
        AuthModal,
        FiltersModal,
        FindBar,
    },

    mounted() {
        this.getFiltersList();
    },

    data() {
        return {
            showFilters: false,
            genres: null,
            categories: null,

            showAuthModal: false,
        };
    },

    methods: {
        openFilters() {
            this.showFilters = true;
        },

        closeFiltersModal() {
            this.showFilters = false;
        },

        getFiltersList() {
            axios.get('/api/products/filter/list')
                .then(res => {
                    this.categories = res.data.categories;
                    this.genres = res.data.genres;
                });
        },

        openAuthModal() {
            let isAuth = localStorage.getItem('auth'); 

            if (isAuth) {
                this.$router.push({ name: 'page.profile' });
            } else {
                this.showAuthModal = true;
            }
        },

        closeAuthModal() {
            this.showAuthModal = false;
        },
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
</style>
