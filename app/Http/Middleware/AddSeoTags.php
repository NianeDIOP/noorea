<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddSeoTags
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Ajouter des headers SEO utiles
        if ($response instanceof \Illuminate\Http\Response) {
            // Ajouter des headers pour l'indexation
            $response->headers->set('X-Robots-Tag', 'index, follow, max-image-preview:large, max-snippet:-1');
            
            // Ajouter des headers de cache pour les moteurs de recherche
            $response->headers->set('Cache-Control', 'public, max-age=3600');
            
            // Indiquer que le contenu est en français (Sénégal)
            $response->headers->set('Content-Language', 'fr-SN');
            
            // Ajouter des headers de sécurité qui peuvent influencer le SEO
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        }
        
        return $response;
    }
}
