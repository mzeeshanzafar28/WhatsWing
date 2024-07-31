<template>
    <section id="home-section">
        <div class="container">
            <h1>Welcome to Our Website</h1>
            <p>A brief description of your services or product.</p>
            <Button label="Learn More" />
        </div>
    </section>
</template>

<script>
import Button from 'primevue/button';

export default {
    components: {
        Button
    }
}
</script>

<style scoped>
#home-section {
    padding: 60px 0;
    background-color: #f0f0f0;
    text-align: center;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

p {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 40px;
}
</style>