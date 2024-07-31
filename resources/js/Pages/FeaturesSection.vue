<template>
    <section id="features-section">
        <div class="container">
            <h2>Our Features</h2>
            <div class="features-list">
                <div class="feature">
                    <i class="pi pi-check"></i>
                    <span>Feature 1</span>
                </div>
                <div class="feature">
                    <i class="pi pi-check"></i>
                    <span>Feature 2</span>
                </div>
                <!-- Add more features as needed -->
            </div>
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
#features-section {
    padding: 80px 0;
    background-color: #fff;
    text-align: center;
}

h2 {
    font-size: 2.5rem;
    margin-bottom: 40px;
}

.features-list {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.feature {
    display: flex;
    align-items: center;
}

.feature i {
    font-size: 1.5rem;
    color: #4CAF50;
    margin-right: 10px;
}

.feature span {
    font-size: 1.5rem;
    color: #333;
}
</style>