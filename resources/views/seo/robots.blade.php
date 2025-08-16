User-agent: *
Allow: /

# Directories
Disallow: /admin/
Disallow: /compte/
Disallow: /cart/
Disallow: /login
Disallow: /register

# Files
Disallow: *.pdf$
Disallow: /storage/framework/
Disallow: /vendor/
Disallow: /bootstrap/cache/

# Sitemap
Sitemap: {{ route('sitemap') }}
