<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Candidate;
use App\Models\SwimSuitScore;
use App\Models\PreInterviewScore;
use App\Models\GownScore;
use App\Models\PreInterviewOR;
use App\Models\SwimSuitOR;
use App\Models\GownOR;




class UserManagementController extends Controller
{
    public function addJudgeForm()
    {
        return view('usermanage.add_judge');
    }

    public function addJudge(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role = 'judge';
        $user->save();

        Session::flash('success', 'Judge added successfully');

        return redirect()->route('usermanage.dashboard')->with('success', 'Judge added successfully');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_username' => 'required',
            'edit_password' => 'required',
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->name = $request->edit_name;
        $user->username = $request->edit_username;
        $user->password = $request->edit_password;
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function createCandidate()
    {
        return view('candidates.create');
    }

    public function storeCandidate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidateNumber' => 'required|unique:candidates',
            'candidateName' => 'required',
            'age' => 'required|numeric',
            'candidateAddress' => 'required',
            'waist' => 'required|numeric', // Add validation for waist
            'hips' => 'required|numeric', // Add validation for hips
            'chest' => 'required|numeric', // Add validation for chest
            'candidateImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file types and size
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $candidate = new Candidate();
        $candidate->candidateNumber = $request->candidateNumber;
        $candidate->candidateName = $request->candidateName;
        $candidate->age = $request->age;
        $candidate->candidateAddress = $request->candidateAddress;
        $candidate->waist = $request->waist; // Assign waist value
        $candidate->hips = $request->hips; // Assign hips value
        $candidate->chest = $request->chest; // Assign chest value
    
        // Handle image upload
        if ($request->hasFile('candidateImage')) {
            $image = $request->file('candidateImage');
            if ($image->isValid()) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName); // Move the image to the public/images directory
                $candidate->candidateImage = 'images/' . $imageName; // Save the image path in the database
            } else {
                return back()->withErrors(['candidateImage' => 'Invalid image file'])->withInput();
            }
        }
    
        $candidate->save();
    
        return redirect()->route('usermanage.candidate_dash')->with('success', 'Candidate added successfully');
    }
    
    public function candidateDash()
    {
        $candidates = Candidate::all();
        return view('usermanage.candidate_dash', compact('candidates'));
    }

        // Add this method to handle deleting a candidate
    public function deleteCandidate($id)
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        $candidate->delete();

        return redirect()->back()->with('success', 'Candidate deleted successfully');
    }

        public function updateCandidate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'candidateNumber' => 'required|unique:candidates,candidateNumber,' . $id,
            'candidateName' => 'required',
            'age' => 'required|numeric',
            'candidateAddress' => 'required',
            'waist' => 'required|numeric',
            'hips' => 'required|numeric',
            'chest' => 'required|numeric',
            'candidateImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file types and size
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $candidate = Candidate::find($id);
        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        $candidate->candidateNumber = $request->candidateNumber;
        $candidate->candidateName = $request->candidateName;
        $candidate->age = $request->age;
        $candidate->candidateAddress = $request->candidateAddress;
        $candidate->waist = $request->waist;
        $candidate->hips = $request->hips;
        $candidate->chest = $request->chest;

        // Handle image upload
        if ($request->hasFile('candidateImage')) {
            $image = $request->file('candidateImage');
            if ($image->isValid()) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName); // Move the image to the public/images directory
                $candidate->candidateImage = 'images/' . $imageName; // Save the image path in the database
            } else {
                return back()->withErrors(['candidateImage' => 'Invalid image file'])->withInput();
            }
        }

        $candidate->save();

        return redirect()->route('usermanage.candidate_dash')->with('success', 'Candidate updated successfully');
    }

    public function preliminaryDash()
    {
        // Fetch all candidates
        $candidates = Candidate::all();
    
        // Fetch judges
        $judges = User::where('role', 'judge')->get();
    
        // Initialize an empty array to hold scores
        $scores = [];
    
        // Loop through each candidate
        foreach ($candidates as $candidate) {
            // Initialize an empty array to hold scores for this candidate
            $candidateData = [];
    
            // Loop through each judge
            foreach ($judges as $judge) {
                // Find the score given by this judge to the current candidate
                $judgeScore = PreInterviewScore::where('candidate_number', $candidate->id)
                                                ->where('judge_name', $judge->name)
                                                ->first();
    
                // If the score exists, add it to the candidate data, otherwise, add null
                $candidateData[$judge->name] = $judgeScore ? $judgeScore->rank : null;
            }
    
            // Add the candidate's data to the scores array
            $scores[$candidate->id] = $candidateData;
        }
    
        // Pass candidate data, judges data, and scores data to the view
        return view('usermanage.preliminary_dash', compact('candidates', 'judges', 'scores'));
    }

    public function judgeDashboard()
    {
        // Fetch all candidates
        $candidates = Candidate::all();
        
        // Pass candidate data to the view
        return view('judge.judge_dashboard', ['candidates' => $candidates]);
    }

        public function semifinalsDashboard()
    {
        $candidates = Candidate::all();
        
        // Pass candidate data to the view
        return view('judge.semi_finals_dash', ['candidates' => $candidates]);
    }

    public function storePreInterviewScore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'candidate_number' => 'required|array',
            'candidate_number.*' => 'required|integer',
            'judge_name' => 'required|array',
            'judge_name.*' => 'required|string|max:255',
        ]);
    
        // Array to hold total scores for each candidate
        $totalScores = [];
    
        // Loop through the submitted data and calculate total scores
        foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
            $composure = $request->input('composure.' . $candidateNumber, 0);
            $poiseGraceProjection = $request->input('poise_grace_projection.' . $candidateNumber, 0);
            // Calculate the total score by averaging the two scores and dividing by 2
            $totalScores[$candidateNumber] = ($composure + $poiseGraceProjection) / 2;
        }
    
        // Sort the total scores in descending order
        arsort($totalScores);
    
        // Calculate ranks based on the sorted total scores
        $rank = 0; // Start rank from 0
        $prevScore = null;
        foreach ($totalScores as $candidateNumber => $totalScore) {
            if ($totalScore !== $prevScore) {
                $rank++;
            }
            // Store the pre-interview score in the database
            PreInterviewScore::create([
                'candidate_number' => $candidateNumber,
                'composure' => $request->input('composure.' . $candidateNumber, 0),
                'poise_grace_projection' => $request->input('poise_grace_projection.' . $candidateNumber, 0),
                'total' => $totalScore,
                'rank' => $rank,
                'judge_name' => $validatedData['judge_name'][$index], // Using $index directly
            ]);
            $prevScore = $totalScore;
        }
    
        // Redirect to the swim-suit-table page
        return redirect()->route('swim-suit-table')->with('success', 'Pre-interview scores submitted successfully!');
    }
    
        public function storeSwimSuitScore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'candidate_number' => 'required|array',
            'candidate_number.*' => 'required|integer',
            'judge_name' => 'required|array',
            'judge_name.*' => 'required|string|max:255',
        ]);

        // Array to hold total scores for each candidate
        $totalScores = [];

        // Loop through the submitted data and calculate total scores
        foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
            $composure = $request->input('composure.' . $candidateNumber, 0);
            $poiseGraceProjection = $request->input('poise_grace_projection.' . $candidateNumber, 0);
            // Calculate the total score by adding the two scores and dividing by 2
            $totalScores[$candidateNumber] = ($composure + $poiseGraceProjection) / 2;
        }

        // Sort the total scores in descending order
        arsort($totalScores);

        // Calculate ranks based on the sorted total scores
        $rank = 0; // Start rank from 0
        $prevScore = null;
        foreach ($totalScores as $candidateNumber => $totalScore) {
            if ($totalScore !== $prevScore) {
                $rank++;
            }
            // Store the swimsuit score in the database
            SwimSuitScore::create([
                'candidate_number' => $candidateNumber,
                'composure' => $request->input('composure.' . $candidateNumber, 0),
                'poise_grace_projection' => $request->input('poise_grace_projection.' . $candidateNumber, 0),
                'total' => $totalScore,
                'rank' => $rank,
                'judge_name' => $validatedData['judge_name'][$index], // Using $index directly
            ]);
            $prevScore = $totalScore;
        }

        // Redirect to gown_table.blade.php
        return redirect()->route('gown-table')->with('success', 'Gown scores submitted successfully!');

    }

        public function storeGownScore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'candidate_number' => 'required|array',
            'candidate_number.*' => 'required|integer',
            'judge_name' => 'required|array',
            'judge_name.*' => 'required|string|max:255',
        ]);

        // Array to hold total scores for each candidate
        $totalScores = [];

        // Loop through the submitted data and calculate total scores
        foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
            $suitability = $request->input('suitability.' . $candidateNumber, 0);
            $poiseGraceProjection = $request->input('poise_grace_projection.' . $candidateNumber, 0);
            // Calculate the total score by adding the two scores and dividing by 2
            $totalScores[$candidateNumber] = ($suitability + $poiseGraceProjection) / 2;
        }

        // Sort the total scores in descending order
        arsort($totalScores);

        // Calculate ranks based on the sorted total scores
        $rank = 0; // Start rank from 0
        $prevScore = null;
        foreach ($totalScores as $candidateNumber => $totalScore) {
            if ($totalScore !== $prevScore) {
                $rank++;
            }
            // Store the gown score in the database
            GownScore::create([
                'candidate_number' => $candidateNumber,
                'suitability' => $request->input('suitability.' . $candidateNumber, 0),
                'poise_grace_projection' => $request->input('poise_grace_projection.' . $candidateNumber, 0),
                'total' => $totalScore,
                'rank' => $rank,
                'judge_name' => $validatedData['judge_name'][$index], // Using $index directly
            ]);
            $prevScore = $totalScore;
        }

        // Redirect back or do any other response handling as needed
        return redirect()->back()->with('success', 'Gown scores submitted successfully!');
    }

        public function swimSuitTable()
    {
        $candidates = Candidate::all();
        
        // Pass candidate data to the view
        return view('judge.swim_suit_table', ['candidates' => $candidates]);
    }
    
        public function gownTable()
        {
            $candidates = Candidate::all();
            
            // Pass candidate data to the view
            return view('judge.gown_table', ['candidates' => $candidates]);
        }

        public function preliminarySwimSuitDash()
        {
            // Fetch all candidates
            $candidates = Candidate::all();
        
            // Fetch judges
            $judges = User::where('role', 'judge')->get();
        
            // Initialize an empty array to hold scores
            $scores = [];
        
            // Loop through each candidate
            foreach ($candidates as $candidate) {
                // Initialize an empty array to hold scores for this candidate
                $candidateData = [];
        
                // Loop through each judge
                foreach ($judges as $judge) {
                    // Find the score given by this judge to the current candidate
                    $judgeScore = SwimSuitScore::where('candidate_number', $candidate->id)
                                                ->where('judge_name', $judge->name)
                                                ->first();
        
                    // If the score exists, add it to the candidate data, otherwise, add null
                    $candidateData[$judge->name] = $judgeScore ? $judgeScore->rank : null;
                }
        
                // Add the candidate's data to the scores array
                $scores[$candidate->id] = $candidateData;
            }
        
            // Pass candidate data, judges data, and scores data to the view
            return view('usermanage.prelim_swimsuit_dash', compact('candidates', 'judges', 'scores'));
        }    
        
        public function preliminaryGownDash()
        {
            // Fetch all candidates
            $candidates = Candidate::all();
        
            // Fetch judges
            $judges = User::where('role', 'judge')->get();
        
            // Initialize an empty array to hold scores
            $scores = [];
        
            // Loop through each candidate
            foreach ($candidates as $candidate) {
                // Initialize an empty array to hold scores for this candidate
                $candidateData = [];
        
                // Loop through each judge
                foreach ($judges as $judge) {
                    // Find the score given by this judge to the current candidate
                    $judgeScore = GownScore::where('candidate_number', $candidate->id)
                        ->where('judge_name', $judge->name)
                        ->first();
        
                    // If the score exists, add it to the candidate data, otherwise, add null
                    $candidateData[$judge->name] = $judgeScore ? $judgeScore->rank : null;
                }
        
                // Add the candidate's data to the scores array
                $scores[$candidate->id] = $candidateData;
            }
        
            // Pass candidate data, judges data, and scores data to the view
            return view('usermanage.prelim_gown_dash', compact('candidates', 'judges', 'scores'));   
        }   
        
        public function preliminaryOverallRanksDash()
        {
            // Fetch all candidates
            $candidates = Candidate::all();
            
            // Initialize arrays to hold ranks for each category
            $preInterviewRanks = [];
            $swimSuitRanks = [];
            $gownRanks = [];
        
            // Loop through each candidate
            foreach ($candidates as $candidate) {
                // Fetch pre-interview rank for the candidate
                $preInterviewRanks[$candidate->id] = PreInterviewOR::where('candidate_number', $candidate->id)->value('overall_rank');
        
                // Fetch swim suit rank for the candidate
                $swimSuitRanks[$candidate->id] = SwimSuitOR::where('candidate_number', $candidate->id)->value('overall_rank');
        
                // Fetch gown rank for the candidate
                $gownRanks[$candidate->id] = GownOR::where('candidate_number', $candidate->id)->value('overall_rank');
            }
        
            // Pass the retrieved data to the view
            return view('usermanage.prelim_overall_ranks', compact('candidates', 'preInterviewRanks', 'swimSuitRanks', 'gownRanks'));
        }
        
        

        public function storePreliminaryOverallRanks(Request $request)
        {
            // Fetch overall ranks for each candidate from the request
            $overallRanks = $request->input('overall_rank');
        
            // Loop through overall ranks to store them
            foreach ($overallRanks as $candidateId => $overallRank) {
                // Create or update the PreInterviewOR record for this candidate
                $preInterviewOR = PreInterviewOR::where('candidate_number', $candidateId)->first();
                if (!$preInterviewOR) {
                    PreInterviewOR::create([
                        'candidate_number' => $candidateId,
                        'overall_rank' => $overallRank,
                    ]);
                } else {
                    $preInterviewOR->update(['overall_rank' => $overallRank]);
                }
            }
        
            // Redirect to the swim suit overall ranks submission route
            return redirect()->route('usermanage.prelim_swimsuit_dash')->with('success', 'Pre-interview overall ranks submitted successfully!');
        }
        
        
        public function storeSwimSuitOverallRanks(Request $request)
        {
            // Fetch overall ranks for each candidate from the request
            $overallRanks = $request->input('overall_rank');
            
            // Loop through overall ranks to store them
            foreach ($overallRanks as $candidateId => $overallRank) {
                // Create or update the SwimSuitOR record for this candidate
                $swimSuitOR = SwimSuitOR::where('candidate_number', $candidateId)->first();
                if (!$swimSuitOR) {
                    SwimSuitOR::create([
                        'candidate_number' => $candidateId,
                        'overall_rank' => $overallRank,
                    ]);
                } else {
                    $swimSuitOR->update(['overall_rank' => $overallRank]);
                }
            }
            
            // Redirect back or return any other response as needed
            return redirect()->route('usermanage.prelim_gown_dash')->with('success', 'Swim suit overall ranks submitted successfully!');
        }

        public function storeGownOverallRanks(Request $request)
        {
            // Fetch overall ranks for each candidate from the request
            $overallRanks = $request->input('overall_rank');
            
            // Loop through overall ranks to store them
            foreach ($overallRanks as $candidateId => $overallRank) {
                // Create or update the GownOR record for this candidate
                $gownOR = GownOR::where('candidate_number', $candidateId)->first();
                if (!$gownOR) {
                    GownOR::create([
                        'candidate_number' => $candidateId,
                        'overall_rank' => $overallRank,
                    ]);
                } else {
                    $gownOR->update(['overall_rank' => $overallRank]);
                }
            }
            
            // Redirect back or return any other response as needed
            return redirect()->route('usermanage.prelim_overall_ranks_dash')->with('success', 'Gown overall ranks submitted successfully!');
        }
        
        public function SemiFinalDash()
        {
            return view('usermanage.semi_final_dash');
        }
}
