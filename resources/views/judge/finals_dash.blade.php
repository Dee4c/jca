<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judge Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
    body{
        background: rgb(0,0,0);
        background: linear-gradient(90deg, rgba(0,0,0,1) 17%, rgba(198,174,53,1) 75%);
        font-family: 'Roboto', sans-serif;
    }
    /* Google Font Link */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        background: rgb(168, 61, 61);
        background: linear-gradient(90deg, rgba(0, 0, 0, 1) 59%, rgba(198, 174, 53, 1) 99%);
        width: 250px;
        padding: 6px 14px;
        z-index: 99;
        transition: all 0.5s ease;
    }

    .sidebar .logo-details {
        height: 60px;
        display: flex;
        align-items: center;
        position: relative;
        padding-right: 50px;
    }

    .sidebar .logo-details .icon {
        position: absolute;
        top: 50%;
        right: -25px;
        transform: translateY(-50%);
        font-size: 22px;
        color: #fff;
        transition: all 0.5s ease;
    }

    .sidebar .logo-details .icon {
        right: 0;
    }

    .sidebar .logo-details .logo_name {
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        margin-left: 40px;
        opacity: 1;
        transition: all 0.5s ease;
    }

    .sidebar .logo-details #btn {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        font-size: 22px;
        transition: all 0.4s ease;
        font-size: 23px;
        text-align: center;
        cursor: pointer;
        transition: all 0.5s ease;
    }

    .sidebar .logo-details #btn {
        text-align: right;
    }

    .sidebar i {
        color: #fff;
        height: 60px;
        min-width: 50px;
        font-size: 28px;
        text-align: center;
        line-height: 60px;
    }

    .sidebar .nav-list {
        margin-top: 20px;
        height: 100%;
    }

    .sidebar li {
        position: relative;
        margin: 8px 0;
        list-style: none;
    }

    .sidebar li .tooltip {
        position: absolute;
        top: -20px;
        left: calc(100% + 15px);
        z-index: 3;
        background: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 15px;
        font-weight: 400;
        opacity: 0;
        white-space: nowrap;
        pointer-events: none;
        transition: 0s;
    }

    .sidebar li:hover .tooltip {
        opacity: 1;
        pointer-events: auto;
        transition: all 0.4s ease;
        top: 50%;
        transform: translateY(-50%);
    }

    .sidebar li.open .tooltip {
        display: none;
    }

    .sidebar input {
        font-size: 15px;
        color: #fff;
        font-weight: 400;
        outline: none;
        height: 50px;
        width: 100%;
        width: 50px;
        border: none;
        border-radius: 12px;
        transition: all 0.5s ease;
        background: #1d1b31;
    }

    .sidebar li a {
        display: flex;
        height: 100%;
        width: 100%;
        border-radius: 12px;
        align-items: center;
        text-decoration: none;
        transition: all 0.4s ease;
        background: #11101D;
    }

    .sidebar li a:hover {
        background: #FFF;
    }

    .sidebar li a .links_name {
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
        opacity: 1;
        pointer-events: auto;
        transition: 0.4s;
    }

    .sidebar li a:hover .links_name,
    .sidebar li a:hover i {
        transition: all 0.5s ease;
        color: #11101D;
    }

    .sidebar li i {
        height: 50px;
        line-height: 50px;
        font-size: 18px;
        border-radius: 12px;
    }

    .sidebar li.profile {
        position: fixed;
        height: 60px;
        width: 78px;
        left: 0;
        bottom: -8px;
        padding: 10px 14px;
        background: #1d1b31;
        transition: all 0.5s ease;
        overflow: hidden;
    }

    .sidebar li.profile .profile-details {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
    }

    .sidebar li img {
        height: 45px;
        width: 45px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 10px;
    }

    .sidebar li.profile .name,
    .sidebar li.profile .job {
        font-size: 15px;
        font-weight: 400;
        color: #fff;
        white-space: nowrap;
    }

    .sidebar li.profile .job {
        font-size: 12px;
    }

    .sidebar .profile #log_out {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        background: #1d1b31;
        width: 100%;
        height: 60px;
        line-height: 60px;
        border-radius: 0px;
        transition: all 0.5s ease;
    }

    .home-section {
        position: relative;
        background: #E4E9F7;
        min-height: 100vh;
        top: 0;
        left: 250px;
        width: calc(100% - 250px);
        transition: all 0.5s ease;
        z-index: 2;
    }

    .home-section .text {
        display: inline-block;
        color: #11101d;
        font-size: 25px;
        font-weight: 500;
        margin: 18px
    }

    @media (max-width: 420px) {
        .sidebar li .tooltip {
            display: none;
        }
    }

    /* Add custom styles here */
    .content {
        margin-left: 250px;
        padding: 20px;
    }

    .tbl-header {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .tbl-content {
        background-color: rgba(0, 0, 0, 0);
        height: 300px;
        overflow-x: auto;
        margin-top: 0px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    th {
        padding: 15px; /* Adjusted padding for header */
        text-align: center; /* Center align header text */
        font-weight: 500;
        font-size: 14px; /* Increased font size */
        color: #fff;
        text-transform: uppercase;
    }

    td {
        padding: 15px; /* Adjusted padding for table cells */
        text-align: center; /* Center align cell text */
        vertical-align: middle;
        font-weight: 300;
        font-size: 14px; /* Increased font size */
        color: #fff;
        border-bottom: solid 1px rgba(255, 255, 255, 0.1);
    }

    .title-id {
        color: white;
    }

    .form-select {
        width: 200px; /* Adjust the width as needed */
    }


   
</style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Miss Q</div>
    </div>
    <ul class="nav-list">
        <li class="dropdown">
            <a href="#">
                <i class='bx bx-user'></i>
                <span class="links_name">PRELIMINARIES</span>
            </a>
        </li>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            </ul>
        </li>
        <li>
            <a href="{{ route('judge.semi_finals_dash') }}">
                <i class='bx bxs-user-check'></i>
                <span class="links_name">SEMI-FINALS</span>
            </a>
            <span class="tooltip">SEMI-FINALS</span>
        </li>
        <li>
            <a href="{{ route('judge.finals_dash') }}">
                <i class='bx bx-edit'></i>
                <span class="links_name">FINALS</span>
            </a>
            <span class="tooltip">FINALS</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="profile.jpg" alt="profileImg">
                <div class="name_job">
                    <div class="name">{{ Session::get('userName') }}</div> <!-- Display user's name from session -->
                </div>
            </div>
            <a href="{{ route('logout') }}" class="logout-link">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>

<div class="content">
    <div class="container">
        <h1 class="title-id">FINAL TABLE</h1>
        <div class="dropdown">
            <select class="form-select" id="categorySelect">
                <option value="">Select Category</option>
                <option value="final">Finals</option>
                <!-- Add other categories as needed -->
            </select>
        </div>
        <br>

        <!-- Finals Form -->
        <form id="final_form" action="{{ route('final-scores.store') }}" method="POST">
            @csrf
            <div id="final_table" class="category-table" style="display: none;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Candidate Number</th>
                            <th>Beauty of Face and Figure (Score: 75-100)</th>
                            <th>Poise, Grace and Projection (Score: 75-100)</th>
                            <th>Composure during Interview (Score: 75-100)</th>
                            <th>Total Score</th>
                            <th>Rank</th>
                        </tr>
                    </thead>
                    <tbody id="final_table_body">
                        @foreach($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->candidate_number }}</td>
                            <td>
                                <input type="number" name="beauty_of_face[]" data-candidate-id="{{ $candidate->id }}" min="75" max="100" required 
                                    value="{{ $submittedScores[$candidate->candidate_number]['beauty_of_face'] ?? '' }}" 
                                    onchange="calculateTotalScore({{ $candidate->id }})">
                            </td>
                            <td>
                                <input type="number" name="poise_grace_projection[]" data-candidate-id="{{ $candidate->id }}" min="75" max="100" required 
                                    value="{{ $submittedScores[$candidate->candidate_number]['poise_grace_projection'] ?? '' }}" 
                                    onchange="calculateTotalScore({{ $candidate->id }})">
                            </td>
                            <td>
                                <input type="number" name="composure[]" data-candidate-id="{{ $candidate->id }}" min="75" max="100" required 
                                    value="{{ $submittedScores[$candidate->candidate_number]['composure'] ?? '' }}" 
                                    onchange="calculateTotalScore({{ $candidate->id }})">
                            </td>
                            <td>
                                <input type="text" name="total_score[]" id="totalScore_{{ $candidate->id }}" readonly 
                                    value="{{ $submittedScores[$candidate->candidate_number]['total'] ?? '' }}">
                            </td>
                            <td>
                                <input type="text" name="rank[]" id="rank_{{ $candidate->id }}" readonly 
                                    value="{{ $submittedScores[$candidate->candidate_number]['rank'] ?? '' }}">
                            </td>
                            <input type="hidden" name="judge_name[]" value="{{ Session::get('userName') }}">
                            <input type="hidden" name="candidate_number[]" value="{{ $candidate->candidate_number }}">
                            <input type="hidden" name="candidate_rank[]" id="candidate_rank_{{ $candidate->id }}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary" id="submitButton" @if(!empty($submittedScores)) disabled @endif>Submit</button>
                <button type="button" class="btn btn-secondary" id="editButton" onclick="enableEditing()">@if(!empty($submittedScores)) Edit Scores @else Cancel Edit @endif</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to calculate the total score and rank for finals category
    function calculateTotalScore(candidateId) {
        var beautyOfFaceScore = parseInt(document.querySelector('input[name="beauty_of_face[]"][data-candidate-id="' + candidateId + '"]').value) || 0;
        var poiseGraceProjectionScore = parseInt(document.querySelector('input[name="poise_grace_projection[]"][data-candidate-id="' + candidateId + '"]').value) || 0;
        var composureScore = parseInt(document.querySelector('input[name="composure[]"][data-candidate-id="' + candidateId + '"]').value) || 0;
        var totalScore = (beautyOfFaceScore + poiseGraceProjectionScore + composureScore) / 3; // Calculate the average
        document.getElementById("totalScore_" + candidateId).value = totalScore.toFixed(2); // Display total score
        updateRank(); // Update ranks after calculating total score
    }

    // Function to update the rank for finals category
    function updateRank() {
        var totalScores = [];
        document.querySelectorAll('input[name^="total_score"]').forEach(function(scoreInput) {
            var score = parseFloat(scoreInput.value);
            totalScores.push(score);
        });

        totalScores.sort(function(a, b) {
            return b - a;
        });

        var rank = 1;
        var prevScore = null;
        totalScores.forEach(function(score) {
            if (score !== prevScore) {
                var rankCount = 0;
                document.querySelectorAll('input[name^="total_score"]').forEach(function(scoreInput) {
                    if (parseFloat(scoreInput.value) === score) {
                        rankCount++;
                    }
                });

                var currentRank = rank;
                document.querySelectorAll('input[name^="total_score"]').forEach(function(scoreInput) {
                    if (parseFloat(scoreInput.value) === score) {
                        var candidateId = scoreInput.id.split("_")[1];
                        var rankInput = document.getElementById("rank_" + candidateId);
                        rankInput.value = currentRank;
                    }
                });

                rank += rankCount;
            }
            prevScore = score;
        });
    }

    // Event listener for category selection change
    document.getElementById('categorySelect').addEventListener('change', function() {
        var selectedCategory = this.value;
        document.querySelectorAll('.category-table').forEach(function(table) {
            table.style.display = 'none';
        });
        if (selectedCategory === 'final') {
            document.getElementById('final_table').style.display = 'table';
        }
    });

    // Call calculateTotalScore for initial calculation in finals category
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name^="beauty_of_face"], input[name^="poise_grace_projection"], input[name^="composure"]').forEach(function(input) {
            var candidateId = input.dataset.candidateId;
            calculateTotalScore(candidateId);
        });
    });

    // Function to enable editing of scores
    function enableEditing() {
        document.querySelectorAll('input[name^="beauty_of_face"], input[name^="poise_grace_projection"], input[name^="composure"]').forEach(function(input) {
            input.removeAttribute('readonly');
        });
        document.getElementById('submitButton').removeAttribute('disabled');
    }
</script>

</body>
</html>