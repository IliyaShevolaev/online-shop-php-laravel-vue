<template>
    <div v-if="!isLoading">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center">
                    <img :src="product.image_url" class="product-image" alt="Product Name">
                </div>

                <div class="col-md-6">
                    <h1 class="product-title">{{ product.title }}</h1>
                    <p class="product-price">{{ product.price }} $</p>
                    <p class="product-description">{{ product.description }}</p>

                    <div class="mt-3">
                        <span class="category-label">Category:</span>
                        <span class="category-name">{{ product.category.title }}</span>
                    </div>

                    <div class="mt-3">
                        <span v-for="(genre, index) in product.genres" :key="index">
                            <button class="btn btn-outline-primary btn-sm me-2">{{ genre.title }}</button>
                        </span>
                    </div>

                    <div class="gap-3 my-4">
                        <button class="btn btn-primary btn-lg fw-bold me-2 btn-buy">
                            <i class="bi bi-cart"></i> Buy
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-bookmarks fs-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div v-else>
        <p>Загрузка данных...</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        id: String,
    },

    data() {
        return {
            product: null,
            isLoading: true,
        }
    },

    mounted() {
        this.getProduct();
    },

    methods: {
        getProduct() {
            axios.get(`/api/products/show/${this.id}`)
                .then(res => {
                    this.product = res.data.data;
                    if (!this.product.genres) {
                        this.product.genres = [];
                    }
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
    },
}
</script>

<style scoped>
.product-image {
    width: 100%;
    max-width: 400px;
    height: 400px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
}

.product-title {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
}

.product-price {
    font-size: 1.5rem;
    font-weight: 600;
    color: #0066cc;
}

.product-description {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
}

.btn-buy {
    width: 50%;
    height: 65px;
    font-size: 2.0rem;
}

.btn-primary {
    background-color: #0066cc;
    border: none;
}

.btn-outline-primary {
    border-color: #0066cc;
    color: #0066cc;
}

.btn-outline-primary:hover {
    background-color: #0066cc;
    color: white;
}

.category-label {
    font-size: 1.2rem;
    font-weight: 600;
    color: #555;
    margin-right: 8px;
}

.category-name {
    font-size: 1.2rem;
    font-weight: 500;
    color: #0066cc;
    text-transform: capitalize;
}
</style>
