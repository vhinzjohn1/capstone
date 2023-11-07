<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Stage;
use App\Models\CompletedStage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class GameController extends Controller
{
    public function updateProgress(Request $request): JsonResponse {
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
    
        Progress::updateOrCreate(
            ['user_id' => $userId],
            ['score' => $score, 'completion_status' => 1]
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

        // Fetch user progress from CompletedStage model
        $completedStages = CompletedStage::where('user_id', auth()->id())->get();

        // Create an array to track user progress for each stage
        $userProgress = [];

        // Map the completed stages into the $userProgress array for quick access
        foreach ($completedStages as $completedStage) {
            $userProgress[$completedStage->stage_id] = $completedStage;
        }

        return view('dashboard', compact('userProgress', 'stages'));
    }
    
}
