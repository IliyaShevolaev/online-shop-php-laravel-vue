<template>
    <div class="container mt-4 mb-4">
        <div v-if="cart.length === 0" class="text-center">
            <h3>Your cart is empty</h3>
        </div>

        <div v-else>
            <div class="row gy-4">
                <div v-for="(item, index) in cart" :key="item.id" class="col-md-12">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img :src="item.image_url" class="card-img-top" />
                            </div>
                            <div class="col-md-9">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ item.title }}</h5>
                                    <p class="card-description">{{ item.description }}</p>
                                    <p class="product-price">
                                        <span v-if="item.old_price" class="old-price">{{ item.old_price }} $</span>
                                        {{ item.price }} $
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-outline-primary me-2" @click="decreaseQuantity(index)"
                                            :disabled="item.quantity <= 1">-</button>
                                        <span class="me-2 fs-4">{{ item.quantity }}</span>
                                        <button class="btn btn-outline-primary me-2"
                                            @click="increaseQuantity(index)">+</button>
                                        <button class="btn btn-danger ms-auto" @click="removeFromCart(index)">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <h4>Total: {{ totalPrice }} $</h4>
                <button @click="makeOrder" class="btn btn-success">Proceed to Checkout</button>
            </div>
        </div>
    </div>

    <Notification ref="notification"></Notification>
</template>

<script>
import axios from 'axios';
import Notification from '../ui_elements/Notification.vue';

export default {
    data() {
        return {
            cart: this.getCart(),
        };
    },

    components: {
        Notification,
    },

    computed: {
        totalPrice() {
            return this.cart.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);
        },
    },

    methods: {
        getCart() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.sort((a, b) => a.id - b.id); 
            return cart;
        },

        updateCart() {
            localStorage.setItem("cart", JSON.stringify(this.cart));
        },

        increaseQuantity(index) {
            this.cart[index].quantity += 1;
            this.updateCart();
        },

        decreaseQuantity(index) {
            if (this.cart[index].quantity > 1) {
                this.cart[index].quantity -= 1;
                this.updateCart();
            }
        },

        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.updateCart();
        },

        makeOrder() {
            console.log(this.cart);
            if (localStorage.getItem('auth')) {
                axios.get('/api/profile').then(res => {
                    let user = res.data.data;
                    if (user.address !== null && user.age !== null) {
                        let productsIdArray = [];
                        let productsQuantityArray = [];

                        this.cart.forEach(product => {
                            productsIdArray.push(product.id);
                            productsQuantityArray.push(product.quantity);
                        });

                        axios.post("/api/orders/create", {
                            'productsIdArray': productsIdArray,
                            'productsQuantityArray': productsQuantityArray,
                        }).then(res => {
                            localStorage.setItem('cart', JSON.stringify([]));
                            this.cart = this.getCart();
                            this.updateCart();
                        });

                    } else {
                        this.notify('alert-warning', 'Fill profile first');
                    }
                })
            } else {
                this.notify('alert-warning', 'Authorization is required');
            }

        },

        notify(type, message) {
            this.$refs.notification.showNotification(type, message);
        },
    },

    watch: {
        cart: {
            handler() {
                this.updateCart();
            },
            deep: true,
        },
    },
};
</script>

<style scoped>
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

.card-description {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
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

.btn-outline-primary {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.btn-danger {
    width: 100px;
}

h4 {
    font-size: 1.5rem;
    font-weight: bold;
}
</style>