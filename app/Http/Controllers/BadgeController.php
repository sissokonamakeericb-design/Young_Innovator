<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;
use App\Models\User;

class BadgeController extends Controller
{
    // Lister tous les badges
public function index()
{
    $user = auth()->user();
    $badges = $user->badges;

    return view('badges.index', compact('badges'));
}



    // Créer un nouveau badge
    public function store(Request $request)
    {
        $badge = Badge::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'icone' => $request->icone,
        ]);

        return response()->json($badge, 201);
    }

    // Attribuer un badge à un étudiant
    public function assignBadge(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $badge = Badge::findOrFail($request->badge_id);

        $user->badges()->attach($badge->id);

        return response()->json([
            'message' => "Badge attribué avec succès à l'étudiant."
        ]);
    }

    // Retirer un badge à un étudiant
    public function removeBadge(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $badge = Badge::findOrFail($request->badge_id);

        $user->badges()->detach($badge->id);

        return response()->json([
            'message' => "Badge retiré avec succès à l'étudiant."
        ]);
    }

    // Afficher les badges d’un étudiant
    public function userBadges($user_id)
    {
        $user = User::findOrFail($user_id);
        return response()->json($user->badges);
    }
}
