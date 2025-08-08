<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Models\Purchase;
USE App\Models\User;    

class DownloadController extends Controller
{
    
    protected function ensureCanDownload(Request $request, Recipe $recipe): void
    {
        // samo ulogovan korisnik može da preuzima, mozete promeniti kasnije u zavisnosti od uloge ko moze da preuzima
        if (! $request->user()) {
            abort(401, 'Unauthenticated');
        }
        /*$purchase = Purchase::where('user_id', $user->id)->where('recipe_id', $recipe->id)->first();

    if (! $purchase) {
        abort(403, 'Nemaš kupljen pristup ovom receptu');
    }


    $has = Purchase::where('user_id', $user->id)
        ->where('recipe_id', $recipe->id)
        ->exists();

    if (! $has) {
        abort(403, 'Nemaš kupljen pristup ovom receptu');
    }*/

     //UKLOPITI U KUPOVINU ZA SAD RADI DA SE SKINE PDF
        
    }

    // 1) Vrati kratkotrajni signed link (npr. 5 minuta)
    public function generateLink(Request $request, Recipe $recipe)
    {
        $this->ensureCanDownload($request, $recipe);

        if (!$recipe->pdf_path) {
            return response()->json(['message' => 'PDF nije postavljen za ovaj recept'], 404);
        }

        $url = URL::temporarySignedRoute(
            'downloads.recipe',
            now()->addMinutes(5),
            ['recipe' => $recipe->id]
        );

        return response()->json(['url' => $url]);
    }

    // 2) Preuzimanje PDF-a (proverava potpis i auth)
    public function download(Request $request, Recipe $recipe)
    {
        if (! $request->hasValidSignature()) {
            return response()->json(['message' => 'Link je istekao ili je nevažeći'], 403);
        }

        $this->ensureCanDownload($request, $recipe);

        $path = $recipe->pdf_path; // npr. 'recipes/ferero.pdf'
        if (! $path || ! Storage::disk('private')->exists($path)) {
            return response()->json(['message' => 'PDF fajl nije pronađen'], 404);
        }

        // brojanje preuzimanja (vama su pocetne vrednosti iz seedera u bazi postavljene kao random brojevi
        if ($recipe->isFillable('downloads')) {
            $recipe->increment('downloads');
        }

        // isporuči fajl (bez otkrivanja prave putanje)
        $downloadName = \Str::slug($recipe->title ?? 'recipe').'.pdf';
        return Storage::disk('private')->download($path, $downloadName);
    }

    
}
