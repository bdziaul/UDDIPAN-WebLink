// install.js - Custom PWA Install Prompt (hidden on Windows desktop)

let deferredPrompt = null;
const installContainer = document.getElementById('installPromptContainer');

// ────────────────────────────────────────────────
// Detection helpers
// ────────────────────────────────────────────────

const isWindows = /Windows/.test(navigator.userAgent);
const isInstalled = 
  window.matchMedia('(display-mode: standalone)').matches ||
  window.navigator.standalone === true;

// ────────────────────────────────────────────────
// Early exit / logging
// ────────────────────────────────────────────────

if (isWindows) {
  console.log('Windows detected → install prompt disabled');
} else if (isInstalled) {
  console.log('App is already installed → install button hidden');
} else {
  console.log('Waiting for beforeinstallprompt event...');
}

// ────────────────────────────────────────────────
// Prevent default browser prompt & show our custom button (except on Windows)
// ────────────────────────────────────────────────

window.addEventListener('beforeinstallprompt', (e) => {
  e.preventDefault();

  if (isWindows) {
    console.log('Windows → ignoring install prompt');
    return;
  }

  deferredPrompt = e;
  console.log('beforeinstallprompt event captured');
  showInstallButton();
});

// ────────────────────────────────────────────────
// Create and show floating install button
// ────────────────────────────────────────────────

function showInstallButton() {
  if (isWindows) return;
  if (isInstalled) return;
  if (!installContainer) return;
  if (document.querySelector('.install-btn')) return; // already exists

  const btn = document.createElement('div');
  btn.className = 'install-btn';
  btn.textContent = '📲 Install App';

  btn.style.cssText = `
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 9999;
    padding: 12px 24px;
    background: linear-gradient(135deg, #43A047, #2e7d32);
    color: white;
    font-weight: bold;
    font-size: 16px;
    border-radius: 50px;
    border: 2px solid rgba(255,255,255,0.3);
    box-shadow: 0 4px 15px rgba(67,160,71,0.5);
    cursor: pointer;
    user-select: none;
    animation: pulse 2s infinite;
  `;

  btn.addEventListener('click', async () => {
    if (!deferredPrompt) {
      console.warn('No deferred prompt available');
      return;
    }

    deferredPrompt.prompt();
    const { outcome } = await deferredPrompt.userChoice;
    console.log(`User install choice: ${outcome}`);

    if (outcome === 'accepted') {
      btn.remove();
    }

    deferredPrompt = null;
  });

  installContainer.appendChild(btn);
}

// ────────────────────────────────────────────────
// Pulse animation
// ────────────────────────────────────────────────

const style = document.createElement('style');
style.textContent = `
  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50%      { transform: scale(1.05); }
  }
`;
document.head.appendChild(style);

// ────────────────────────────────────────────────
// Cleanup when app is successfully installed
// ────────────────────────────────────────────────

window.addEventListener('appinstalled', () => {
  console.log('App was installed successfully');
  document.querySelector('.install-btn')?.remove();
});

// Debug info
console.log('Detected OS string:', navigator.userAgent);
console.log('Is Windows?', isWindows);