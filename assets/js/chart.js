const chartData = {
  labels: ["Python", "Java", "JavaScript", "C#", "Others"],
  data: [30, 17, 10, 7, 36],
  colors: ["#ff0000", "#ff6600", "#ffcc00", "#99ff33", "#00cc00"], // Colors for rating scale 1-5
  legends: [
    "Poor / Needs Improvement",
    "Fair",
    "Satisfactory",
    "Very Satisfactory",
    "Excellent",
  ],
};

const myChart = document.querySelector(".my-chart");
const ul = document.querySelector(".programming-stats .details ul");

new Chart(myChart, {
  type: "doughnut",
  data: {
    labels: chartData.labels,
    datasets: [
      {
        label: "Language Relevance",
        data: chartData.data,
        backgroundColor: chartData.colors, // Use colors array for background colors
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
    },
  },
});

const populateUl = () => {
  chartData.labels.forEach((l, i) => {
    let li = document.createElement("li");
    li.innerHTML = `${l}: <span class='percentage ${getColorClass(chartData.data[i])}'>${chartData.data[i]}%</span> <span class='legend'>${chartData.legends[i]}</span>`;
    ul.appendChild(li);
  });
};

const getColorClass = (value) => {
  if (value >= 1 && value <= 20) {
    return "color-1";
  } else if (value > 20 && value <= 40) {
    return "color-2";
  } else if (value > 40 && value <= 60) {
    return "color-3";
  } else if (value > 60 && value <= 80) {
    return "color-4";
  } else {
    return "color-5";
  }
};

populateUl();
