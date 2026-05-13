const CACHE_NAME = "uddipan-v13";
const OFFLINE_URL = "/offline.html";

const ASSETS = ["/", "/index.html", "/team.html", "/offline.html", "/zia.css", "/picture/logo.png", "/picture/login.png"];

self.addEventListener("install", event => { self.skipWaiting(); event.waitUntil(caches.open(CACHE_NAME).then(cache => cache.addAll(ASSETS))); });
self.addEventListener("activate", event => { event.waitUntil(caches.keys().then(keys => Promise.all(keys.map(k => k !== CACHE_NAME && caches.delete(k))))); return self.clients.claim(); });
self.addEventListener("fetch", event => { if(event.request.mode === "navigate") { event.respondWith(fetch(event.request).catch(async () => { const cached = await caches.match(event.request); if(cached) return cached; return caches.match(OFFLINE_URL); })); return; } event.respondWith(caches.match(event.request).then(cached => cached || fetch(event.request))); });
self.addEventListener("message", event => { if(event.data?.type === "SKIP_WAITING") self.skipWaiting(); });
