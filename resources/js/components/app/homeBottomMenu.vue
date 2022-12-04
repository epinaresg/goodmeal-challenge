<script>
export default {
    props: ["active"],
};
</script>

<template>
    <div class="bottomMenuContainer">
        <div class="row">
            <div class="col-4">
                <router-link to="/">
                    <i class="fa-solid fa-house"></i>
                    <span>Inicio</span>
                </router-link>
            </div>
            <div class="col-4">
                <router-link to="/orders">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>Ordenes</span>
                </router-link>
            </div>
            <div class="col-4">
                <router-link to="/profile"
                    ><i class="fa-solid fa-user"></i>
                    <span>Perfil</span>
                </router-link>
            </div>
        </div>
    </div>
</template>
