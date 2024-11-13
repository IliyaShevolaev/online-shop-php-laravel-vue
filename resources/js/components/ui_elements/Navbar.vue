<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <router-link to="/" class="navbar-brand">
                    SmartMart
                </router-link>

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
    </div>

    <div class="content">
        <router-view></router-view>
    </div>

</template>

<script>
export default {

}
</script>

<style scoped>

.custom-navbar .navbar-brand:focus {
    outline: none;
    box-shadow: none;
}

.content {
    margin-top: 120px;
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

.custom-navbar .navbar-toggler-icon {
    background-color: #ffffff;
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
</style>