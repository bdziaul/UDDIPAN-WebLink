<?php
// loading.php - Smooth 0% to 100% Loading Screen (~3 seconds)
?>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-container">
        <!-- Logo -->
        <div class="logo-wrapper">
            <div class="logo-background">
                <img src="https://uddipan.wuaze.com/picture/logo.png" alt="UDDIPAN" class="loading-logo">
            </div>
        </div>

        <!-- Percentage -->
        <div class="loading-percentage" id="loadingPercentage">0%</div>

        <!-- Brand / Title -->
        <div class="loading-text" id="loadingText">UDDIPAN Weblink</div>

        <!-- Status Message -->
        <div class="loading-message" id="loadingMessage">Starting...</div>

        <!-- Progress Bar -->
        <div class="loading-progress-container">
            <div class="loading-progress-bar" id="progressBar" style="width: 0%"></div>
        </div>

        <!-- Animated Dots -->
        <div class="loading-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<style>
/* ────────────────────────────────────────────────
   Loading Overlay
───────────────────────────────────────────────── */
.loading-overlay {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #0a1928 0%, #1a2a3a 100%);
    z-index: 999999;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1;
    visibility: visible;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}

.loading-overlay.hidden {
    opacity: 0;
    visibility: hidden;
}

/* Container */
.loading-container {
    text-align: center;
    max-width: 90%;
    padding: 20px;
}

/* Logo Pulse Animation */
.logo-wrapper {
    margin-bottom: 30px;
    display: inline-block;
    padding: 10px;
    border-radius: 50%;
    animation: logoPulse 2s ease-in-out infinite;
}

@keyframes logoPulse {
    0%, 100% { box-shadow: 0 0 30px rgba(67, 160, 71, 0.3); }
    50%      { box-shadow: 0 0 60px rgba(102, 187, 106, 0.6); }
}

.logo-background {
    background: rgba(255, 255, 255, 0.25);
    padding: 20px;
    border-radius: 50%;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.loading-logo {
    width: 180px;
    height: 180px;
    object-fit: contain;
    display: block;
}

/* Percentage */
.loading-percentage {
    color: #43A047;
    font-size: 72px;
    font-weight: 900;
    margin: 10px 0;
    text-shadow: 0 0 30px #43A047;
    font-family: 'Courier New', Courier, monospace;
    letter-spacing: 5px;
    animation: percentageGlow 1.5s ease-in-out infinite;
}

@keyframes percentageGlow {
    0%, 100% { text-shadow: 0 0 30px #43A047; opacity: 1; }
    50%      { text-shadow: 0 0 60px #66BB6A; opacity: 0.9; }
}

/* Title Text (Gradient) */
.loading-text {
    color: #fff;
    font-size: 32px;
    font-weight: 700;
    margin: 15px 0;
    letter-spacing: 2px;
    background: linear-gradient(90deg, #43A047, #66BB6A, #8BC34A);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: textGlow 2s ease-in-out infinite;
}

@keyframes textGlow {
    0%, 100% { filter: brightness(1); }
    50%      { filter: brightness(1.2); }
}

/* Status Message */
.loading-message {
    color: #a0a0a0;
    font-size: 18px;
    font-weight: 400;
    margin: 15px 0;
    animation: messageFade 2s ease-in-out infinite;
}

@keyframes messageFade {
    0%, 100% { opacity: 0.8; }
    50%      { opacity: 1; }
}

/* Progress Bar */
.loading-progress-container {
    width: 400px;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    margin: 25px auto;
    overflow: hidden;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
}

.loading-progress-bar {
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, #43A047, #66BB6A, #8BC34A);
    border-radius: 10px;
    transition: width 0.05s linear;
    box-shadow: 0 0 20px #43A047;
    position: relative;
    overflow: hidden;
}

.loading-progress-bar::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0%   { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Bouncing Dots */
.loading-dots {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 30px 0 10px;
}

.loading-dots span {
    width: 12px;
    height: 12px;
    background: linear-gradient(45deg, #43A047, #66BB6A);
    border-radius: 50%;
    animation: bounce 1.4s ease-in-out infinite;
    box-shadow: 0 0 15px #43A047;
}

.loading-dots span:nth-child(1) { animation-delay: 0s;    }
.loading-dots span:nth-child(2) { animation-delay: 0.2s; }
.loading-dots span:nth-child(3) { animation-delay: 0.4s; }

@keyframes bounce {
    0%, 60%, 100% { transform: translateY(0);    opacity: 0.6; }
    30%           { transform: translateY(-15px); opacity: 1;   }
}

/* ────────────────────────────────────────────────
   Responsive Adjustments
───────────────────────────────────────────────── */
@media (max-width: 768px) {
    .loading-logo           { width: 130px; height: 130px; }
    .logo-background        { padding: 15px; }
    .loading-percentage     { font-size: 56px; }
    .loading-text           { font-size: 24px; }
    .loading-message        { font-size: 16px; }
    .loading-progress-container { width: 280px; }
}

@media (max-width: 480px) {
    .loading-logo           { width: 100px; height: 100px; }
    .logo-background        { padding: 12px; }
}
</style>

<script>
// ────────────────────────────────────────────────
// Smooth fake loading progress (0% → 100% in ~3s)
// ────────────────────────────────────────────────
(function() {
    'use strict';

    let progressInterval  = null;
    let currentProgress   = 0;
    let startTime         = null;
    let animationActive   = false;

    function smoothProgress() {
        if (!startTime) {
            startTime = Date.now();
            currentProgress = 0;
            updateProgress();
        }

        const elapsed = Date.now() - startTime;
        let target = (elapsed / 3000) * 100;
        if (target > 100) target = 100;

        if (target > currentProgress) {
            currentProgress = target;
            updateProgress();
        }

        if (currentProgress >= 100) {
            cancelAnimationFrame(progressInterval);
            progressInterval = null;
            animationActive = false;
            setTimeout(hideLoading, 500);
            return;
        }

        if (animationActive) {
            progressInterval = requestAnimationFrame(smoothProgress);
        }
    }

    function updateProgress() {
        document.getElementById('progressBar').style.width = currentProgress + '%';
        document.getElementById('loadingPercentage').textContent = Math.floor(currentProgress) + '%';

        const msg = document.getElementById('loadingMessage');
        if (!msg) return;

        if      (currentProgress < 20)  msg.textContent = 'Starting...';
        else if (currentProgress < 40)  msg.textContent = 'Establishing connection...';
        else if (currentProgress < 60)  msg.textContent = 'Loading resources...';
        else if (currentProgress < 80)  msg.textContent = 'Almost ready...';
        else if (currentProgress < 100) msg.textContent = 'Finalizing...';
        else                            msg.textContent = 'Complete!';
    }

    window.showLoading = function() {
        const overlay = document.getElementById('loadingOverlay');
        if (!overlay) return;

        overlay.classList.remove('hidden');
        startTime = Date.now();
        currentProgress = 0;
        animationActive = true;
        updateProgress();

        if (progressInterval) cancelAnimationFrame(progressInterval);
        progressInterval = requestAnimationFrame(smoothProgress);
    };

    window.hideLoading = function() {
        if (progressInterval) {
            cancelAnimationFrame(progressInterval);
            progressInterval = null;
        }
        animationActive = false;

        const overlay = document.getElementById('loadingOverlay');
        if (overlay) overlay.classList.add('hidden');
    };

    // ── Auto triggers ─────────────────────────────────────
    document.addEventListener('DOMContentLoaded', showLoading);

    window.addEventListener('load', () => {
        if (currentProgress < 100) {
            currentProgress = 100;
            updateProgress();
        }
        setTimeout(hideLoading, 600);
    });

    // Optional: show loading on navigation away / reload
    // window.addEventListener('beforeunload', showLoading);

})();
</script>