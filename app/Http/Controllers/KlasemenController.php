<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Matches;
use App\Models\Klasemen;

class KlasemenController extends Controller
{
    public function index()
    {
        $matches = Matches::all();
        $clubs = Club::all();

        foreach ($matches as $match) {
            $club1 = Club::find($match->club1_id);
            $club2 = Club::find($match->club2_id);
        
            if ($club1 && $club2) {
                $score1 = $match->score1;
                $score2 = $match->score2;

                $total_matches_club1 = Matches::where('club1_id', $club1->club_id)
                                                ->orWhere('club2_id', $club1->club_id)
                                                ->count();

                $total_matches_club2 = Matches::where('club1_id', $club2->club_id)
                                                ->orWhere('club2_id', $club2->club_id)
                                                ->count();
                
                $win_club1 = Matches::where(function ($query) use ($club1) {
                                    $query->where('club1_id', $club1->club_id)
                                        ->whereColumn('score1', '>', 'score2');
                                })
                                ->orWhere(function ($query) use ($club1) {
                                    $query->where('club2_id', $club1->club_id)
                                        ->whereColumn('score1', '<', 'score2');
                                })
                                ->count();

                $win_club2 = Matches::where(function ($query) use ($club2) {
                                    $query->where('club1_id', $club2->club_id)
                                        ->whereColumn('score1', '>', 'score2');
                                })
                                ->orWhere(function ($query) use ($club2) {
                                    $query->where('club2_id', $club2->club_id)
                                        ->whereColumn('score1', '<', 'score2');
                                })
                                ->count();

                $draw_club1 = Matches::where(function ($query) use ($club1) {
                                    $query->where('club1_id', $club1->club_id)
                                        ->whereColumn('score1', 'score2');
                                })
                                ->orWhere(function ($query) use ($club1) {
                                    $query->where('club2_id', $club1->club_id)
                                        ->whereColumn('score1', 'score2');
                                })
                                ->count();

                $draw_club2 = Matches::where(function ($query) use ($club2) {
                                    $query->where('club1_id', $club2->club_id)
                                        ->whereColumn('score1', 'score2');
                                })
                                ->orWhere(function ($query) use ($club2) {
                                    $query->where('club2_id', $club2->club_id)
                                        ->whereColumn('score1', 'score2');
                                })
                                ->count();

                $lose_club1 = Matches::where(function ($query) use ($club1) {
                                    $query->where('club1_id', $club1->club_id)
                                        ->whereColumn('score1', '<', 'score2');
                                })
                                ->orWhere(function ($query) use ($club1) {
                                    $query->where('club2_id', $club1->club_id)
                                        ->whereColumn('score1', '>', 'score2');
                                })
                                ->count();

                $lose_club2 = Matches::where(function ($query) use ($club2) {
                                    $query->where('club1_id', $club2->club_id)
                                        ->whereColumn('score1', '<', 'score2');
                                })
                                ->orWhere(function ($query) use ($club2) {
                                    $query->where('club2_id', $club2->club_id)
                                        ->whereColumn('score1', '>', 'score2');
                                })
                                ->count();

                //gol_menang
                $goal_home_club1 = Matches::where('club1_id', $club1->club_id)->sum('score1');
                $goal_away_club1 = Matches::where('club2_id', $club1->club_id)->sum('score2');
                
                $win_goal_club1 = $goal_home_club1 + $goal_away_club1;
                
                $goal_home_club2 = Matches::where('club1_id', $club2->club_id)->sum('score1');
                $goal_away_club2 = Matches::where('club2_id', $club2->club_id)->sum('score2');
                
                $win_goal_club2 = $goal_home_club2 + $goal_away_club2;

                //gol_kalah
                $home_opponent_goal_club1 = Matches::where('club1_id', $club1->club_id)->sum('score2');
                $away_opponent_goal_club1 = Matches::where('club2_id', $club1->club_id)->sum('score1');
                
                $lose_goal_club1 = $home_opponent_goal_club1 + $away_opponent_goal_club1;
                
                $home_opponent_goal_club2 = Matches::where('club1_id', $club2->club_id)->sum('score2');
                $away_opponent_goal_club2 = Matches::where('club2_id', $club2->club_id)->sum('score1');
                
                $lose_goal_club2 = $home_opponent_goal_club2 + $away_opponent_goal_club2;
                
                $club1_point = ($win_club1 * 3) + ($draw_club1 * 1);
                $club2_point = ($win_club2 * 3) + ($draw_club2 * 1);

                $klasemen1 = Klasemen::where('club_id', $club1->club_id)->firstOrNew(['club_id' => $club1->club_id]);
                
                if (!$klasemen1->exists) {
                    $klasemen1 = new Klasemen();
                    $klasemen1->club_id = $club1->club_id;
                    $klasemen1->total_matches = $total_matches_club1;
                    $klasemen1->win = $win_club1;
                    $klasemen1->draw = $draw_club1;
                    $klasemen1->lose = $lose_club1;
                    $klasemen1->win_goal = $win_goal_club1;
                    $klasemen1->lose_goal = $lose_goal_club1;
                    $klasemen1->point = $club1_point;
                    $klasemen1->save();
                }
                else {
                    $klasemen1->total_matches = $total_matches_club1;
                    $klasemen1->win = $win_club1;
                    $klasemen1->draw = $draw_club1;
                    $klasemen1->lose = $lose_club1;
                    $klasemen1->win_goal = $win_goal_club1;
                    $klasemen1->lose_goal = $lose_goal_club1;
                    $klasemen1->point = $club1_point;
                    $klasemen1->save();
                }
        
                $klasemen2 = Klasemen::where('club_id', $club2->club_id)->firstOrNew(['club_id' => $club2->club_id]);
                if (!$klasemen2->exists) {
                    $klasemen2 = new Klasemen();
                    $klasemen2->club_id = $club2->club_id;
                    $klasemen2->total_matches = $total_matches_club2;
                    $klasemen2->win = $win_club2;
                    $klasemen2->draw = $draw_club2;
                    $klasemen2->lose = $lose_club2;
                    $klasemen2->win_goal = $win_goal_club2;
                    $klasemen2->lose_goal = $lose_goal_club2;
                    $klasemen2->point = $club2_point;
                    $klasemen2->save();
                }
                else {
                    $klasemen2->total_matches = $total_matches_club2;
                    $klasemen2->win = $win_club2;
                    $klasemen2->draw = $draw_club2;
                    $klasemen2->lose = $lose_club2;
                    $klasemen2->win_goal = $win_goal_club2;
                    $klasemen2->lose_goal = $lose_goal_club2;
                    $klasemen2->point = $club2_point;
                    $klasemen2->save();
                }
            }
        }

        $klasemen = Klasemen::select('klasemens.*', 'clubs.club_name')
                            ->join('clubs', 'klasemens.club_id', '=', 'clubs.club_id')
                            ->orderByDesc('klasemens.point')
                            ->orderByDesc(DB::raw('(klasemens.win_goal - klasemens.lose_goal)'))
                            ->get();

        return view('klasemen', ['klasemen' => $klasemen]);
    }
}
?>