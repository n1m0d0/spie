import Chart from "chart.js/auto";

var ctx = document.getElementById("goal");
if (ctx != null) {
    var goal = JSON.parse(ctx.getAttribute("goal"));
    var graphicGoal = new Chart(ctx, {
        type: "pie",
        data: {
            labels: goal.label,
            datasets: [
                {
                    label: "Metas",
                    data: goal.amount,
                    backgroundColor: [
                        "rgba(0, 0, 139, 0.2)",
                        "rgba(0, 139, 139, 0.2)",
                        "rgba(184, 134, 11, 0.2)",
                        "rgba(169, 169, 169, 0.2)",
                        "rgba(0, 100, 0, 0.2)",
                        "rgba(189, 183, 107, 0.2)",
                        "rgba(139, 0, 139, 0.2)",
                        "rgba(85, 107, 47, 0.2)",
                        "rgba(255, 140, 0, 0.2)",
                        "rgba(72, 61, 139, 0.2)",
                    ],
                    borderColor: [
                        "rgba(0, 0, 139, 1)",
                        "rgba(0, 139, 139, 1)",
                        "rgba(184, 134, 11, 1)",
                        "rgba(169, 169, 169, 1)",
                        "rgba(0, 100, 0, 1)",
                        "rgba(189, 183, 107, 1)",
                        "rgba(139, 0, 139, 1)",
                        "rgba(85, 107, 47, 1)",
                        "rgba(255, 140, 0, 1)",
                        "rgba(72, 61, 139, 1)",
                    ],
                    hoverOffset: 4,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Metas por Eje",
                },
            },
        },
    });
}

var ctx2 = document.getElementById("result");
if (ctx2 != null) {
    var result = JSON.parse(ctx2.getAttribute("result"));
    var graphicResult = new Chart(ctx2, {
        type: "pie",
        data: {
            labels: result.label,
            datasets: [
                {
                    label: "Resultados",
                    data: result.amount,
                    backgroundColor: [
                        "rgba(0, 0, 139, 0.2)",
                        "rgba(0, 139, 139, 0.2)",
                        "rgba(184, 134, 11, 0.2)",
                        "rgba(169, 169, 169, 0.2)",
                        "rgba(0, 100, 0, 0.2)",
                        "rgba(189, 183, 107, 0.2)",
                        "rgba(139, 0, 139, 0.2)",
                        "rgba(85, 107, 47, 0.2)",
                        "rgba(255, 140, 0, 0.2)",
                        "rgba(72, 61, 139, 0.2)",
                    ],
                    borderColor: [
                        "rgba(0, 0, 139, 1)",
                        "rgba(0, 139, 139, 1)",
                        "rgba(184, 134, 11, 1)",
                        "rgba(169, 169, 169, 1)",
                        "rgba(0, 100, 0, 1)",
                        "rgba(189, 183, 107, 1)",
                        "rgba(139, 0, 139, 1)",
                        "rgba(85, 107, 47, 1)",
                        "rgba(255, 140, 0, 1)",
                        "rgba(72, 61, 139, 1)",
                    ],
                    hoverOffset: 4,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Resultados por Eje",
                },
            },
        },
    });
}

var ctx3 = document.getElementById("action");
if (ctx3 != null) {
    var action = JSON.parse(ctx3.getAttribute("action"));
    var graphicAction = new Chart(ctx3, {
        type: "pie",
        data: {
            labels: action.label,
            datasets: [
                {
                    label: "Acciones",
                    data: action.amount,
                    backgroundColor: [
                        "rgba(0, 0, 139, 0.2)",
                        "rgba(0, 139, 139, 0.2)",
                        "rgba(184, 134, 11, 0.2)",
                        "rgba(169, 169, 169, 0.2)",
                        "rgba(0, 100, 0, 0.2)",
                        "rgba(189, 183, 107, 0.2)",
                        "rgba(139, 0, 139, 0.2)",
                        "rgba(85, 107, 47, 0.2)",
                        "rgba(255, 140, 0, 0.2)",
                        "rgba(72, 61, 139, 0.2)",
                    ],
                    borderColor: [
                        "rgba(0, 0, 139, 1)",
                        "rgba(0, 139, 139, 1)",
                        "rgba(184, 134, 11, 1)",
                        "rgba(169, 169, 169, 1)",
                        "rgba(0, 100, 0, 1)",
                        "rgba(189, 183, 107, 1)",
                        "rgba(139, 0, 139, 1)",
                        "rgba(85, 107, 47, 1)",
                        "rgba(255, 140, 0, 1)",
                        "rgba(72, 61, 139, 1)",
                    ],
                    hoverOffset: 4,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Acciones por Eje",
                },
            },
        },
    });
}

var ctx4 = document.getElementById("planning");
if (ctx4 != null) {
    var planning = JSON.parse(ctx4.getAttribute("planning"));
    var graphicPlanning = new Chart(ctx4, {
        type: "pie",
        data: {
            labels: planning.label,
            datasets: [
                {
                    label: "Planes",
                    data: planning.amount,
                    backgroundColor: [
                        "rgba(0, 0, 139, 0.2)",
                        "rgba(0, 139, 139, 0.2)",
                        "rgba(184, 134, 11, 0.2)",
                        "rgba(169, 169, 169, 0.2)",
                        "rgba(0, 100, 0, 0.2)",
                        "rgba(189, 183, 107, 0.2)",
                        "rgba(139, 0, 139, 0.2)",
                        "rgba(85, 107, 47, 0.2)",
                        "rgba(255, 140, 0, 0.2)",
                        "rgba(72, 61, 139, 0.2)",
                    ],
                    borderColor: [
                        "rgba(0, 0, 139, 1)",
                        "rgba(0, 139, 139, 1)",
                        "rgba(184, 134, 11, 1)",
                        "rgba(169, 169, 169, 1)",
                        "rgba(0, 100, 0, 1)",
                        "rgba(189, 183, 107, 1)",
                        "rgba(139, 0, 139, 1)",
                        "rgba(85, 107, 47, 1)",
                        "rgba(255, 140, 0, 1)",
                        "rgba(72, 61, 139, 1)",
                    ],
                    hoverOffset: 4,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Planes por Eje",
                },
            },
        },
    });
}

var ctx5 = document.getElementById("indicator");
if (ctx5 != null) {
    var indicator = JSON.parse(ctx5.getAttribute("indicator"));
    var graphicIndicator = new Chart(ctx5, {
        type: "pie",
        data: {
            labels: indicator.label,
            datasets: [
                {
                    label: "Indicador",
                    data: indicator.amount,
                    backgroundColor: [
                        "rgba(0, 0, 139, 0.2)",
                        "rgba(0, 139, 139, 0.2)",
                        "rgba(184, 134, 11, 0.2)",
                        "rgba(169, 169, 169, 0.2)",
                        "rgba(0, 100, 0, 0.2)",
                        "rgba(189, 183, 107, 0.2)",
                        "rgba(139, 0, 139, 0.2)",
                        "rgba(85, 107, 47, 0.2)",
                        "rgba(255, 140, 0, 0.2)",
                        "rgba(72, 61, 139, 0.2)",
                    ],
                    borderColor: [
                        "rgba(0, 0, 139, 1)",
                        "rgba(0, 139, 139, 1)",
                        "rgba(184, 134, 11, 1)",
                        "rgba(169, 169, 169, 1)",
                        "rgba(0, 100, 0, 1)",
                        "rgba(189, 183, 107, 1)",
                        "rgba(139, 0, 139, 1)",
                        "rgba(85, 107, 47, 1)",
                        "rgba(255, 140, 0, 1)",
                        "rgba(72, 61, 139, 1)",
                    ],
                    hoverOffset: 4,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Indicador por Entidad",
                },
            },
        },
    });
}

var ctx6 = document.getElementById("budgetHub");
if (ctx6 != null) {
    var budgetHub = JSON.parse(ctx6.getAttribute("budgetHub"));
    var graphicBudgetHub = new Chart(ctx6, {
        type: "bar",
        data: {
            labels: budgetHub.label,
            datasets: [
                {
                    label: "Presupuesto",
                    data: budgetHub.amount,
                    backgroundColor: [
                        "rgba(0, 0, 139, 0.2)",
                        "rgba(0, 139, 139, 0.2)",
                        "rgba(184, 134, 11, 0.2)",
                        "rgba(169, 169, 169, 0.2)",
                        "rgba(0, 100, 0, 0.2)",
                        "rgba(189, 183, 107, 0.2)",
                        "rgba(139, 0, 139, 0.2)",
                        "rgba(85, 107, 47, 0.2)",
                        "rgba(255, 140, 0, 0.2)",
                        "rgba(72, 61, 139, 0.2)",
                    ],
                    borderColor: [
                        "rgba(0, 0, 139, 1)",
                        "rgba(0, 139, 139, 1)",
                        "rgba(184, 134, 11, 1)",
                        "rgba(169, 169, 169, 1)",
                        "rgba(0, 100, 0, 1)",
                        "rgba(189, 183, 107, 1)",
                        "rgba(139, 0, 139, 1)",
                        "rgba(85, 107, 47, 1)",
                        "rgba(255, 140, 0, 1)",
                        "rgba(72, 61, 139, 1)",
                    ],
                    hoverOffset: 4,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Indicador por Entidad",
                },
            },
        },
    });
}
