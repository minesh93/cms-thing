<template>
    <main id="claws">
        <sidebar />
        <div class="content">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
import sidebar from '../components/sidebar';
export default {
    components: {
        'sidebar': sidebar,
    }
}
</script>