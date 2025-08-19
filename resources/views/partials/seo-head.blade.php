<!-- Preload critical resources -->
<link rel="preload" href="{{ asset('images/logo.jpg') }}" as="image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com">

<!-- DNS prefetch for external resources -->
<link rel="dns-prefetch" href="//wa.me">
<link rel="dns-prefetch" href="//www.google.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

<!-- Preload critical CSS -->
@vite(['resources/css/app.css', 'resources/css/noorea.css'], 'build')

<!-- Critical CSS inlined for above-the-fold content -->
<style>
    /* Critical CSS for immediate rendering */
    .navbar-icon-top{color:#d4af37;transition:all .3s ease;padding:.5rem;border-radius:50%;transform:scale(1);background-color:rgba(212,175,55,.1);backdrop-filter:blur(2px);border:1px solid rgba(212,175,55,.2)}
    .nav-link-gold{color:#1f2937;text-decoration:none;font-weight:600;transition:all .3s ease;padding:.5rem 1rem;border-radius:.5rem;border:1px solid transparent}
    .text-noorea-gold{color:#d4af37}
    .bg-noorea-gold{background-color:#d4af37}
</style>
