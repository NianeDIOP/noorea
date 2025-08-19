User-agent: *
Allow: /

# Directories to exclude from crawling
Disallow: /admin/
Disallow: /compte/
Disallow: /cart/
Disallow: /login
Disallow: /register
Disallow: /logout
Disallow: /password/
Disallow: /api/
Disallow: /telescope/
Disallow: /horizon/

# Files to exclude
Disallow: *.pdf$
Disallow: /storage/framework/
Disallow: /storage/logs/
Disallow: /vendor/
Disallow: /bootstrap/cache/
Disallow: /node_modules/
Disallow: /.env
Disallow: /config/
Disallow: /database/

# Allow CSS, JS, and images for better indexing
Allow: *.css$
Allow: *.js$
Allow: *.png$
Allow: *.jpg$
Allow: *.jpeg$
Allow: *.gif$
Allow: *.webp$
Allow: *.svg$

# Crawl-delay to prevent server overload
Crawl-delay: 1

# Sitemap location
Sitemap: {{ config('app.url') }}/sitemap.xml
