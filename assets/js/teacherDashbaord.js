//for project
var ctx2 = document.getElementById("doughnut").getContext("2d");
var myChart2 = new Chart(ctx2, {
  type: "doughnut",
  data: {
    labels: ["Pending Projects", "Completed Projects"],
    datasets: [
      {
        label: "Employees",
        data: [10, 2],
        backgroundColor: ["purple", "#F76C6C"],
        borderColor: ["white"],
        borderWidth: 5,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
  },
});
