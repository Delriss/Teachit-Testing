<?php

//we need to retrieve the test results from the userTests table in the database. This should be done based on the SID.

//include the database connection
include($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//we should have a class of some sort that will retrieve the data from the database. this must use $db_connect which is the connection to the database, this has been included in the _connect.php file
//upon construction, six arrays should be created, one for each subject. Each array should contain the top 5 scores for that subject. The arrays should be sorted in descending order.
//the arrays should be called $computing, $botany, $economics, $creativeArts, $business, $development

//create the class
class LeaderboardData{
    //create the arrays
    public $computing = array();
    public $botany = array();
    public $economics = array();
    public $creativeArts = array();
    public $business = array();
    public $development = array();

    //create the constructor
    public function __construct($db_connect){
        //create the query
        $query = "SELECT * FROM userTests";
        //run the query
        $result = mysqli_query($db_connect, $query);
        //check if the query was successful
        if($result){
            //loop through the results
            while($row = mysqli_fetch_assoc($result)){
                //check the subject
                switch($row['SID']){
                    case "1":
                        //does this user already exist in the array using array search
                        $userExists = array_search($row['UID'], array_column($this->computing, 'userID'));
                        //if the user exists
                        if($userExists !== false){
                            //we should add the score to the existing user
                            $this->computing[$userExists]['score'] += $row['score'];
                        }
                        else{
                            //we need to hit the users table with the row UID to get the user's first and last name.
                            //we should append the last name to the first name and add it to the array
                            $userQuery = "SELECT * FROM users WHERE ID = " . $row['UID'];
                            $userResult = mysqli_query($db_connect, $userQuery);
                            $userRow = mysqli_fetch_assoc($userResult);
                            $this->computing[] = array("userID" => $row['UID'], "score" => $row['score'], "name" => $userRow['firstName'] . " " . $userRow['lastName']);
                        }
                        break;
                    case "2":
                        //does this user already exist in the array using array search
                        $userExists = array_search($row['UID'], array_column($this->botany, 'userID'));
                        //if the user exists
                        if($userExists !== false){
                            //we should add the score to the existing user
                            $this->botany[$userExists]['score'] += $row['score'];
                        }
                        else{
                            //the user doesn't exist in the array, add the score to the array
                            $this->botany[] = array("userID" => $row['UID'], "score" => $row['score']);
                        }
                        break;
                    case "3":
                        //does this user already exist in the array using array search
                        $userExists = array_search($row['UID'], array_column($this->economics, 'userID'));
                        //if the user exists
                        if($userExists !== false){
                            //we should add the score to the existing user
                            $this->economics[$userExists]['score'] += $row['score'];
                        }
                        else{
                            //the user doesn't exist in the array, add the score to the array
                            $this->economics[] = array("userID" => $row['UID'], "score" => $row['score']);
                        }
                        break;
                    case "4":
                        //does this user already exist in the array using array search
                        $userExists = array_search($row['UID'], array_column($this->creativeArts, 'userID'));
                        //if the user exists
                        if($userExists !== false){
                            //we should add the score to the existing user
                            $this->creativeArts[$userExists]['score'] += $row['score'];
                        }
                        else{
                            //the user doesn't exist in the array, add the score to the array
                            $this->creativeArts[] = array("userID" => $row['UID'], "score" => $row['score']);
                        }
                        break;
                    case "5":
                        //does this user already exist in the array using array search
                        $userExists = array_search($row['UID'], array_column($this->business, 'userID'));
                        //if the user exists
                        if($userExists !== false){
                            //we should add the score to the existing user
                            $this->business[$userExists]['score'] += $row['score'];
                        }
                        else{
                            //the user doesn't exist in the array, add the score to the array
                            $this->business[] = array("userID" => $row['UID'], "score" => $row['score']);
                        }
                        break;
                    case "6":
                        //does this user already exist in the array using array search
                        $userExists = array_search($row['UID'], array_column($this->development, 'userID'));
                        //if the user exists
                        if($userExists !== false){
                            //we should add the score to the existing user
                            $this->development[$userExists]['score'] += $row['score'];
                        }
                        else{
                            //the user doesn't exist in the array, add the score to the array
                            $this->development[] = array("userID" => $row['UID'], "score" => $row['score']);
                        }
                        break;
                }
            }
        }
        //sort the arrays in descending order so that the highest scores are at the top.
        usort($this->computing, function($a, $b){
            return $b['score'] <=> $a['score'];
        });
        usort($this->botany, function($a, $b){
            return $b['score'] <=> $a['score'];
        });
        usort($this->economics, function($a, $b){
            return $b['score'] <=> $a['score'];
        });
        usort($this->creativeArts, function($a, $b){
            return $b['score'] <=> $a['score'];
        });
        usort($this->business, function($a, $b){
            return $b['score'] <=> $a['score'];
        });
        usort($this->development, function($a, $b){
            return $b['score'] <=> $a['score'];
        });

        //we should only keep the top 5 scores in each array, cut the rest off.
        $this->computing = array_slice($this->computing, 0, 5);
        $this->botany = array_slice($this->botany, 0, 5);
        $this->economics = array_slice($this->economics, 0, 5);
        $this->creativeArts = array_slice($this->creativeArts, 0, 5);
        $this->business = array_slice($this->business, 0, 5);
        $this->development = array_slice($this->development, 0, 5);
    }
}

//create an instance of the class
$leaderboardData = new LeaderboardData($db_connect);

//close the connection
mysqli_close($db_connect);

//we should now have the data in the arrays, we can now display the data in the leaderboard table.
//this is done in the outputLeaderboard.php file
?>






