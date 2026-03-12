<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import { onMounted } from "vue";
import AppLayout from '@/layouts/AppLayout.vue';
import { echo } from "@/lib/echo";
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';

const page = usePage()

const user = page.props.auth?.user

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
];
onMounted(() => {


    echo.channel("user-logging")
        .listen("LoggedIn", (e: any) => {
            console.log("User logged in:", e.user.name);
        });
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="page-bg">

            <div class="hero">

                <div class="hero-content">

                    <h1>
                        Win Amazing Prizes with Our
                        <span>Lucky Draw System</span>
                    </h1>

                    <p>
                        Join exciting lucky draws and stand a chance to win incredible
                        cash prizes and amazing products.
                    </p>

                    <div class="buttons">

                        <template v-if="user">
                            <button class="btn cash">💰 Join Cash Draw</button>
                            <button class="btn product">🎁 Join Product Draw</button>
                        </template>

                        <template v-else>
                            <button class="btn start">👤 Get Started</button>
                            <button class="btn login">🔑 Login</button>
                        </template>

                    </div>

                </div>

            </div>

            <!-- Stats -->

            <div class="stats-wrapper">

                <div class="stats-card">
                    <div class="icon">👥</div>
                    <h2>1000</h2>
                    <p>Happy Users</p>
                </div>

                <div class="stats-card">
                    <div class="icon">🎲</div>
                    <h2>111</h2>
                    <p>Lucky Draws</p>
                </div>

                <div class="stats-card">
                    <div class="icon">🏆</div>
                    <h2>2002</h2>
                    <p>Winners</p>
                </div>

                <div class="stats-card">
                    <div class="icon">⭐</div>
                    <h2>100%</h2>
                    <p>Fair & Secure</p>
                </div>

            </div>

            <!-- Product Achievements -->

            <section class="product-achievements">

                <div class="section-header">
                    <h2>Product Draw Achievements</h2>
                    <p>See how many amazing products our users have won</p>
                </div>

                <div class="achievements-grid">

                    <div class="achievement-card">
                        <div class="achievement-icon green">🎁</div>
                        <h3>100</h3>
                        <p>Product Winners</p>
                    </div>

                    <div class="achievement-card">
                        <div class="achievement-icon blue">💰</div>
                        <h3>Rs. 1000</h3>
                        <p>Total Value Won</p>
                    </div>

                    <div class="achievement-card">
                        <div class="achievement-icon pink">⭐</div>
                        <h3>Rs. 202</h3>
                        <p>Average Product Value</p>
                    </div>

                </div>

            </section>

        </div>

    </AppLayout>
</template>

<style scoped>

.page-bg{
    min-height:100vh;

    background:linear-gradient(
        135deg,
        #6366f1,
        #4f46e5,
        #312e81
    );

    padding-bottom:80px;

    color:white;
}

/* hero */

.hero{
    padding:80px 20px;
    text-align:center;
}

.hero-content{
    max-width:900px;
    margin:auto;
}

h1{
    font-size:48px;
    font-weight:800;
}

h1 span{
    color:#FFD700;
}

p{
    opacity:.9;
    margin-top:20px;
}

/* buttons */

.buttons{
    margin-top:40px;
    display:flex;
    justify-content:center;
    gap:15px;
    flex-wrap:wrap;
}

.btn{
    padding:14px 26px;
    border-radius:10px;
    border:none;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    transform:translateY(-4px);
}

.cash{
    background:linear-gradient(45deg,#ff7a18,#ff3d00);
    color:white;
}

.product{
    background:#22c55e;
    color:white;
}

.start{
    background:#f59e0b;
    color:white;
}

.login{
    background:rgba(255,255,255,0.15);
    color:white;
}

/* stats */

.stats-wrapper{
    margin-top:60px;

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));

    gap:25px;

    max-width:1000px;
    margin-left:auto;
    margin-right:auto;
}

.stats-card{

    background:rgba(255,255,255,0.1);

    backdrop-filter:blur(10px);

    padding:30px;

    border-radius:18px;

    text-align:center;

    transition:.3s;

}

.stats-card:hover{
    transform:translateY(-6px);
}

.icon{
    font-size:28px;
}

/* achievements */

.product-achievements{
    margin-top:100px;
    text-align:center;
}

.section-header h2{
    font-size:32px;
}

.section-header p{
    opacity:.8;
}

.achievements-grid{

    margin-top:40px;

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

    gap:30px;

    max-width:1000px;
    margin-left:auto;
    margin-right:auto;
}

.achievement-card{

    background:white;

    color:#333;

    padding:35px;

    border-radius:16px;

    box-shadow:0 8px 20px rgba(0,0,0,0.15);

    transition:.3s;

}

.achievement-card:hover{
    transform:translateY(-6px);
}

.achievement-icon{

    width:55px;
    height:55px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:12px;

    color:white;

    font-size:24px;

    margin: auto auto 15px;
}

.green{background:#22c55e;}
.blue{background:#3b82f6;}
.pink{background:#ec4899;}

</style>
