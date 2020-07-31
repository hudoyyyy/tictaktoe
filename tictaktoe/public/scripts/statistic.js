$(document).ready(function () {
    let statistic;
    $.ajax({
        async: false,
        type: "get",
        url: "/getStatistic",
        success: function (response) {
            statistic = JSON.parse(response);
            document.getElementById("fullcount").innerText = "Игр всего: " + statistic[0];
            document.getElementById("wins").innerText = "Побед: " + statistic[1];
            document.getElementById("loses").innerText = "Поражений: " + statistic[2];
            document.getElementById("draws").innerText = "Ничьих: " + statistic[3];
        }
    })
})