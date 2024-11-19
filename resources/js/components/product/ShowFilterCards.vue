<template>
    <div class="container mt-4 mb-4">
        <div class="row gy-4">
            <div v-for="product in products" :key="product.id" class="col-md-3">
                <div class="card h-100 shadow-sm" @click="goToProduct(product.id)">
                    <img :src="product.image_url" class="card-img-top" alt="Book Image" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ product.title }}</h5>
                        <p class="card-text text-muted">{{ product.description }}</p>
                        <p class="product-price">
                            <span v-if="product.old_price" class="old-price">{{ product.old_price }} $</span>
                            {{ product.price }} $
                        </p>
                        <div class="mt-auto d-flex align-items-center">
                            <button class="btn btn-primary btn-lg fw-bold flex-grow-1 me-2" @click.stop="goToCart">
                                Buy
                            </button>
                            <button class="btn btn-outline-primary btn-icon" @click.stop="addToWishlist">
                                <i class="bi bi-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
        };
    },

    computed: {
        filterKeyFromStore() {
            return this.$store.state.filterKey;
        },
    },

    watch: {
        filterKeyFromStore() {
            this.products = this.productsFromStore();
        },
    },

    mounted() {
        this.products = this.$store.state.productsFromFilter || [];
    },

    methods: {
        goToCart() {
            console.log("cart");
        },
        goToProduct(id) {
            this.$router.push(`/product/show/${id}`);
        },
        addToWishlist() {
            console.log("wishlist");
        },

        productsFromStore() {
            return this.$store.state.productsFromFilter;
        },
    },
};
</script>
