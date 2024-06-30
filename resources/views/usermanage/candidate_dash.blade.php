<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background: rgb(0, 0, 0);
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
            color: gold;
            font-size:40px;
            font-weight: 700;
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
    
        .add-judge-btn {
            margin-bottom: 20px; /* Adjusted margin */
        }
    
        /* Updated table styles */
        table {
            width: 100%;
            table-layout: fixed;
            background-color: #11101D;
            color: #fff;
        }
    
        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }
    
        .tbl-content {
            height: 300px;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    
        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: black;
            text-transform: uppercase;
        }
    
        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }
    
        /* Added button styles */
        .btn {
            background-color: #0275d8;
            border: none;
            color: white;
            padding: 5px 12px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
    
        .btn:hover {
            background-color: #5bc0de;
        }

        .add-judge-btn {
            margin-left: 390px;
            margin-top:36px;
            
        }

        .title-id {
            color: white;
            margin: auto;
        }

        .btn.btn-danger {
            background-color: #ff6347; /* Red color */
        }

        .btn.btn-danger:hover {
            background-color: red;
        }

        .candidate-image {
            height: 100px;
            width: 100px;
        }

        .input-group {
            position: absolute;
            margin-top:50px;
            top: 50px;
            width: 20%;
        }
        .table-bordered th{
            background: rgb(197,196,100);
            background: radial-gradient(circle, rgba(197,196,100,0.8650562275691527) 100%, rgba(176,183,31,0.4785016057204131) 100%);
        }
        .table-bordered td{
            background: rgb(236,235,142);
            background: radial-gradient(circle, rgba(236,235,142,0.8650562275691527) 100%, rgba(176,183,31,0.4785016057204131) 100%);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">Miss Q</div>
        </div>
        <ul class="nav-list">
            <li>
                <a href="{{route('usermanage.dashboardMain')}}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="{{route('usermanage.dashboard')}}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">User Management</span>
                </a>
                <span class="tooltip">User Management</span>
            </li>
            <li>
                <a href="{{route('usermanage.candidate_dash')}}">
                    <i class='bx bxs-user-check'></i>
                    <span class="links_name">Candidates</span>
                </a>
                <span class="tooltip">Candidate Management</span>
            </li>
            <li>
                <a href="{{route('usermanage.preliminary_dash')}}">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Preliminaries</span>
                </a>
            </li>
            <li>
                <a href="{{route('usermanage.semi_final_dash')}}">
                    <i class='bx bx-line-chart'></i>
                    <span class="links_name">Semi-Finals</span>
                </a>
                <span class="tooltip">Semi-Finals</span>
            </li>
            <li>
                <a href="{{route('usermanage.final_dash')}}">
                    <i class='bx bxs-crown'></i>
                    <span class="links_name">Finals</span>
                </a>
                <span class="tooltip">Finals</span>
            </li>
            <li class="profile">
                <a href="{{ route('logout') }}" class="logout-link">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h1 class="title-id">CANDIDATE MANAGEMENT</h1>

        <!-- Search Form -->
        <form action="{{ route('usermanage.candidate_dash') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by Name" name="search" value="{{ request()->input('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </div>
        </form>

        <!-- Add Candidate Button -->
        <div class="add-judge-btn">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add Candidate</button>
        </div>

       <!-- Delete All Candidates Button -->
        <div class="mt-3 mb-3">
            <form id="deleteAllCandidatesForm" action="{{ route('usermanage.deleteAllCandidates') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllCandidatesModal">
                    Clear all Canditates Data
                </button>
            </form>
        </div>

        <!-- Candidates Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Candidate Image</th>
                    <th>Candidate Number</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Waist (inch)</th>
                    <th>Hips (inch)</th>
                    <th>Chest (inch)</th>
                    <th>Action</th> <!-- Assuming you want to keep the action column -->
                </tr>
            </thead>
            <tbody>
                <!-- Replace the code below with your user data retrieval and display logic -->
                <!-- Example loop for displaying candidate data -->
                @foreach($candidates as $candidate)
                <tr>
                    <td><a href="#" class="candidate-image-link" data-bs-toggle="modal" data-bs-target="#imageModal"><img src="{{ asset($candidate->candidateImage) }}" alt="Candidate Image" class="candidate-image"></a></td>
                    <td>{{ $candidate->candidateNumber }}</td>
                    <td>{{ $candidate->candidateName }}</td>
                    <td>{{ $candidate->age }}</td>
                    <td>{{ $candidate->candidateAddress }}</td>
                    <td>{{ $candidate->waist }}</td>
                    <td>{{ $candidate->hips }}</td>
                    <td>{{ $candidate->chest }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal{{ $candidate->id }}">Edit</button>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $candidate->id }}">Delete</button>
                    </td>
                </tr>
                <!-- Edit Candidate Modal -->
                <div class="modal fade" id="editModal{{ $candidate->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $candidate->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $candidate->id }}">Edit Candidate</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Candidate Edit Form -->
                                <form id="editCandidateForm{{ $candidate->id }}" method="POST" action="{{ route('candidate.update', $candidate->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Candidate Number -->
                                    <div class="form-group">
                                        <label for="candidateNumber">Candidate Number</label>
                                        <input type="text" class="form-control" name="candidateNumber" value="{{ $candidate->candidateNumber }}" required>
                                    </div>
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="candidateName">Name</label>
                                        <input type="text" class="form-control" name="candidateName" value="{{ $candidate->candidateName }}" required>
                                    </div>
                                    <!-- Age -->
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control" name="age" value="{{ $candidate->age }}" required>
                                    </div>
                                    <!-- Address -->
                                    <div class="form-group">
                                        <label for="candidateAddress">Address</label>
                                        <input type="text" class="form-control" name="candidateAddress" value="{{ $candidate->candidateAddress }}" required>
                                    </div>
                                    <!-- Waist -->
                                    <div class="form-group">
                                        <label for="waist">Waist</label>
                                        <input type="number" class="form-control" name="waist" value="{{ $candidate->waist }}" required>
                                    </div>
                                    <!-- Hips -->
                                    <div class="form-group">
                                        <label for="hips">Hips</label>
                                        <input type="number" class="form-control" name="hips" value="{{ $candidate->hips }}" required>
                                    </div>
                                    <!-- Chest -->
                                    <div class="form-group">
                                        <label for="chest">Chest</label>
                                        <input type="number" class="form-control" name="chest" value="{{ $candidate->chest }}" required>
                                    </div>
                                    <!-- Image Upload -->
                                    <div class="form-group">
                                        <label for="candidateImage">Upload Image</label>
                                        <input type="file" class="form-control" name="candidateImage" accept="image/*">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" form="editCandidateForm{{ $candidate->id }}" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete Account Modal for this Candidate -->
                <div class="modal fade" id="deleteModal{{ $candidate->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the candidate {{ $candidate->candidateName }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('candidate.delete', $candidate->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <!-- Delete All Candidates Modal -->
        <div class="modal fade" id="deleteAllCandidatesModal" tabindex="-1" aria-labelledby="deleteAllCandidatesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllCandidatesModalLabel">Clear Candidates Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete all candidates data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteAllCandidatesConfirmForm" action="{{ route('usermanage.deleteAllCandidates') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete All</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Candidate Modal -->
        <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCandidateModalLabel">Add Candidate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="candidateFormsContainer">
                        <!-- Candidate Form -->
                        <form id="addCandidateForm" method="POST" action="{{ route('candidate.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Candidate Number -->
                            <div class="form-group">
                                <label for="candidateNumber">Candidate Number</label>
                                <input type="text" class="form-control" name="candidateNumber" required>
                            </div>
                            <!-- Name -->
                            <div class="form-group">
                                <label for="candidateName">Name</label>
                                <input type="text" class="form-control" name="candidateName" required>
                            </div>
                            <!-- Age -->
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" name="age" required>
                            </div>
                            <!-- Address -->
                            <div class="form-group">
                                <label for="candidateAddress">Address</label>
                                <input type="text" class="form-control" name="candidateAddress" required>
                            </div>
                            <!-- Waist -->
                            <div class="form-group">
                                <label for="waist">Waist</label>
                                <input type="number" class="form-control" name="waist" required>
                            </div>
                            <!-- Hips -->
                            <div class="form-group">
                                <label for="hips">Hips</label>
                                <input type="number" class="form-control" name="hips" required>
                            </div>
                            <!-- Chest -->
                            <div class="form-group">
                                <label for="chest">Chest</label>
                                <input type="number" class="form-control" name="chest" required>
                            </div>
                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="candidateImage">Upload Image</label>
                                <input type="file" class="form-control" name="candidateImage" accept="image/*" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Candidate</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Candidate Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" alt="Candidate Image" id="modalImage" style="max-width: 100%; max-height: 80vh;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.querySelectorAll('.candidate-image-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const imageSrc = this.querySelector('img').getAttribute('src');
            const modalImage = document.getElementById('modalImage');
            modalImage.setAttribute('src', imageSrc);
        });
    });
</script>

</body>
</html>
