<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Candidate;
use App\Models\SwimSuitScore;
use App\Models\PreInterviewScore;
use App\Models\GownScore;
use App\Models\TopCandidates;
use App\Models\SemiFinalScore;
use App\Models\FinalScore;
use App\Models\FinalistCandidates;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Support\Facades\DB;


class UserManagementController extends Controller
{
    public function addJudgeForm()
    {
        $uniqueCode = $this->generateUniqueCode(); // Replace with your actual logic to generate unique code
        return view('usermanage.add_judge', compact('uniqueCode'));
    }

    private function generateUniqueCode($length = 6)
    {
        return Str::random($length);
    }

    public function addJudge(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'role' => 'required|in:judge_prelim,judge_gown,judge_semi,judge_final', // Corrected spacing
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Generate unique code
    $uniqueCode = $this->generateUniqueCode(); // Generate random unique code

    // Create new user instance
    $user = new User;
    $user->name = $request->name;
    $user->role = $request->role;
    $user->unique_code = $uniqueCode; // Assign generated unique code
    $user->save();

    // Redirect with success message and pass $uniqueCode to the view
    return redirect()->route('usermanage.dashboard')->with('success', 'Judge added successfully!')->with('uniqueCode', $uniqueCode);
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
    
    public function candidateDash(Request $request)
    {
        $search = $request->query('search'); // Retrieve the 'search' query parameter from the request

        // Query to fetch candidates
        $candidatesQuery = Candidate::query();

        // If a search term is provided, filter candidates by 'candidateName'
        if (!empty($search)) {
            $candidatesQuery->where('candidateName', 'like', '%' . $search . '%');
        }

        // Retrieve all candidates matching the search criteria or all candidates if no search term provided
        $candidates = $candidatesQuery->get();

        // Return the view with the filtered candidates
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
        try {
            // Fetch all candidates
            $candidates = Candidate::all();

            // Loop through candidates to fetch scores and calculate total
            foreach ($candidates as $candidate) {
                // Fetch and sum Pre-Interview Rank
                $preInterviewScores = PreInterviewScore::where('candidate_number', $candidate->candidateNumber)->get();
                $candidate->preInterviewRank = $preInterviewScores->sum('rank') ?: '-';

                // Fetch and sum Swim-Suit Rank
                $swimSuitScores = SwimSuitScore::where('candidate_number', $candidate->candidateNumber)->get();
                $candidate->swimSuitRank = $swimSuitScores->sum('rank') ?: '-';

                // Fetch and sum Gown Rank
                $gownScores = GownScore::where('candidate_number', $candidate->candidateNumber)->get();
                $candidate->gownRank = $gownScores->sum('rank') ?: '-';

                // Calculate Total
                $candidate->total = ($preInterviewScores->sum('rank') ?: 0)
                                    + ($swimSuitScores->sum('rank') ?: 0)
                                    + ($gownScores->sum('rank') ?: 0);
            }

            // Sort candidates by total score in ascending order to rank lowest total first
            $candidates = $candidates->sortBy('total');

            // Assign overall rank based on sorted total score (ascending)
            $rank = 1;
            foreach ($candidates as $candidate) {
                $candidate->overallRank = $rank++;
            }

            // Fetch detailed scores with judges' names (if needed)
            $preInterviewScores = DB::table('pre_interview_scores')
                ->join('candidates', DB::raw('CAST(pre_interview_scores.candidate_number AS TEXT)'), '=', DB::raw('CAST("candidates"."candidateNumber" AS TEXT)'))
                ->select('candidates.candidateNumber', 'candidates.candidateName', 'pre_interview_scores.judge_name', 'pre_interview_scores.rank')
                ->get();

            $swimSuitScores = DB::table('swim_suit_scores')
                ->join('candidates', DB::raw('CAST(swim_suit_scores.candidate_number AS TEXT)'), '=', DB::raw('CAST("candidates"."candidateNumber" AS TEXT)'))
                ->select('candidates.candidateNumber', 'candidates.candidateName', 'swim_suit_scores.judge_name', 'swim_suit_scores.rank')
                ->get();

            $gownScores = DB::table('gown_scores')
                ->join('candidates', DB::raw('CAST(gown_scores.candidate_number AS TEXT)'), '=', DB::raw('CAST("candidates"."candidateNumber" AS TEXT)'))
                ->select('candidates.candidateNumber', 'candidates.candidateName', 'gown_scores.judge_name', 'gown_scores.rank')
                ->get();

            // Check if the top 8 candidates have already been inserted
            $isSubmitted = TopCandidates::count() >= 8;

            // Pass data to the view
            return view('usermanage.preliminary_dash', compact('candidates', 'preInterviewScores', 'swimSuitScores', 'gownScores', 'isSubmitted'));
        } catch (\Exception $e) {
            \Log::error('Error fetching data in preliminaryDash: ' . $e->getMessage());
            return back()->withError('Error fetching data: ' . $e->getMessage());
        }
    }

    public function judgeDashboard()
    {
        // Fetch all candidates
        $candidates = Candidate::all();
    
        // Fetch submitted scores for the current judge
        $judgeName = Session::get('userName');
        $submittedScores = PreInterviewScore::where('judge_name', $judgeName)
            ->get()
            ->keyBy('candidate_number')
            ->toArray();
    
        // Pass candidates and submitted scores to the view
        return view('judge.judge_dashboard', compact('candidates', 'submittedScores')); 
    }
    
    public function semifinalsDashboard()
    {
        $TopCandidates = TopCandidates::orderBy('candidate_number')->limit(8)->get();

        // Fetch submitted scores for the current judge
        $judgeName = Session::get('userName');
        $submittedScores = SemiFinalScore::where('judge_name', $judgeName)
            ->get()
            ->keyBy('candidate_number')
            ->toArray();
        
        // Pass candidate data to the view
        return view('judge.semi_finals_dash', compact('TopCandidates', 'submittedScores'));
    }

    public function storePreInterviewScore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'candidate_number' => 'required|array',
            'candidate_number.*' => 'required|integer',
            'composure' => 'required|array',
            'composure.*' => 'required|integer|min:75|max:100',
            'poise_grace_projection' => 'required|array',
            'poise_grace_projection.*' => 'required|integer|min:75|max:100',
            'judge_name' => 'required|array',
            'judge_name.*' => 'required|string|max:255',
            'rank' => 'required|array',
            'rank.*' => 'required|integer',
        ]);
    
        // Array to hold total scores for each candidate
        $totalScores = [];
    
        // Loop through the submitted data and calculate total scores
        foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
            $composure = $validatedData['composure'][$index];
            $poiseGraceProjection = $validatedData['poise_grace_projection'][$index];
    
            // Calculate the total score by averaging the two scores
            $totalScore = ($composure + $poiseGraceProjection) / 2;
    
            // Check if scores already exist for this candidate and judge
            $existingScore = PreInterviewScore::where('candidate_number', $candidateNumber)
                ->where('judge_name', $validatedData['judge_name'][$index])
                ->first();
    
            if ($existingScore) {
                // Update the existing score
                $existingScore->update([
                    'composure' => $composure,
                    'poise_grace_projection' => $poiseGraceProjection,
                    'total' => $totalScore,
                    'rank' => $validatedData['rank'][$index],
                ]);
            } else {
                // Store the new pre-interview score in the database
                PreInterviewScore::create([
                    'candidate_number' => $candidateNumber,
                    'composure' => $composure,
                    'poise_grace_projection' => $poiseGraceProjection,
                    'total' => $totalScore,
                    'rank' => $validatedData['rank'][$index],
                    'judge_name' => $validatedData['judge_name'][$index],
                ]);
            }
    
            // Store the total score for ranking purposes
            $totalScores[$candidateNumber] = $totalScore;
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
    
            // Update the rank in the database for each candidate
            PreInterviewScore::where('candidate_number', $candidateNumber)
                ->update(['rank' => $rank]);
    
            $prevScore = $totalScore;
        }
    
        // Redirect back to the judge dashboard page
        return redirect()->back()->with('success', 'Pre-Interview scores submitted successfully!');
    }
        
    public function storeSwimSuitScore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'candidate_number' => 'required|array',
            'candidate_number.*' => 'required|integer',
            'composure' => 'required|array',
            'composure.*' => 'required|integer|min:75|max:100',
            'poise_grace_projection' => 'required|array',
            'poise_grace_projection.*' => 'required|integer|min:75|max:100',
            'judge_name' => 'required|array',
            'judge_name.*' => 'required|string|max:255',
            'rank' => 'required|array',
            'rank.*' => 'required|integer',
        ]);
    
        // Array to hold total scores for each candidate
        $totalScores = [];
    
        // Loop through the submitted data and calculate total scores
        foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
            $composure = $validatedData['composure'][$index];
            $poiseGraceProjection = $validatedData['poise_grace_projection'][$index];
    
            // Calculate the total score by averaging the two scores
            $totalScore = ($composure + $poiseGraceProjection) / 2;
    
            // Check if scores already exist for this candidate and judge
            $existingScore = SwimSuitScore::where('candidate_number', $candidateNumber)
                ->where('judge_name', $validatedData['judge_name'][$index])
                ->first();
    
            if ($existingScore) {
                // Update the existing score
                $existingScore->update([
                    'composure' => $composure,
                    'poise_grace_projection' => $poiseGraceProjection,
                    'total' => $totalScore,
                    'rank' => $validatedData['rank'][$index],
                ]);
            } else {
                // Store the new swim-suit score in the database
                SwimSuitScore::create([
                    'candidate_number' => $candidateNumber,
                    'composure' => $composure,
                    'poise_grace_projection' => $poiseGraceProjection,
                    'total' => $totalScore,
                    'rank' => $validatedData['rank'][$index],
                    'judge_name' => $validatedData['judge_name'][$index],
                ]);
            }
    
            // Store the total score for ranking purposes
            $totalScores[$candidateNumber] = $totalScore;
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
    
            // Update the rank in the database for each candidate
            SwimSuitScore::where('candidate_number', $candidateNumber)
                ->update(['rank' => $rank]);
    
            $prevScore = $totalScore;
        }
    
        // Redirect back to the judge dashboard page
        return redirect()->back()->with('success', 'Swimsuit scores submitted successfully!');
    }
    
    public function storeGownScore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'candidate_number' => 'required|array',
            'candidate_number.*' => 'required|integer',
            'suitability' => 'required|array',
            'suitability.*' => 'required|integer|min:75|max:100',
            'poise_grace_projection' => 'required|array',
            'poise_grace_projection.*' => 'required|integer|min:75|max:100',
            'judge_name' => 'required|array',
            'judge_name.*' => 'required|string|max:255',
            'rank' => 'required|array',
            'rank.*' => 'required|integer',
        ]);

        // Array to hold total scores for each candidate
        $totalScores = [];

        // Array to hold updates for bulk insertion
        $updates = [];

        // Loop through the submitted data and calculate total scores
        foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
            $suitability = $validatedData['suitability'][$index];
            $poiseGraceProjection = $validatedData['poise_grace_projection'][$index];

            // Calculate the total score by averaging the two scores
            $totalScore = ($suitability + $poiseGraceProjection) / 2;

            // Prepare data for update or creation
            $data = [
                'candidate_number' => $candidateNumber,
                'suitability' => $suitability,
                'poise_grace_projection' => $poiseGraceProjection,
                'total' => $totalScore,
                'rank' => $validatedData['rank'][$index],
                'judge_name' => $validatedData['judge_name'][$index],
                // Explicitly set the created_at timestamp
                'created_at' => now(), // or use Carbon::now() if necessary
            ];

            // Check if scores already exist for this candidate and judge
            $existingScore = GownScore::where('candidate_number', $candidateNumber)
                ->where('judge_name', $data['judge_name'])
                ->first();

            if ($existingScore) {
                // Update the existing score
                $existingScore->update($data);
            } else {
                // Store the new gown score in the updates array for bulk insertion
                $updates[] = $data;
            }

            // Store the total score for ranking purposes
            $totalScores[$candidateNumber] = $totalScore;
        }

        // Perform bulk update for new scores
        if (!empty($updates)) {
            GownScore::insert($updates);
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

            // Update the rank in the database for each candidate
            GownScore::where('candidate_number', $candidateNumber)
                ->update(['rank' => $rank]);

            $prevScore = $totalScore;
        }

        // Redirect back to the previous page (same page) with success message
        return redirect()->back()->with('success', 'Gown scores submitted successfully!');
    }

        public function swimSuitTable()
        {
            // Fetch all candidates
            $candidates = Candidate::all();
        
            // Fetch submitted scores for the current judge
            $judgeName = Session::get('userName');
            $submittedScores = SwimSuitScore::where('judge_name', $judgeName)
                ->get()
                ->keyBy('candidate_number')
                ->toArray();
        
            // Pass candidates and submitted scores to the view
            return view('judge.swim_suit_table', compact('candidates', 'submittedScores')); 
        }
        
        public function gownTable()
        {
            $candidates = Candidate::all();
        
            // Fetch submitted scores for the current judge
            $judgeName = Session::get('userName');
            $submittedScores = GownScore::where('judge_name', $judgeName)
                ->get()
                ->keyBy('candidate_number')
                ->toArray();
        
            // Pass candidates and submitted scores to the view
            return view('judge.gown_table', compact('candidates', 'submittedScores'));
        }
    
        public function SemiFinalDash()
        {
            try {
                // Fetch all top candidates with their ranks
                $topCandidates = SemiFinalScore::select('candidate_number')
                    ->selectRaw('SUM(rank) AS total_rank')
                    ->groupBy('candidate_number')
                    ->orderBy('total_rank')
                    ->limit(8)
                    ->get();
        
                // Assign overall rank based on the sorted total ranks
                $rank = 1;
                foreach ($topCandidates as $candidate) {
                    $candidate->overall_rank = $rank++;
                }
        
                // Check if top 4 finalists have already been submitted
                $isSubmitted = FinalistCandidates::count() >= 4;
        
                // Pass candidate data and submission status to the view
                return view('usermanage.semi_final_dash', compact('topCandidates', 'isSubmitted'));
            } catch (\Exception $e) {
                return back()->withError('Error fetching data: ' . $e->getMessage());
            }
        }
        
        public function dashboard()
        {
            $users = User::where('role', '!=', 'admin')->get();
            return view('usermanage.dashboard', compact('users'));
        }

        public function updateUser(Request $request, $id)
        {
            $validator = Validator::make($request->all(), [
                'edit_name' => 'required',
                'edit_role' => 'required|in:judge_prelim,judge_gown,judge_semi,judge_final', // Corrected spacing
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            $user->name = $request->edit_name;
            $user->role = $request->edit_role;
            $user->save();

            return redirect()->route('usermanage.dashboard')->with('success', 'User updated successfully');
        }

        public function insertSemiFinalists(Request $request)
        {
            // Retrieve candidate inputs
            $topCandidateIds = $request->input('candidate'); // Assuming the name of your checkboxes is 'candidate[]'
            $candidateNames = $request->input('candidate_name'); // Get candidate_name values
            $overallRanks = $request->input('overallRank'); // Get overallRank values
        
            // Validate number of candidates selected
            $numCandidates = count($topCandidateIds);
            if ($numCandidates !== 8) {
                return redirect()->back()->with('error', 'You must select exactly 8 candidates for the semi-finals.');
            }
        
            try {
                // Begin a transaction
                DB::beginTransaction();
        
                // Create an array to hold candidate data
                $candidates = [];
        
                // Process each selected candidate
                foreach ($topCandidateIds as $key => $candidateId) {
                    $index = array_search($candidateId, $topCandidateIds);
        
                    // Add candidate data to the array
                    $candidates[] = [
                        'candidate_number' => $candidateId,
                        'candidate_name' => $candidateNames[$index],
                        'overall_rank' => $overallRanks[$index],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
        
                // Sort the candidates by their overall_rank
                usort($candidates, function($a, $b) {
                    return $a['overall_rank'] - $b['overall_rank'];
                });
        
                // Assign new overall ranks starting from 1
                foreach ($candidates as $index => &$candidate) {
                    $candidate['overall_rank'] = $index + 1;
                }
        
                // Insert into TopCandidates table
                TopCandidates::insert($candidates);
        
                // Commit the transaction
                DB::commit();
        
                // Redirect back to the previous page after successful insertion
                return redirect()->back()->with('success', 'Top candidates inserted into TopCandidates table.');
            } catch (\Exception $e) {
                // Rollback the transaction on exception
                DB::rollback();
                return redirect()->back()->with('error', 'Failed to insert top candidates. ' . $e->getMessage());
            }
        }
                         
        public function storeSemiFinalScore(Request $request)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'candidate_number' => 'required|array',
                'candidate_number.*' => 'required|integer',
                'beauty_of_face' => 'required|array',
                'beauty_of_face.*' => 'required|integer|min:0|max:50',
                'poise_grace_projection' => 'required|array',
                'poise_grace_projection.*' => 'required|integer|min:0|max:35',
                'composure' => 'required|array',
                'composure.*' => 'required|integer|min:0|max:15',
                'judge_name' => 'required|array',
                'judge_name.*' => 'required|string|max:255',
                'rank' => 'required|array',
                'rank.*' => 'required|integer',
            ]);
        
            // Array to hold total scores for each candidate
            $totalScores = [];
        
            // Loop through the submitted data and calculate total scores
            foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
                $beautyOfFace = $validatedData['beauty_of_face'][$index];
                $poiseGraceProjection = $validatedData['poise_grace_projection'][$index];
                $composure = $validatedData['composure'][$index];
        
                // Calculate the total score by summing up the scores
                $totalScore = $beautyOfFace + $poiseGraceProjection + $composure;
        
                // Check if scores already exist for this candidate and judge
                $existingScore = SemiFinalScore::where('candidate_number', $candidateNumber)
                    ->where('judge_name', $validatedData['judge_name'][$index])
                    ->first();
        
                if ($existingScore) {
                    // Update the existing score
                    $existingScore->update([
                        'beauty_of_face' => $beautyOfFace,
                        'poise_grace_projection' => $poiseGraceProjection,
                        'composure' => $composure,
                        'total' => $totalScore,
                        'rank' => $validatedData['rank'][$index],
                    ]);
                } else {
                    // Store the new semi-final score in the database
                    SemiFinalScore::create([
                        'candidate_number' => $candidateNumber,
                        'beauty_of_face' => $beautyOfFace,
                        'poise_grace_projection' => $poiseGraceProjection,
                        'composure' => $composure,
                        'total' => $totalScore,
                        'rank' => $validatedData['rank'][$index],
                        'judge_name' => $validatedData['judge_name'][$index],
                    ]);
                }
        
                // Store the total score for ranking purposes
                $totalScores[$candidateNumber] = $totalScore;
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
        
                // Update the rank in the database for each candidate
                SemiFinalScore::where('candidate_number', $candidateNumber)
                    ->update(['rank' => $rank]);
        
                $prevScore = $totalScore;
            }
        
            // Redirect back to the judge dashboard page
            return redirect()->back()->with('success', 'Semi-Finals scores submitted successfully!');
        }
        
        public function finalsDashboard()
        {
            // Fetch all finalists ordered by candidate_number ascending
            $candidates = FinalistCandidates::orderBy('candidate_number', 'asc')->get();
            
            // Fetch submitted scores for the current judge
            $judgeName = Session::get('userName');
            $submittedScores = FinalScore::where('judge_name', $judgeName)
                ->get()
                ->keyBy('candidate_number')
                ->toArray();
        
            // Pass candidates and submitted scores to the view
            return view('judge.finals_dash', compact('candidates', 'submittedScores'));
        }
        
        public function storeFinalScore(Request $request)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'candidate_number' => 'required|array',
                'candidate_number.*' => 'required|integer',
                'beauty_of_face' => 'required|array',
                'beauty_of_face.*' => 'required|integer|min:0|max:50', // Corrected max value
                'poise_grace_projection' => 'required|array',
                'poise_grace_projection.*' => 'required|integer|min:0|max:35', // Corrected max value
                'composure' => 'required|array',
                'composure.*' => 'required|integer|min:0|max:15', // Corrected max value
                'judge_name' => 'required|array',
                'judge_name.*' => 'required|string|max:255',
                'rank' => 'required|array',
                'rank.*' => 'required|integer',
            ]);
        
            // Loop through the validated data and store/update in the database
            foreach ($validatedData['candidate_number'] as $index => $candidateNumber) {
                $beautyOfFace = $validatedData['beauty_of_face'][$index];
                $poiseGraceProjection = $validatedData['poise_grace_projection'][$index];
                $composure = $validatedData['composure'][$index];
                $totalScore = $beautyOfFace + $poiseGraceProjection + $composure;
        
                // Check if score exists for this candidate and judge
                $existingScore = FinalScore::where('candidate_number', $candidateNumber)
                    ->where('judge_name', $validatedData['judge_name'][$index])
                    ->first();
        
                if ($existingScore) {
                    // Update existing score
                    $existingScore->update([
                        'beauty_of_face' => $beautyOfFace,
                        'poise_grace_projection' => $poiseGraceProjection,
                        'composure' => $composure,
                        'total' => $totalScore,
                        'rank' => $validatedData['rank'][$index],
                    ]);
                } else {
                    // Create new score
                    FinalScore::create([
                        'candidate_number' => $candidateNumber,
                        'beauty_of_face' => $beautyOfFace,
                        'poise_grace_projection' => $poiseGraceProjection,
                        'composure' => $composure,
                        'total' => $totalScore,
                        'rank' => $validatedData['rank'][$index],
                        'judge_name' => $validatedData['judge_name'][$index],
                    ]);
                }
            }
        
            // Redirect back with success message
            return redirect()->back()->with('success', 'Final scores submitted successfully!');
        }
                
        public function insertFinalists(Request $request)
        {
            // Retrieve candidate inputs
            $topCandidateIds = $request->input('candidate'); // Array of selected candidate IDs
            $overallRanks = $request->input('overallRank'); // Array of corresponding overall ranks
        
            // Validate $topCandidateIds and $overallRanks
            if (!is_array($topCandidateIds) || empty($topCandidateIds) || !is_array($overallRanks) || empty($overallRanks)) {
                return redirect()->back()->with('error', 'Please select candidates and provide overall ranks for the semi-finals.');
            }
        
            try {
                // Begin a transaction
                DB::beginTransaction();
        
                // Fetch candidate names and overall ranks from topCandidates
                $topCandidates = TopCandidates::whereIn('candidate_number', $topCandidateIds)->get();
        
                // Create an array to hold finalist data
                $finalists = [];
        
                // Process each selected candidate
                foreach ($topCandidates as $index => $candidate) {
                    // Ensure we have a corresponding overall rank
                    if (isset($overallRanks[$index])) {
                        $finalists[] = [
                            'candidate_number' => $candidate->candidate_number,
                            'candidate_name' => $candidate->candidate_name,
                            'overall_rank' => $overallRanks[$index], // Assign overall rank based on form submission
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
        
                // Insert into FinalistCandidates model/table
                FinalistCandidates::insert($finalists);
        
                // Commit the transaction
                DB::commit();
        
                // Redirect back to the previous page after successful insertion
                return redirect()->back()->with('success', 'Top finalists inserted successfully.');
            } catch (\Exception $e) {
                // Rollback the transaction on exception
                DB::rollback();
                return redirect()->back()->with('error', 'Failed to insert top finalists. ' . $e->getMessage());
            }
        }

        public function deleteUser($id)
        {
            $user = User::find($id);
    
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
    
            $user->delete();
    
            return redirect()->route('usermanage.dashboard')->with('success', 'User deleted successfully');
        }

        public function FinalDash(Request $request)
{
    try {
        // Fetch candidate numbers and their total ranks from final_scores table
        $topCandidates = FinalScore::select('candidate_number')
            ->selectRaw('SUM(rank) AS total_rank')
            ->groupBy('candidate_number')
            ->orderBy('total_rank')
            ->get();

        // Assign overall rank based on the sorted total ranks
        $rank = 1;
        foreach ($topCandidates as $candidate) {
            $candidate->overall_rank = $rank++;
        }

        // Fetch candidate names from top_candidates table and associate them with their candidate numbers
        foreach ($topCandidates as $candidate) {
            $candidate_name = TopCandidates::where('candidate_number', $candidate->candidate_number)
                ->value('candidate_name');
            $candidate->candidate_name = $candidate_name;
        }

        // Check if top 4 finalists have already been submitted
        $isSubmitted = FinalistCandidates::count() >= 4; // Adjust logic as per your application

        // Pass candidate data and submission status to the view
        return view('usermanage.final_dash', compact('topCandidates', 'isSubmitted'));
    } catch (\Exception $e) {
        return back()->withError('Error fetching data: ' . $e->getMessage());
    }
}

    public function dashboardMain()
    {
        // Counting judges in different roles
        $judgesCount = User::where('role', 'like', '%judge%')->count();
        $preliminaryJudgesCount = User::where('role', 'judge_prelim')->count();
        $semiFinalJudgesCount = User::where('role', 'judge_semi')->count();
        $finalJudgesCount = User::where('role', 'judge_final')->count();

        // Counting all candidates
        $candidatesCount = Candidate::count();

        // Fetching data for candidates joined per year
        $candidatesJoinedPerYear = Candidate::select(DB::raw('COUNT(*) as count'), DB::raw('EXTRACT(YEAR FROM created_at) as year'))
            ->groupBy(DB::raw('EXTRACT(YEAR FROM created_at)'))
            ->get();

        // Assuming you have $candidatesJoinedPerYear as a collection of counts per year
        $years = [];
        $counts = [];
        foreach ($candidatesJoinedPerYear as $data) {
            $years[] = $data->year;
            $counts[] = $data->count;
        }

        return view('usermanage.dashboard_main', [
            'judgesCount' => $judgesCount,
            'preliminaryJudgesCount' => $preliminaryJudgesCount,
            'semiFinalJudgesCount' => $semiFinalJudgesCount,
            'finalJudgesCount' => $finalJudgesCount,
            'candidatesCount' => $candidatesCount,
            'years' => $years, // Pass years array to the view
            'candidatesJoinedPerYear' => $counts, // Pass counts array to the view
        ]);
    }
        public function resetData(Request $request)
    {
        try {
            // Run migration refresh command
            Artisan::call('migrate:fresh');

            // Seed the database using the UserAdminSeeder
            $seeder = new AdminUserSeeder();
            $seeder->run();

            // Optionally, clear cached data if necessary
            Artisan::call('cache:clear');

            return response()->json(['message' => 'Database reset successful'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the reset process
            return response()->json(['error' => 'Database reset failed: ' . $e->getMessage()], 500);
        }
    }

    public function deleteAllCandidates()
    {
        // Delete all candidates
        Candidate::truncate();

        // Redirect back with a status message
        return redirect()->back()->with('success', 'Candidate deleted successfully');
    }

    public function deletePreliminaryScores()
    {
        // Delete Preliminary Scores
        PreInterviewScore::truncate();
        SwimSuitScore::truncate();
        GownScore::truncate();

        // Redirect back with a status message
        return redirect()->back()->with('success', 'All Scores have been Deleted!');   
    }

    public function deleteSemiFinalScores()
    {
        // Assuming you're using Eloquent model to delete records
        SemiFinalScore::truncate();
    
        // Redirect back with a status message
        return redirect()->back()->with('success', 'All Scores have been Deleted!');
    }
    
    public function deleteFinalScores()
    {
        //Delete Semi Final Scores
        FinalScore::truncate();

        // Redirect back with a status message
        return redirect()->back()->with('success', 'All Scores have been Deleted!'); 
    }
}