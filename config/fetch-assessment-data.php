<?php
// Include the db connection file
require_once 'dbconfig.php';

if (isset($_GET['id'])) {
    $webinar_id = $_GET['id'];

    // Fetch data from the assessments table for the specified webinar_id
    $query = "SELECT * FROM assessments WHERE webinar_id = '$webinar_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the case when the query fails
        $response = array(
            'error' => 'Failed to fetch assessment data'
        );
        echo json_encode($response);
        exit; // Stop the script execution
    }

    $relevantData = array(); // Array to store relevant question averages
    $informationData = array(); // Array to store information/skills question averages
    $instructionalDesignData = array(); // Array to store instructional design question averages
    $classInteractionData = array(); // Array to store class interaction question averages
    $staffSensitivityData = array(); // Array to store staff sensitivity question averages
    $overallRatingData = array(); // Array to store overall rating question averages

    while ($row = mysqli_fetch_assoc($result)) {
        $relevantAverage = ($row['question1'] + $row['question2'] + $row['question3']) / 3;
        $relevantData[] = $relevantAverage;

        $informationAverage = ($row['question4'] + $row['question5'] + $row['question6'] + $row['question7']) / 4;
        $informationData[] = $informationAverage;
        
        $instructionalDesignAverage = ($row['question8'] + $row['question9'] + $row['question10']) / 3;
        $instructionalDesignData[] = $instructionalDesignAverage;
        
        $classInteractionAverage = ($row['question14'] + $row['question15'] + $row['question16']) / 3;
        $classInteractionData[] = $classInteractionAverage;
        
        $staffSensitivityAverage = $row['question17'];
        $staffSensitivityData[] = $staffSensitivityAverage;
        
        $overallRatingAverage = $row['question18'];
        $overallRatingData[] = $overallRatingAverage;
    }

    // Calculate the overall average relevance, information/skills average, instructional design average,
    // class interaction average, staff sensitivity average, and overall rating average
    $relevantOverallAverage = count($relevantData) > 0 ? array_sum($relevantData) / count($relevantData) : 0;
    $informationOverallAverage = count($informationData) > 0 ? array_sum($informationData) / count($informationData) : 0;
    $instructionalDesignOverallAverage = count($instructionalDesignData) > 0 ? array_sum($instructionalDesignData) / count($instructionalDesignData) : 0;
    $classInteractionOverallAverage = count($classInteractionData) > 0 ? array_sum($classInteractionData) / count($classInteractionData) : 0;
    $staffSensitivityOverallAverage = count($staffSensitivityData) > 0 ? array_sum($staffSensitivityData) / count($staffSensitivityData) : 0;
    $overallRatingOverallAverage = count($overallRatingData) > 0 ? array_sum($overallRatingData) / count($overallRatingData) : 0;

    // Prepare the response data
    $response = array(
        'relevantAverages' => $relevantData,
        'relevantOverallAverage' => $relevantOverallAverage,
        'informationAverages' => $informationData,
        'informationOverallAverage' => $informationOverallAverage,
        'instructionalDesignAverages' => $instructionalDesignData,
        'instructionalDesignOverallAverage' => $instructionalDesignOverallAverage,
        'classInteractionAverages' => $classInteractionData,
        'classInteractionOverallAverage' => $classInteractionOverallAverage,
        'staffSensitivityAverages' => $staffSensitivityData,
        'staffSensitivityOverallAverage' => $staffSensitivityOverallAverage,
        'overallRatingAverages' => $overallRatingData,
        'overallRatingOverallAverage' => $overallRatingOverallAverage,
        'webinar_id' => $webinar_id
    );

    // Return the response as JSON
    echo json_encode($response);
} else {
    // Handle the case when the 'id' parameter is not provided in the URL
    $response = array(
        'error' => 'No webinar ID provided'
    );
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
