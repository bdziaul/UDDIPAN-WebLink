const CACHE_NAME = "uddipan-v13";
const OFFLINE_URL = "/offline.html";

// essential files only
const ASSETS = [
  "/",
  "/index.php",
  "/offline.html",
  "/zia.css",
  "/scroll-top.js",
  "/install.js",
  "/picture/logo.png"
];

// ================= INSTALL =================
self.addEventListener("install", event => {
  self.skipWaiting();

  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(ASSETS))
  );
});

// ================= ACTIVATE =================
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(keys.map(k => k !== CACHE_NAME && caches.delete(k)))
    )
  );

  return self.clients.claim();
});

// ================= FETCH (FINAL SMART LOGIC) =================
self.addEventListener("fetch", event => {

  // PAGE REQUEST (MAIN FIX)
  if (event.request.mode === "navigate") {
    event.respondWith(
      fetch(event.request)
        .then(response => {
          return response;
        })
        .catch(async () => {

          // STEP 1: try cache
          const cached = await caches.match(event.request);
          if (cached) return cached;

          // STEP 2: fallback offline page
          return caches.match(OFFLINE_URL);
        })
    );
    return;
  }

  // STATIC FILES
  event.respondWith(
    caches.match(event.request).then(cached => {
      return cached || fetch(event.request).catch(() => cached);
    })
  );
});

// ================= FORCE UPDATE =================
self.addEventListener("message", event => {
  if (event.data?.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});