<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { echo } from '@/lib/echo';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';

const page = usePage();
const user = page.props.auth?.user;

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
];

// Lucky Draw state
const selected = ref<'cash' | 'product' | null>(null);

const cashFeatures = [
    'Instant cash transfers to your account',
    'No waiting time for prize delivery',
    'Use your winnings however you want',
];

const productFeatures = [
    'Exclusive and limited edition products',
    'High-value electronics and gadgets',
    'Fast shipping to your doorstep',
];

function handleJoin(type: 'cash' | 'product') {
    if (!user) {
        router.visit('/login');
        return;
    }
    router.visit(`/draws/${type}`);
}

onMounted(() => {
    echo.channel('user-logging').listen('LoggedIn', (e: any) => {
        console.log('User logged in:', e.user.name);
    });
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="page-bg">

            <!-- ───────────── HERO ───────────── -->
            <section class="hero">
                <div class="hero-content">
                    <h1>
                        Win Amazing Prizes with Our
                        <span class="highlight">Lucky Draw System</span>
                    </h1>
                    <p class="hero-desc">
                        Join exciting lucky draws and stand a chance to win incredible
                        cash prizes and amazing products.
                    </p>

                    <div class="buttons">
                        <template v-if="user">
                            <button class="btn cash" @click="handleJoin('cash')">💰 Join Cash Draw</button>
                            <button class="btn product" @click="handleJoin('product')">🎁 Join Product Draw</button>
                        </template>
                        <template v-else>
                            <button class="btn start" @click="router.visit('/register')">👤 Get Started</button>
                            <button class="btn login" @click="router.visit('/login')">🔑 Login</button>
                        </template>
                    </div>
                </div>
            </section>

            <!-- ───────────── STATS ───────────── -->
            <div class="stats-wrapper">
                <div class="stats-card">
                    <div class="icon">👥</div>
                    <h2>1,000</h2>
                    <p>Happy Users</p>
                </div>
                <div class="stats-card">
                    <div class="icon">🎲</div>
                    <h2>111</h2>
                    <p>Lucky Draws</p>
                </div>
                <div class="stats-card">
                    <div class="icon">🏆</div>
                    <h2>2,002</h2>
                    <p>Winners</p>
                </div>
                <div class="stats-card">
                    <div class="icon">⭐</div>
                    <h2>100%</h2>
                    <p>Fair & Secure</p>
                </div>
            </div>

            <!-- ───────────── PRODUCT ACHIEVEMENTS ───────────── -->
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
                        <h3>Rs. 1,000</h3>
                        <p>Total Value Won</p>
                    </div>
                    <div class="achievement-card">
                        <div class="achievement-icon pink">⭐</div>
                        <h3>Rs. 202</h3>
                        <p>Average Product Value</p>
                    </div>
                </div>
            </section>

            <!-- ───────────── LUCKY DRAW TYPE CHOOSER ───────────── -->
            <section class="lucky-draw-section">

                <div class="draw-header">
                    <h2 class="draw-title">Choose Your Lucky Draw Type</h2>
                    <p class="draw-subtitle">We offer two exciting types of lucky draws to suit your preferences</p>
                </div>

                <div class="cards-grid">

                    <!-- Cash Draws Card -->
                    <div
                        class="draw-card"
                        :class="{ 'card-selected-cash': selected === 'cash' }"
                        @click="selected = 'cash'"
                    >
                        <!-- glow blob -->
                        <div class="card-glow glow-orange"></div>

                        <div class="card-icon icon-cash">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                 fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>

                        <h3 class="card-title">Cash Draws</h3>
                        <p class="card-subtitle">Win instant cash prizes and build your wealth</p>

                        <ul class="features-list">
                            <li v-for="(feature, i) in cashFeatures" :key="i" class="feature-item">
                                <span class="check-icon check-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                                         fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </span>
                                <span>{{ feature }}</span>
                            </li>
                        </ul>

                        <button class="draw-btn btn-cash" @click.stop="handleJoin('cash')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            {{ user ? 'Join Cash Draw' : 'Login to Join' }}
                        </button>
                    </div>

                    <!-- Product Draws Card -->
                    <div
                        class="draw-card"
                        :class="{ 'card-selected-green': selected === 'product' }"
                        @click="selected = 'product'"
                    >
                        <!-- glow blob -->
                        <div class="card-glow glow-green"></div>

                        <div class="card-icon icon-product">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                 fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 12 20 22 4 22 4 12"/>
                                <rect x="2" y="7" width="20" height="5"/>
                                <line x1="12" y1="22" x2="12" y2="7"/>
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                            </svg>
                        </div>

                        <h3 class="card-title">Product Draws</h3>
                        <p class="card-subtitle">Win exclusive products and amazing items</p>

                        <ul class="features-list">
                            <li v-for="(feature, i) in productFeatures" :key="i" class="feature-item">
                                <span class="check-icon check-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                                         fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </span>
                                <span>{{ feature }}</span>
                            </li>
                        </ul>

                        <button class="draw-btn btn-product" @click.stop="handleJoin('product')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            {{ user ? 'Join Product Draw' : 'Login to Join' }}
                        </button>
                    </div>

                </div>
            </section>

            <!-- ───────────── PAYMENT METHODS ───────────── -->
            <section class="payment-section">
                <div class="payment-inner">
                    <div class="section-header">
                        <h2>
                            <span class="secure-badge">Secure</span>
                            Payment Methods
                        </h2>
                        <p>We accept multiple secure payment options for your convenience</p>
                    </div>

                    <div class="payment-grid">

                        <!-- JazzCash -->
                        <div class="payment-card">
                            <div class="payment-icon bg-red">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                     fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                    <line x1="12" y1="18" x2="12.01" y2="18"/>
                                </svg>
                            </div>
                            <h4>JazzCash</h4>
                            <p>Fast and secure mobile payments in Pakistan</p>
                        </div>

                        <!-- EasyPaisa -->
                        <div class="payment-card payment-card--featured">
                            <div class="payment-icon bg-green">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                     fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                    <line x1="12" y1="18" x2="12.01" y2="18"/>
                                </svg>
                            </div>
                            <h4>EasyPaisa</h4>
                            <p>Convenient mobile payment solution</p>
                        </div>

                        <!-- Credit Cards -->
                        <div class="payment-card">
                            <div class="payment-icon bg-purple">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                     fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                    <line x1="1" y1="10" x2="23" y2="10"/>
                                </svg>
                            </div>
                            <h4>Credit Cards</h4>
                            <p>Secure payment with major credit cards</p>
                        </div>

                    </div>
                </div>
            </section>

            <!-- ───────────── CTA BANNER ───────────── -->
            <section class="cta-section">
                <div class="cta-inner">
                    <div class="cta-dot"></div>
                    <h2 class="cta-title">Ready to Try Your Luck?</h2>
                    <p class="cta-desc">
                        Join thousands of users who are already participating in our exciting lucky
                        draws! Choose your preferred draw type and start winning today.
                    </p>
                    <button class="cta-btn" @click="user ? handleJoin('cash') : router.visit('/register')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Get Started Now
                    </button>
                </div>
            </section>

        </div>

    </AppLayout>
</template>

<style scoped>

/* ─────────────────────────────────────────
   BASE
───────────────────────────────────────── */
*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.page-bg {
    min-height: 100vh;
    background: linear-gradient(135deg, #6366f1, #4f46e5, #312e81);
    padding-bottom: 100px;
    color: white;
}

/* ─────────────────────────────────────────
   HERO
───────────────────────────────────────── */
.hero {
    padding: 90px 20px 70px;
    text-align: center;
}

.hero-content {
    max-width: 860px;
    margin: auto;
}

h1 {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 800;
    line-height: 1.2;
}

.highlight {
    color: #FFD700;
}

.hero-desc {
    opacity: .88;
    margin-top: 20px;
    font-size: 1.1rem;
    line-height: 1.6;
}

/* ─────────────────────────────────────────
   HERO BUTTONS
───────────────────────────────────────── */
.buttons {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
}

.btn {
    padding: 14px 28px;
    border-radius: 12px;
    border: none;
    font-weight: 700;
    font-size: .97rem;
    cursor: pointer;
    transition: transform .25s, box-shadow .25s;
}

.btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,.25);
}

.cash    { background: linear-gradient(45deg, #ff7a18, #ff3d00); color: white; }
.product { background: #22c55e; color: white; }
.start   { background: #f59e0b; color: white; }
.login   { background: rgba(255,255,255,.15); color: white; backdrop-filter: blur(6px); }

/* ─────────────────────────────────────────
   STATS
───────────────────────────────────────── */
.stats-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
    max-width: 1000px;
    margin: 60px auto 0;
    padding: 0 20px;
}

.stats-card {
    background: rgba(255,255,255,.1);
    backdrop-filter: blur(12px);
    padding: 32px 20px;
    border-radius: 20px;
    text-align: center;
    border: 1px solid rgba(255,255,255,.15);
    transition: transform .3s, box-shadow .3s;
}

.stats-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(0,0,0,.2);
}

.stats-card .icon { font-size: 30px; margin-bottom: 10px; }
.stats-card h2    { font-size: 1.8rem; font-weight: 800; }
.stats-card p     { opacity: .8; margin-top: 4px; }

/* ─────────────────────────────────────────
   ACHIEVEMENTS
───────────────────────────────────────── */
.product-achievements {
    margin-top: 90px;
    text-align: center;
    padding: 0 20px;
}

.section-header h2 { font-size: 2rem; font-weight: 800; }
.section-header p  { opacity: .8; margin-top: 10px; }

.achievements-grid {
    margin-top: 40px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 28px;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}

.achievement-card {
    background: white;
    color: #1e293b;
    padding: 36px 28px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    transition: transform .3s;
}

.achievement-card:hover { transform: translateY(-6px); }

.achievement-card h3 {
    font-size: 1.6rem;
    font-weight: 800;
    margin: 10px 0 4px;
}

.achievement-card p { color: #64748b; font-size: .9rem; }

.achievement-icon {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    font-size: 26px;
    margin: 0 auto 14px;
}

.green { background: #22c55e; }
.blue  { background: #3b82f6; }
.pink  { background: #ec4899; }

/* ─────────────────────────────────────────
   LUCKY DRAW SECTION
───────────────────────────────────────── */
.lucky-draw-section {
    margin-top: 90px;
    padding: 60px 20px;
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(14px);
    border-top: 1px solid rgba(255,255,255,.12);
}

.draw-header {
    text-align: center;
    margin-bottom: 48px;
}

.draw-title {
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 800;
    color: #fff;
}

.draw-subtitle {
    margin-top: 10px;
    opacity: .8;
    font-size: 1rem;
}

/* ─────────────────────────────────────────
   DRAW CARDS GRID
───────────────────────────────────────── */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 28px;
    max-width: 860px;
    margin: 0 auto;
}

/* ─────────────────────────────────────────
   DRAW CARD
───────────────────────────────────────── */
.draw-card {
    position: relative;
    background: rgba(255,255,255,.96);
    border-radius: 24px;
    padding: 40px 30px 32px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: 0 8px 32px rgba(0,0,0,.12);
    border: 2px solid transparent;
    cursor: pointer;
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease, border-color .25s ease;
}

.draw-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 48px rgba(0,0,0,.18);
}

.card-selected-cash  { border-color: #f97316; }
.card-selected-green { border-color: #22c55e; }

/* subtle glow blob behind card content */
.card-glow {
    position: absolute;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    opacity: .08;
    top: -60px;
    left: 50%;
    transform: translateX(-50%);
    pointer-events: none;
}

.glow-orange { background: #f97316; }
.glow-green  { background: #22c55e; }

/* ─────────────────────────────────────────
   CARD ICON
───────────────────────────────────────── */
.card-icon {
    position: relative;
    z-index: 1;
    width: 68px;
    height: 68px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    box-shadow: 0 6px 20px rgba(0,0,0,.2);
}

.icon-cash    { background: linear-gradient(135deg, #f97316, #fb923c); }
.icon-product { background: linear-gradient(135deg, #22c55e, #4ade80); }

/* ─────────────────────────────────────────
   CARD TEXT
───────────────────────────────────────── */
.card-title {
    position: relative;
    z-index: 1;
    font-size: 1.3rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 6px;
}

.card-subtitle {
    position: relative;
    z-index: 1;
    font-size: .875rem;
    color: #64748b;
    margin-bottom: 26px;
    line-height: 1.55;
}

/* ─────────────────────────────────────────
   FEATURES LIST
───────────────────────────────────────── */
.features-list {
    position: relative;
    z-index: 1;
    list-style: none;
    width: 100%;
    text-align: left;
    margin-bottom: 28px;
    display: flex;
    flex-direction: column;
    gap: 13px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: .875rem;
    color: #334155;
    font-weight: 500;
}

.check-icon {
    flex-shrink: 0;
    width: 23px;
    height: 23px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.check-orange { background: #f97316; }
.check-green  { background: #22c55e; }

/* ─────────────────────────────────────────
   DRAW BUTTON
───────────────────────────────────────── */
.draw-btn {
    position: relative;
    z-index: 1;
    width: 100%;
    padding: 14px 20px;
    border: none;
    border-radius: 12px;
    font-size: .97rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: white;
    margin-top: auto;
    transition: opacity .2s, transform .15s, box-shadow .2s;
}

.draw-btn:hover {
    opacity: .92;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,.2);
}

.draw-btn:active { transform: translateY(0); }

.btn-cash    { background: linear-gradient(135deg, #f97316, #fb923c); }
.btn-product { background: linear-gradient(135deg, #22c55e, #16a34a); }

/* ─────────────────────────────────────────
   PAYMENT METHODS
───────────────────────────────────────── */
.payment-section {
    margin-top: 90px;
    padding: 0 20px;
}

.payment-inner {
    max-width: 860px;
    margin: 0 auto;
    background: rgba(255,255,255,.07);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,.14);
    border-radius: 28px;
    padding: 56px 40px;
}

.payment-inner .section-header {
    text-align: center;
    margin-bottom: 44px;
}

.payment-inner .section-header h2 {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.payment-inner .section-header p {
    margin-top: 10px;
    opacity: .78;
    font-size: .97rem;
}

/* "Secure" pill badge */
.secure-badge {
    background: linear-gradient(135deg, #6366f1, #818cf8);
    color: white;
    padding: 2px 14px;
    border-radius: 20px;
    font-size: .9rem;
    font-weight: 700;
    letter-spacing: .3px;
}

.payment-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.payment-card {
    background: white;
    border-radius: 20px;
    padding: 32px 22px;
    text-align: center;
    box-shadow: 0 6px 24px rgba(0,0,0,.10);
    border: 2px solid transparent;
    transition: transform .3s, box-shadow .3s, border-color .25s;
    color: #1e293b;
}

.payment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 36px rgba(0,0,0,.15);
    border-color: rgba(99,102,241,.3);
}

.payment-card--featured {
    border-color: rgba(34,197,94,.35);
    box-shadow: 0 8px 30px rgba(34,197,94,.12);
}

.payment-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    box-shadow: 0 4px 14px rgba(0,0,0,.18);
}

.bg-red    { background: linear-gradient(135deg, #ef4444, #f97316); }
.bg-green  { background: linear-gradient(135deg, #22c55e, #4ade80); }
.bg-purple { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }

.payment-card h4 {
    font-size: 1.05rem;
    font-weight: 800;
    margin-bottom: 6px;
    color: #1e293b;
}

.payment-card p {
    font-size: .82rem;
    color: #64748b;
    line-height: 1.5;
    opacity: 1;
    margin-top: 0;
}

/* ─────────────────────────────────────────
   CTA BANNER
───────────────────────────────────────── */
.cta-section {
    margin-top: 90px;
    padding: 0 20px 20px;
}

.cta-inner {
    position: relative;
    max-width: 860px;
    margin: 0 auto;
    background: linear-gradient(135deg, rgba(236,72,153,.55), rgba(239,68,68,.45), rgba(249,115,22,.4));
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 28px;
    padding: 64px 40px;
    text-align: center;
    overflow: hidden;
}

/* decorative dot accent (matches screenshot) */
.cta-dot {
    position: absolute;
    left: -18px;
    top: 50%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #ec4899;
    box-shadow: 0 0 0 8px rgba(236,72,153,.25);
}

.cta-title {
    font-size: clamp(1.6rem, 4vw, 2.4rem);
    font-weight: 800;
    color: #fff;
    margin-bottom: 16px;
}

.cta-desc {
    font-size: 1rem;
    opacity: .88;
    max-width: 580px;
    margin: 0 auto 36px;
    line-height: 1.65;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #f59e0b;
    color: white;
    border: none;
    padding: 16px 36px;
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: transform .25s, box-shadow .25s, background .2s;
    box-shadow: 0 6px 24px rgba(245,158,11,.4);
}

.cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(245,158,11,.5);
    background: #d97706;
}

.cta-btn:active { transform: translateY(0); }

/* ─────────────────────────────────────────
   RESPONSIVE
───────────────────────────────────────── */
@media (max-width: 640px) {
    .cards-grid      { grid-template-columns: 1fr; }
    .payment-grid    { grid-template-columns: 1fr; }
    h1               { font-size: 2rem; }
    .payment-inner   { padding: 36px 20px; }
    .cta-inner       { padding: 52px 22px; }
    .cta-dot         { display: none; }
}
</style>
