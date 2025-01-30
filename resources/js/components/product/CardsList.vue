<template>
    <div class="container mt-4 mb-4">
        <div class="row gy-4">
            <div v-for="product in products" class="col-md-3">
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
                            <button class="btn btn-primary btn-lg fw-bold flex-grow-1 me-2" @click.stop="addToCart(product)">
                                Buy
                            </button>
                            <button class="btn btn-outline-primary btn-icon" @click.stop="addToFavorites(product.id)">
                                <i :class="product.inFavorites? 'bi bi-bookmark-fill' : 'bi bi-bookmark'"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Notification ref="notification"></Notification>
</template>

<script>
import axios from 'axios';
import Notification from '../ui_elements/Notification.vue';

export default {
    props: {
        productsPath: String,
    },

    components: {
        Notification,
    },

    mounted() {
        this.getProducts();
    },

    methods: {
        goToProduct(id) {
            this.$router.push(`/product/show/${id}`);
        },

        addToCart(product) {
            let userCart = JSON.parse(localStorage.getItem('cart')) || [];

            if (!userCart.find(obj => obj.id === product.id)) {
                product['quantity'] = 1;
                userCart.push(product);
                localStorage.setItem('cart', JSON.stringify(userCart));

                this.notify('alert-success', 'Added to cart')
            } else {
                this.notify('alert-warning', 'Product is already in your cart')
            }

        },

        getProducts() {
            axios.get(`/api/products/${this.productsPath}`)
                .then(res => {
                    this.products = res.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        addToFavorites(id) {
            if (localStorage.getItem('auth')) {
                axios.post('/api/products/favorites/add', {
                product_id: id,
            }).then((res) => {
                if (res.data.already_exists) {
                    this.notify('alert-danger', 'Deleted from favorites');
                } else {
                    this.notify('alert-success', 'Added to your favorites')
                }

                let product = this.products.find(product => product.id === id);
                
                if (product) {
                    product.inFavorites = !product.inFavorites; 
                }
            });
            } else {
                this.notify('alert-warning', 'Authorization is required')
            }
        },

        notify(type, message) {
            this.$refs.notification.showNotification(type, message);
        },
    },

    data() {
        return {
            products: [],
        }
    },
};
</script>

<style>
.card {
    transition: transform 0.2s;
    height: 100%;
}

.card:hover {
    transform: scale(1.05);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.card-text {
    max-height: 3em;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.product-price {
    font-size: 1.0rem;
    font-weight: 600;
    color: #0066cc;
}

.old-price {
    color: red;
    text-decoration: line-through;
    margin-right: 10px;
}

.btn-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    font-size: 1.2rem;
}

.btn-icon i {
    font-size: 1.2rem;
}
</style>