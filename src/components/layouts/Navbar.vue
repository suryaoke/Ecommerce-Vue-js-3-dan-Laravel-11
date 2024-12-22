<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link class="navbar-brand" to="/">
                <img src="https://cdn.pixabay.com/photo/2014/04/02/11/16/shopping-305728_1280.png" alt="Logo" width="60"
                    height="60" />
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" to="/">
                            <i class="bi bi-house-door-fill"></i>
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" to="/register">
                            <i class="bi bi-person-add"></i>
                            Register
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" to="/login">
                            <i class="bi bi-box-arrow-right"></i>
                            Login
                        </router-link>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</template>

<script setup>

</script>

<style setup></style>