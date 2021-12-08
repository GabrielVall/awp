const staticCacheName = 'site-static-v1';
const assets = [
  'index.html',
  'assets/js/ui.js',
  'assets/css/main.css',
  'assets/images/background.jpg',
];
// install event
self.addEventListener("install", installEvent => {
    installEvent.waitUntil(
      caches.open(staticCacheName).then(cache => {
        cache.addAll(assets)
      })
    )
  })
  self.addEventListener("fetch", fetchEvent => {
    fetchEvent.respondWith(
      caches.match(fetchEvent.request).then(res => {
        return res || fetch(fetchEvent.request)
      })
    )
  })