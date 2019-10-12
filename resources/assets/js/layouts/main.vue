<template>
    <main id="claws">
        <sidebar />
        <div class="content">
            <div class="row">
                <div class="col-xs-2">
                    <h1>H1 - Main</h1>
                    <h2>H2 - Main</h2>
                    <h3>H3 - Main</h3>
                </div>
                <div class="col-xs-1">
                </div>
                <div class="col-xs-1">
                </div>
            </div>
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