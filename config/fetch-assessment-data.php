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
    $masteryData = array(); // Array to store mastery question averages
    $methodologyData = array(); // Array to store methodology question averages
    $communicationsData = array(); // Array to store communications question averages
    $classManagementData = array(); // Array to store class management question averages
    $qualitiesData = array(); // Array to store personal qualities question averages

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

        $masteryAverage = ($row['question19'] + $row['question20'] + $row['question21'] + $row['question22']) / 4;
        $masteryData[] = $masteryAverage;

        $methodologyAverage = ($row['question23'] + $row['question24'] + $row['question25'] + $row['question26'] + $row['question27']) / 5;
        $methodologyData[] = $methodologyAverage;

        $communicationsAverage = ($row['question28'] + $row['question29']) / 2;
        $communicationsData[] = $communicationsAverage;

        $classManagementAverage = ($row['question30'] + $row['question31'] + $row['question32'] + $row['question33']) / 4;
        $classManagementData[] = $classManagementAverage;

        $qualitiesAverage = ($row['question34'] + $row['question35'] + $row['question36'] + $row['question37']) / 4;
        $qualitiesData[] = $qualitiesAverage;
    }

    // Calculate the overall average relevance, information/skills average, instructional design average,
    // class interaction average, staff sensitivity average, and overall rating average
    $relevantOverallAverage = count($relevantData) > 0 ? array_sum($relevantData) / count($relevantData) : 0;
    $informationOverallAverage = count($informationData) > 0 ? array_sum($informationData) / count($informationData) : 0;
    $instructionalDesignOverallAverage = count($instructionalDesignData) > 0 ? array_sum($instructionalDesignData) / count($instructionalDesignData) : 0;
    $classInteractionOverallAverage = count($classInteractionData) > 0 ? array_sum($classInteractionData) / count($classInteractionData) : 0;
    $staffSensitivityOverallAverage = count($staffSensitivityData) > 0 ? array_sum($staffSensitivityData) / count($staffSensitivityData) : 0;
    $overallRatingOverallAverage = count($overallRatingData) > 0 ? array_sum($overallRatingData) / count($overallRatingData) : 0;
    $masteryAverage = count($masteryData) > 0 ? array_sum($masteryData) / count($masteryData) : 0;
    $methodologyAverage = count($methodologyData) > 0 ? array_sum($methodologyData) / count($methodologyData) : 0;
    $communicationsAverage = count($communicationsData) > 0 ? array_sum($communicationsData) / count($communicationsData) : 0;
    $classManagementAverage = count($classManagementData) > 0 ? array_sum($classManagementData) / count($classManagementData) : 0;
    $qualitiesAverage = count($qualitiesData) > 0 ? array_sum($qualitiesData) / count($qualitiesData) : 0;

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
        'masteryAverages' => $masteryData,
        'masteryOverallAverage' => $masteryAverage,
        'methodologyAverages' => $methodologyData,
        'methodologyOverallAverage' => $methodologyAverage,
        'communicationsAverages' => $communicationsData,
        'communicationsOverallAverage' => $communicationsAverage,
        'classManagementAverages' => $classManagementData,
        'classManagementOverallAverage' => $classManagementAverage,
        'qualitiesAverages' => $qualitiesData,
        'qualitiesOverallAverage' => $qualitiesAverage,
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
