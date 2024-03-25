<?php 
//include the header
$activatedPage = "Leaderboard";
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');

//retrieve the leaderboard data
include($_SERVER['DOCUMENT_ROOT'] . '/php/retrieveLeaderboardData.php');
?>

<body class="d-flex flex-column h-100">

    <div class="w-75 mx-auto mt-5 mb-5" id="leaderboardContainer">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="computing-tab" data-bs-toggle="tab" data-bs-target="#computing" type="button" role="tab" aria-controls="computing" aria-selected="true">Computing</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="botany-tab" data-bs-toggle="tab" data-bs-target="#botany" type="button" role="tab" aria-controls="botany" aria-selected="false">Botany</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="economics-tab" data-bs-toggle="tab" data-bs-target="#economics" type="button" role="tab" aria-controls="economics" aria-selected="false">Economics</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="creativeArts-tab" data-bs-toggle="tab" data-bs-target="#creativeArts" type="button" role="tab" aria-controls="creativeArts" aria-selected="false">Creative Arts</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="business-tab" data-bs-toggle="tab" data-bs-target="#business" type="button" role="tab" aria-controls="business" aria-selected="false">Business</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="development-tab" data-bs-toggle="tab" data-bs-target="#development" type="button" role="tab" aria-controls="development" aria-selected="false">Development</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="computing" role="tabpanel" aria-labelledby="computing-tab">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover leaderboard-table mt-3">
                            <thead class="leaderboardHead">
                                <tr>
                                    <th>Rank</th>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //if the leaderboardData object exists but the computing array is empty, we should display a message to the user that no users have taken the test yet
                                if(empty($leaderboardData->computing)){
                                    echo "<tr><td colspan='4'>No users have taken the test yet</td></tr>";
                                }
                                else{ 
                                    //within the leaderboardData object, we should have the arrays for each subject. We should loop through the computing array and display the top 5 scores
                                    for($i = 0; $i < 5; $i++){
                                        //check if the array key exists
                                        if(array_key_exists($i, $leaderboardData->computing)){
                                            //retrieve the user data
                                            $user = $leaderboardData->computing[$i];
                                            echo "<tr class='leaderboardRow fs-3'>";
                                            echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>" . $user['name'] . "</td>";
                                            echo "<td>";
                                            echo $user['score'];
                                            echo "</td>";
                                            echo "<td>";
                                            // Calculate the progress percentage against the highest score
                                            $progress = ($user['score'] / $leaderboardData->computing[0]['score']) * 100;
                                            //if the progress is less than 5%, we should display the progress bar at 5% so that it is visible
                                            if($progress < 5){
                                                $progress = 5;
                                            }
                                            echo "<div class='progress'><div id='score-progress' class='progress-bar leaderboardProgress' role='progressbar' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'></div></div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        else if(!array_key_exists($i, $leaderboardData->computing)){
                                            //if we have less than 5 users, we should break out of the loop as we have displayed all the users
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="botany" role="tabpanel" aria-labelledby="botany-tab">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover leaderboard-table mt-3">
                            <thead class="leaderboardHead">
                                <tr>
                                    <th>Rank</th>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //if the leaderboardData object exists but the botany array is empty, we should display a message to the user that no users have taken the test yet
                                if(empty($leaderboardData->botany)){
                                    echo "<tr><td colspan='4'>No users have taken the test yet</td></tr>";
                                }
                                else{ 
                                    //within the leaderboardData object, we should have the arrays for each subject. We should loop through the botany array and display the top 5 scores
                                    for($i = 0; $i < 5; $i++){
                                        //check if the array key exists
                                        if(array_key_exists($i, $leaderboardData->botany)){
                                            //retrieve the user data
                                            $user = $leaderboardData->botany[$i];
                                            echo "<tr class='leaderboardRow fs-3'>";
                                            echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>" . $user['name'] . "</td>";
                                            echo "<td>";
                                            echo $user['score'];
                                            echo "</td>";
                                            echo "<td>";
                                            // Calculate the progress percentage against the highest score
                                            $progress = ($user['score'] / $leaderboardData->botany[0]['score']) * 100;
                                            //if the progress is less than 5%, we should display the progress bar at 5% so that it is visible
                                            if($progress < 5){
                                                $progress = 5;
                                            }
                                            echo "<div class='progress'><div id='score-progress' class='progress-bar leaderboardProgress' role='progressbar' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'></div></div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        else if(!array_key_exists($i, $leaderboardData->botany)){
                                            //if we have less than 5 users, we should break out of the loop as we have displayed all the users
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="economics" role="tabpanel" aria-labelledby="economics-tab">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover leaderboard-table mt-3">
                            <thead class="leaderboardHead">
                                <tr>
                                    <th>Rank</th>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //if the leaderboardData object exists but the economics array is empty, we should display a message to the user that no users have taken the test yet
                                if(empty($leaderboardData->economics)){
                                    echo "<tr><td colspan='4'>No users have taken the test yet</td></tr>";
                                }
                                else{ 
                                    //within the leaderboardData object, we should have the arrays for each subject. We should loop through the economics array and display the top 5 scores
                                    for($i = 0; $i < 5; $i++){
                                        //check if the array key exists
                                        if(array_key_exists($i, $leaderboardData->economics)){
                                            //retrieve the user data
                                            $user = $leaderboardData->economics[$i];
                                            echo "<tr class='leaderboardRow fs-3'>";
                                            echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>" . $user['name'] . "</td>";
                                            echo "<td>";
                                            echo $user['score'];
                                            echo "</td>";
                                            echo "<td>";
                                            // Calculate the progress percentage against the highest score
                                            $progress = ($user['score'] / $leaderboardData->economics[0]['score']) * 100;
                                            //if the progress is less than 5%, we should display the progress bar at 5% so that it is visible
                                            if($progress < 5){
                                                $progress = 5;
                                            }
                                            echo "<div class='progress'><div id='score-progress' class='progress-bar leaderboardProgress' role='progressbar' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'></div></div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        else if(!array_key_exists($i, $leaderboardData->economics)){
                                            //if we have less than 5 users, we should break out of the loop as we have displayed all the users
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="creativeArts" role="tabpanel" aria-labelledby="creativeArts-tab">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover leaderboard-table mt-3">
                            <thead class="leaderboardHead">
                                <tr>
                                    <th>Rank</th>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //if the leaderboardData object exists but the creativeArts array is empty, we should display a message to the user that no users have taken the test yet
                                if(empty($leaderboardData->creativeArts)){
                                    echo "<tr><td colspan='4'>No users have taken the test yet</td></tr>";
                                }
                                else{ 
                                    //within the leaderboardData object, we should have the arrays for each subject. We should loop through the creativeArts array and display the top 5 scores
                                    for($i = 0; $i < 5; $i++){
                                        //check if the array key exists
                                        if(array_key_exists($i, $leaderboardData->creativeArts)){
                                            //retrieve the user data
                                            $user = $leaderboardData->creativeArts[$i];
                                            echo "<tr class='leaderboardRow fs-3'>";
                                            echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>" . $user['name'] . "</td>";
                                            echo "<td>";
                                            echo $user['score'];
                                            echo "</td>";
                                            echo "<td>";
                                            // Calculate the progress percentage against the highest score
                                            $progress = ($user['score'] / $leaderboardData->creativeArts[0]['score']) * 100;
                                            //if the progress is less than 5%, we should display the progress bar at 5% so that it is visible
                                            if($progress < 5){
                                                $progress = 5;
                                            }
                                            echo "<div class='progress'><div id='score-progress' class='progress-bar leaderboardProgress' role='progressbar' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'></div></div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        else if(!array_key_exists($i, $leaderboardData->creativeArts)){
                                            //if we have less than 5 users, we should break out of the loop as we have displayed all the users
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover leaderboard-table mt-3">
                            <thead class="leaderboardHead">
                                <tr>
                                    <th>Rank</th>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //if the leaderboardData object exists but the business array is empty, we should display a message to the user that no users have taken the test yet
                                if(empty($leaderboardData->business)){
                                    echo "<tr><td colspan='4'>No users have taken the test yet</td></tr>";
                                }
                                else{ 
                                    //within the leaderboardData object, we should have the arrays for each subject. We should loop through the business array and display the top 5 scores
                                    for($i = 0; $i < 5; $i++){
                                        //check if the array key exists
                                        if(array_key_exists($i, $leaderboardData->business)){
                                            //retrieve the user data
                                            $user = $leaderboardData->business[$i];
                                            echo "<tr class='leaderboardRow fs-3'>";
                                            echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>" . $user['name'] . "</td>";
                                            echo "<td>";
                                            echo $user['score'];
                                            echo "</td>";
                                            echo "<td>";
                                            // Calculate the progress percentage against the highest score
                                            $progress = ($user['score'] / $leaderboardData->business[0]['score']) * 100;
                                            //if the progress is less than 5%, we should display the progress bar at 5% so that it is visible
                                            if($progress < 5){
                                                $progress = 5;
                                            }
                                            echo "<div class='progress'><div id='score-progress' class='progress-bar leaderboardProgress' role='progressbar' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'></div></div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        else if(!array_key_exists($i, $leaderboardData->business)){
                                            //if we have less than 5 users, we should break out of the loop as we have displayed all the users
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="development" role="tabpanel" aria-labelledby="development-tab">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover leaderboard-table mt-3">
                            <thead class="leaderboardHead">
                                <tr>
                                    <th>Rank</th>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //if the leaderboardData object exists but the development array is empty, we should display a message to the user that no users have taken the test yet
                                if(empty($leaderboardData->development)){
                                    echo "<tr><td colspan='4'>No users have taken the test yet</td></tr>";
                                }
                                else{ 
                                    //within the leaderboardData object, we should have the arrays for each subject. We should loop through the development array and display the top 5 scores
                                    for($i = 0; $i < 5; $i++){
                                        //check if the array key exists
                                        if(array_key_exists($i, $leaderboardData->development)){
                                            //retrieve the user data
                                            $user = $leaderboardData->development[$i];
                                            echo "<tr class='leaderboardRow fs-3'>";
                                            echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>" . $user['name'] . "</td>";
                                            echo "<td>";
                                            echo $user['score'];
                                            echo "</td>";
                                            echo "<td>";
                                            // Calculate the progress percentage against the highest score
                                            $progress = ($user['score'] / $leaderboardData->development[0]['score']) * 100;
                                            //if the progress is less than 5%, we should display the progress bar at 5% so that it is visible
                                            if($progress < 5){
                                                $progress = 5;
                                            }
                                            echo "<div class='progress'><div id='score-progress' class='progress-bar leaderboardProgress' role='progressbar' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'></div></div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        else if(!array_key_exists($i, $leaderboardData->development)){
                                            //if we have less than 5 users, we should break out of the loop as we have displayed all the users
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
//include the footer
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
?>
