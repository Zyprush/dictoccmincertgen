const myChart = document.querySelector(".my-chart");

// Fetch data from the server using AJAX
const xhr = new XMLHttpRequest();
xhr.open("GET", "../config/fetch-assessment-data.php", true);
xhr.onreadystatechange = function () {
  if (xhr.readyState === 4 && xhr.status === 200) {
    const response = JSON.parse(xhr.responseText);
    const averages = response.averages;
    const numOfRespondents = averages.length;

    console.log(averages);

    // Calculate the count of respondents for each average
    const averageCounts = {};
    averages.forEach((average) => {
      averageCounts[average] = (averageCounts[average] || 0) + 1;
    });

    const chartData = {
      labels: Object.keys(averageCounts),
      data: Object.values(averageCounts),
      colors: [], // Empty array for colors, to be filled based on averages
      legends: [
        "Poor",
        "Fair",
        "Satisfactory",
        "Very Satisfactory",
        "Excellent",
      ],
    };

    // Update the data and background colors based on the fetched data
    chartData.colors = chartData.labels.map((average) => {
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

    new Chart(myChart, {
      type: "doughnut",
      data: {
        labels: chartData.labels,
        datasets: [
          {
            label: "Language Relevance",
            data: chartData.data,
            backgroundColor: chartData.colors,
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
                var label = chartData.labels[context.dataIndex];
                var value = chartData.data[context.dataIndex];
                var legend = chartData.legends[label - 1];
                var percentage = ((value / numOfRespondents) * 100).toFixed(2);
                return `${percentage}% (${legend})`;
              },
            },
          },
        },
      },
    });
  }
};
xhr.send();
