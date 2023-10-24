<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;


class GameController extends Controller
{
    public function updateProgress(Request $request) {
        $data = $request->all();

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
            ['user_id' => $userId, 'stage_id' => $stageId],
            ['score' => $score, 'completion_status' => 1]
        );

        CompletedStage::updateOrCreate(
            ['user_id' => $userId, 'stage_id' => $stageId]
        );

       // Flash a success message to the session
        $request->session()->flash('success');

        // Redirect to the 'main_game' route
        return view('main_game');
    }


    public function showDashboard()
    {
        // Fetch all stages
        $stages = Stage::all(); // Replace 'Stage' with your actual model
        
        // Fetch user progress
        $userProgress = [];
        
        // Find the user's progress for each stage
        foreach ($stages as $stage) {
            $progress = Progress::where('user_id', auth()->id()) // Use auth()->id() to get the authenticated user's ID
                ->where('stage_id', $stage->id)
                ->first();
        
            $userProgress[$stage->id] = $progress;
        }
        
        // Pass the variables to the 'dashboard' view
        return view('dashboard', ['userProgress' => $userProgress, 'stages' => $stages]);
    }
    
}
