<template>
    <div>
        <h1>My First Vue Single Page App</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ path: '/hello' }">Hello World</router-link>
            <router-link :to="{ name: 'categories.index' }">Categories</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
