
    //menutoggle
    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector(".navigation");
    let main = document.querySelector(".main");
    toggle.onclick = function() {
        navigation.classList.toggle("active");
        main.classList.toggle("active");
    };

    //add hovered class
    let list = document.querySelectorAll(".navigation li");

    function activelink() {
        list.forEach((item) => item.classList.remove("hovered"));
        this.classList.add("hovered");
    }
    list.forEach((item) => item.addEventListener("mouseover", activelink));

    //for profile dropdown
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
        subMenu.classList.toggle("open-menu");
        console.log("hello");
    }
    
    //for notification
    let subMenu2 = document.getElementById("notifiWrap");

    function testnoti() {
        subMenu2.classList.toggle("open-noti");
        console.log("hello1");
    }
    
    //charts
    var ctx = document.getElementById('lineChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                    label: "PMS",
                    // data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],
                    data: [20, 19, 11, 7, 8],
                    backgroundColor: [
                        'rgb(41,155,99)'
                    ],
                    borderColor: 'rgb(41, 155, 99)',
                    borderWidth: 3
                },
                {
                    label: "E-Commerce",
                    // data: [2050, 1700, 2200, 2800, 1800, 2000, 2500, 2600, 2450, 1950, 2300, 2900],
                    data: [10, 17, 12, 18, 8],
                    backgroundColor: [
                        'grey'
                    ],
                    borderColor: 'grey',
                    borderWidth: 3
                },
                {
                    label: "ParaFashion",
                    // data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],
                    data: [18, 10, 12, 14, 2],
                    backgroundColor: [
                        'pink'
                    ],
                    borderColor: 'pink',
                    borderWidth: 3
                },
                {
                    label: "SabKoBazar",
                    // data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],
                    data: [10, 19, 2, 17, 8],
                    backgroundColor: [
                        'blue'
                    ],
                    borderColor: 'blue',
                    borderWidth: 3
                },
                {
                    label: "CMS",
                    // data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],
                    data: [10, 19, 2, 13, 14],
                    backgroundColor: [
                        'red'
                    ],
                    borderColor: 'red',
                    borderWidth: 3
                },
            ]
        },
        options: {
            responsive: true
        }
    });
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Suggested Min and Max Settings'
                }
            },
            scales: {
                y: {
                    // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
                    suggestedMin: 30,

                    // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
                    suggestedMax: 50,
                }
            }
        },
    };
    // </block:config>

    module.exports = {
        config: config,
    };
    
    //for project
    var ctx2 = document.getElementById('doughnut').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Pending Projects', 'Completed Projects'],
            datasets: [{
                label: 'Employees',
                data: [10, 2],
                backgroundColor: [
                    'purple',
                    '#F76C6C'

                ],
                borderColor: [
                    'white'

                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: true
        }
    });
    
    //for task
    var ctx2 = document.getElementById('doughnut2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Pending Task', 'Completed Task'],
            datasets: [{
                label: 'Employees',
                data: [10, 2],
                backgroundColor: [
                    'lightblue',
                    '#F76C6C'

                ],
                borderColor: [
                    'white'

                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true
        }
    });
    
    //for meetings
    var ctx2 = document.getElementById('doughnut3').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Pending Meetings', 'Completed Meetings'],
            datasets: [{
                label: 'Employees',
                data: [8, 2],
                backgroundColor: [
                    '#7f3667',
                    '#746AB0'

                ],
                borderColor: [
                    'white'

                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: true
        }
    });