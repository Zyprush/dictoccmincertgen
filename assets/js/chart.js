const urlParams = new URLSearchParams(window.location.search);
const webinarId = urlParams.get('id');

const fetchData = async () => {
  try {
    const response = await fetch(`../config/fetch-assessment-data.php?id=${webinarId}`);
    const data = await response.json();
    const numOfRespondents = data.relevantAverages.length;

    const createChart = (chartElement, chartData, chartLabel) => {
      const averageCounts = {};
      chartData.forEach((average) => {
        averageCounts[average] = (averageCounts[average] || 0) + 1;
      });

      const chartColors = chartData.map((average) => {
        if (average >= 5) {
          return "#00cc00"; // Green for rating 5 (Excellent)
        } else if (average >= 4) {
          return "#99ff33"; // Yellow-green for rating 4 (Very Satisfactory)
        } else if (average >= 3) {
          return "#ffcc00"; // Yellow for rating 3 (Satisfactory)
        } else if (average >= 2) {
          return "#ff6600"; // Orange for rating 2 (Fair)
        } else {
          return "#ff0000"; // Red for rating 1 (Poor)
        }
      });

      new Chart(chartElement, {
        type: "doughnut",
        data: {
          labels: Object.keys(averageCounts),
          datasets: [
            {
              label: chartLabel,
              data: Object.values(averageCounts),
              backgroundColor: chartColors,
            },
          ],
        },
        options: {
          borderWidth: 10,
          borderRadius: 2,
          hoverBorderWidth: 0,
          plugins: {
            legend: {
              display: false,
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  var label = Object.keys(averageCounts)[context.dataIndex];
                  var value = Object.values(averageCounts)[context.dataIndex];
                  var legend = chartData.legends[label - 1];
                  var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                  return `${percentage}% (${legend})`;
                },
              },
            },
          },
        },
      });
    };

    const relevantChart = document.getElementById("relevantChart");
    const informationChart = document.getElementById("informationChart");
    const instructionalDesignChart = document.getElementById("instructionalDesignChart");
    const classInteractionChart = document.getElementById("classInteractionChart");
    const staffSensitivityChart = document.getElementById("staffSensitivityChart");
    const overallRatingChart = document.getElementById("overallRatingChart");
    const subjectMatterChart = document.getElementById("subjectMatterChart");
    const methodologyChart = document.getElementById("methodologyChart");
    const communicationSkillsChart = document.getElementById("communicationSkillsChart");
    const classroomManagementChart = document.getElementById("classroomManagementChart");
    const personalQualitiesChart = document.getElementById("personalQualitiesChart");

    createChart(relevantChart, data.relevantAverages, "Relevance of the Training");
    createChart(informationChart, data.informationAverages, "Information / Skills Acquired");
    createChart(instructionalDesignChart, data.instructionalDesignAverages, "Instructional Design");
    createChart(classInteractionChart, data.classInteractionAverages, "Class Interaction");
    createChart(staffSensitivityChart, data.staffSensitivityAverages, "Sensitivity and Assistance");
    createChart(overallRatingChart, data.overallRatingAverages, "Course General Evaluation");
    createChart(subjectMatterChart, data.masteryAverages, "Mastery of the Subject Matter");
    createChart(methodologyChart, data.methodologyAverages, "Instructional Methodology");
    createChart(communicationSkillsChart, data.communicationsAverages, "Communication Skills");
    createChart(classroomManagementChart, data.classManagementAverages, "Class / Classroom Management");
    createChart(personalQualitiesChart, data.qualitiesAverages, "Personal Qualities");
  } catch (error) {
    console.log(error);
  }
};

fetchData();
