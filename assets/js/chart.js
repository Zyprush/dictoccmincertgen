const relevantChart = document.querySelector("#relevantChart");
const informationChart = document.querySelector("#informationChart");
const instructionalDesignChart = document.querySelector("#instructionalDesignChart");
const classInteractionChart = document.querySelector("#classInteractionChart");
const staffSensitivityChart = document.querySelector("#staffSensitivityChart");
const overallRatingChart = document.querySelector("#overallRatingChart");
const urlParams = new URLSearchParams(window.location.search);
const webinarId = urlParams.get('id');

const fetchData = async () => {
  try {
    const response = await fetch(`../config/fetch-assessment-data.php?id=${webinarId}`);
    const data = await response.json();
    const relevantAverages = data.relevantAverages;
    const informationAverages = data.informationAverages;
    const instructionalDesignAverages = data.instructionalDesignAverages;
    const classInteractionAverages = data.classInteractionAverages;
    const staffSensitivityAverages = data.staffSensitivityAverages;
    const overallRatingAverages = data.overallRatingAverages;
    const numOfRespondents = relevantAverages.length;

    const relevantAverageCounts = {};
    relevantAverages.forEach((average) => {
      relevantAverageCounts[average] = (relevantAverageCounts[average] || 0) + 1;
    });

    const relevantChartData = {
      labels: Object.keys(relevantAverageCounts),
      data: Object.values(relevantAverageCounts),
      colors: [],
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    relevantChartData.colors = relevantChartData.labels.map((average) => {
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

    new Chart(relevantChart, {
      type: "doughnut",
      data: {
        labels: relevantChartData.labels,
        datasets: [
          {
            label: "Relevance of the Training",
            data: relevantChartData.data,
            backgroundColor: relevantChartData.colors,
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
                var label = relevantChartData.labels[context.dataIndex];
                var value = relevantChartData.data[context.dataIndex];
                var legend = relevantChartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });

    const informationAverageCounts = {};
    informationAverages.forEach((average) => {
      informationAverageCounts[average] = (informationAverageCounts[average] || 0) + 1;
    });

    const informationChartData = {
      labels: Object.keys(informationAverageCounts),
      data: Object.values(informationAverageCounts),
      colors: [],
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    informationChartData.colors = informationChartData.labels.map((average) => {
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

    new Chart(informationChart, {
      type: "doughnut",
      data: {
        labels: informationChartData.labels,
        datasets: [
          {
            label: "Information / Skills Acquired",
            data: informationChartData.data,
            backgroundColor: informationChartData.colors,
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
                var label = informationChartData.labels[context.dataIndex];
                var value = informationChartData.data[context.dataIndex];
                var legend = informationChartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });

    const instructionalDesignAverageCounts = {};
    instructionalDesignAverages.forEach((average) => {
      instructionalDesignAverageCounts[average] = (instructionalDesignAverageCounts[average] || 0) + 1;
    });

    const instructionalDesignChartData = {
      labels: Object.keys(instructionalDesignAverageCounts),
      data: Object.values(instructionalDesignAverageCounts),
      colors: [],
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    instructionalDesignChartData.colors = instructionalDesignChartData.labels.map(
      (average) => {
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
      }
    );

    new Chart(instructionalDesignChart, {
      type: "doughnut",
      data: {
        labels: instructionalDesignChartData.labels,
        datasets: [
          {
            label: "Instructional Design",
            data: instructionalDesignChartData.data,
            backgroundColor: instructionalDesignChartData.colors,
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
                var label = instructionalDesignChartData.labels[context.dataIndex];
                var value = instructionalDesignChartData.data[context.dataIndex];
                var legend = instructionalDesignChartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });

    const classInteractionAverageCounts = {};
    classInteractionAverages.forEach((average) => {
      classInteractionAverageCounts[average] = (classInteractionAverageCounts[average] || 0) + 1;
    });

    const classInteractionChartData = {
      labels: Object.keys(classInteractionAverageCounts),
      data: Object.values(classInteractionAverageCounts),
      colors: [],
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    classInteractionChartData.colors = classInteractionChartData.labels.map(
      (average) => {
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
      }
    );

    new Chart(classInteractionChart, {
      type: "doughnut",
      data: {
        labels: classInteractionChartData.labels,
        datasets: [
          {
            label: "Class Interaction",
            data: classInteractionChartData.data,
            backgroundColor: classInteractionChartData.colors,
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
                var label = classInteractionChartData.labels[context.dataIndex];
                var value = classInteractionChartData.data[context.dataIndex];
                var legend = classInteractionChartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });

    const staffSensitivityAverageCounts = {};
    staffSensitivityAverages.forEach((average) => {
      staffSensitivityAverageCounts[average] = (staffSensitivityAverageCounts[average] || 0) + 1;
    });

    const staffSensitivityChartData = {
      labels: Object.keys(staffSensitivityAverageCounts),
      data: Object.values(staffSensitivityAverageCounts),
      colors: [],
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    staffSensitivityChartData.colors = staffSensitivityChartData.labels.map(
      (average) => {
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
      }
    );

    new Chart(staffSensitivityChart, {
      type: "doughnut",
      data: {
        labels: staffSensitivityChartData.labels,
        datasets: [
          {
            label: "Staff Sensitivity",
            data: staffSensitivityChartData.data,
            backgroundColor: staffSensitivityChartData.colors,
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
                var label = staffSensitivityChartData.labels[context.dataIndex];
                var value = staffSensitivityChartData.data[context.dataIndex];
                var legend = staffSensitivityChartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });

    const overallRatingAverageCounts = {};
    overallRatingAverages.forEach((average) => {
      overallRatingAverageCounts[average] = (overallRatingAverageCounts[average] || 0) + 1;
    });

    const overallRatingChartData = {
      labels: Object.keys(overallRatingAverageCounts),
      data: Object.values(overallRatingAverageCounts),
      colors: [],
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    overallRatingChartData.colors = overallRatingChartData.labels.map(
      (average) => {
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
      }
    );

    new Chart(overallRatingChart, {
      type: "doughnut",
      data: {
        labels: overallRatingChartData.labels,
        datasets: [
          {
            label: "Overall Rating",
            data: overallRatingChartData.data,
            backgroundColor: overallRatingChartData.colors,
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
                var label = overallRatingChartData.labels[context.dataIndex];
                var value = overallRatingChartData.data[context.dataIndex];
                var legend = overallRatingChartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });
  } catch (error) {
    console.log(error);
  }
};

fetchData();