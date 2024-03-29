<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\User;
use App\Models\Stage;
use App\Models\CompletedStage;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function updateProgress(Request $request): JsonResponse
    {
        // Validation
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'stage_id' => 'required|integer',
            'score' => 'required|integer',
        ]);

        // Update progress and completed stages
        $userId = $validatedData['user_id'];
        $stageId = $validatedData['stage_id'];
        $score = $validatedData['score'];

        Score::updateOrCreate(
            ['user_id' => $userId],
            ['score' => $score, 'is_active' => 1]
        );

        CompletedStage::updateOrCreate(
            ['user_id' => $userId, 'stage_id' => $stageId]
        );

        // Return a JSON response indicating success
        return new JsonResponse(['success' => true]);
    }


    public function showDashboard()
    {
        // Fetch all stages
        $stages = Stage::all();

        // Fetch user progress from Progress model
        $userProgressRecord = Score::where('user_id', auth()->id())->first();

        // Fetch user progress from CompletedStage model
        $completedStages = CompletedStage::where('user_id', auth()->id())->get();

        // Create an array to track user progress for each stage
        $userProgress = [];

        // Map the completed stages into the $userProgress array for quick access
        foreach ($completedStages as $completedStage) {
            $userProgress[$completedStage->stage_id] = $completedStage;
        }

        // Retrieve the user's score from the progress record
        $userScore = $userProgressRecord ? $userProgressRecord->score : 0;


        return view('dashboard', compact('userProgress', 'stages', 'userScore'));
    }

    public function getLeaderboardData()
    {
        $leaderboardData = User::select('users.username', 'scores.score as user_score', DB::raw('COUNT(completed_stages.id) as completed_stages_count'))
            ->leftJoin('completed_stages', 'users.id', '=', 'completed_stages.user_id')
            ->leftJoin('scores', 'users.id', '=', 'scores.user_id')
            ->groupBy('users.username', 'scores.score')
            ->orderByDesc('user_score')
            ->get();

        return response()->json($leaderboardData->toJson());
    }

}
