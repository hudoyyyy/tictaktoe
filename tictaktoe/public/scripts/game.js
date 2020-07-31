$(document).ready(function () {
    intervalConnection = setInterval(checkConnection, 1000);
});

function gameProcess() {
    gamer = whoAmI();
    getGameField();
    intervalCheck = setInterval(() => checkTurn(gamer), 500);
    $('.conteiner').on("click", ".row-el", function (e) {
        $(".row-el").prop("disabled", true);
        $(e.target).html(symbol(window.gamer));
        sendGameField(e);
    });
}


function checkTurn() {
    let id = Number(document.getElementById("game-id").innerHTML);
    $.ajax({
        type: "post",
        url: "/getTurn",
        data: {
            id: id,
        }
    }).done(response => {
        let data = JSON.parse(response);
        if (data === 0) {
            document.getElementById("turn").innerText = "Ход первого игрока";
        } else {
            document.getElementById("turn").innerText = "Ход второго игрока";
        }
        if ((data === 0 && window.gamer === 1) || (data === 1 && window.gamer === 0)) {
            $(".row-el").prop("disabled", true);
        } else if ((data === 1 && window.gamer === 1) || (data === 0 && window.gamer === 0)) {
            $(".row-el").prop("disabled", false);
            getGameField();
        }
    })
}


function setGameField(game_field) {
    let game_field_arr = game_field.split(",");
    for (let i = 1; i <= game_field_arr.length; i++) {
        if (game_field_arr[i - 1] === "\"1\"") {
            let first_pos = document.getElementById("1");
            if (first_pos.innerText !== "") {
                first_pos.disabled = true;
            } else {
                if (i === 1) {
                    first_pos.innerText = symbol(0);
                } else {
                    first_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"2\"") {
            let second_pos = document.getElementById("2");
            if (second_pos.innerText !== "") {
                second_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    second_pos.innerText = symbol(0);
                } else {
                    second_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"3\"") {
            let third_pos = document.getElementById("3");
            if (third_pos.innerText !== "") {
                third_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    third_pos.innerText = symbol(0);
                } else {
                    third_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"4\"") {
            let fourth_pos = document.getElementById("4");
            if (fourth_pos.innerText !== "") {
                fourth_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    fourth_pos.innerText = symbol(0);
                } else {
                    fourth_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"5\"") {
            let fifth_pos = document.getElementById("5");
            if (fifth_pos.innerText !== "") {
                fifth_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    fifth_pos.innerText = symbol(0);
                } else {
                    fifth_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"6\"") {
            let sixth_pos = document.getElementById("6");
            if (sixth_pos.innerText !== "") {
                sixth_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    sixth_pos.innerText = symbol(0);
                } else {
                    sixth_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"7\"") {
            let seventh_pos = document.getElementById("7");
            if (seventh_pos.innerText !== "") {
                seventh_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    seventh_pos.innerText = symbol(0);
                } else {
                    seventh_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"8\"") {
            let eighth_pos = document.getElementById("8");
            if (eighth_pos.innerText !== "") {
                eighth_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    eighth_pos.innerText = symbol(0);
                } else {
                    eighth_pos.innerText = symbol(1);
                }
            }
        }
        if (game_field_arr[i - 1] === "\"9\"") {
            let ninth_pos = document.getElementById("9");
            if (ninth_pos.innerText !== "") {
                ninth_pos.disabled = true;
            } else {
                if (i % 2 === 1) {
                    ninth_pos.innerText = symbol(0);
                } else {
                    ninth_pos.innerText = symbol(1);
                }
            }
        }
    }
    checkWin(game_field_arr);
}

function checkWin(game_field) {
    let line1 = ["\"1\"", "\"2\"", "\"3\""];
    let line2 = ["\"4\"", "\"5\"", "\"6\""];
    let line3 = ["\"7\"", "\"8\"", "\"9\""];
    let line4 = ["\"1\"", "\"4\"", "\"7\""];
    let line5 = ["\"2\"", "\"5\"", "\"8\""];
    let line6 = ["\"3\"", "\"6\"", "\"9\""];
    let line7 = ["\"1\"", "\"5\"", "\"9\""];
    let line8 = ["\"3\"", "\"5\"", "\"7\""];
    let arrayFirstTurns = [];
    let arraySecondTurns = [];
    let draw = true;
    for (let i = 1; i <= game_field.length; i++) {
        if (i % 2 === 0) {
            arraySecondTurns.push(game_field[i - 1]);
        } else if (i % 2 === 1) {
            arrayFirstTurns.push(game_field[i - 1]);
        }
    }
    if (comparison(arrayFirstTurns, line1) || comparison(arrayFirstTurns, line2) || comparison(arrayFirstTurns, line3) || comparison(arrayFirstTurns, line4)
        || comparison(arrayFirstTurns, line5) || comparison(arrayFirstTurns, line6) || comparison(arrayFirstTurns, line7) || comparison(arrayFirstTurns, line8)) {
        stop(0)
        draw = false;
    } else if (comparison(arraySecondTurns, line1) || comparison(arraySecondTurns, line2) || comparison(arraySecondTurns, line3) || comparison(arraySecondTurns, line4)
        || comparison(arraySecondTurns, line5) || comparison(arraySecondTurns, line6) || comparison(arraySecondTurns, line7) || comparison(arraySecondTurns, line8)) {
        stop(1)
        draw = false;
    }


    if (game_field.length === 9 && draw === true) {
        stop(2)
    }
}

function stop(whoWon) {
    clearInterval(window.intervalCheck);
    $(".row-el").prop("disabled", true);
    let won;
    let lost;
    if (whoWon === 1) {
        document.getElementById("turn").innerText = "Победил второй игрок!"
        if(whoWon === window.gamer) {
            won = document.getElementById("second-gamer").innerText;
        } else {
            lost = document.getElementById("first-gamer").innerText;
        }
    }
    if (whoWon === 0) {
        document.getElementById("turn").innerText = "Победил первый игрок!"
        if(whoWon === window.gamer) {
            won = document.getElementById("first-gamer").innerText;
        } else {
            lost = document.getElementById("second-gamer").innerText;
        }
    }
    if (whoWon === 2) {
        document.getElementById("turn").innerText = "Ничья!"
        won = document.getElementById("second-gamer").innerText;
        lost = document.getElementById("first-gamer").innerText;
    }
    gameEnd(whoWon, won, lost);
}

function comparison(turnsArray, winCondition) {
    for (let i = 0; i < winCondition.length; i++) {
        if (turnsArray.indexOf(winCondition[i]) === -1) {
            return false;
        }
    }
    return true;
}

function gameEnd(status, whoWon, whoLost) {
    $.ajax({
        type: "post",
        url: "/gameEnd",
        data: {
            id: Number(document.getElementById('game-id').innerText),
            whoWon: whoWon,
            whoLost: whoLost,
            status: status,
        }
    })
}

function getGameField() {
    let id = Number(document.getElementById("game-id").innerHTML);
    $.ajax({
        type: "post",
        url: "/getField",
        data: {
            id: id,
        }
    }).done(response => {
        setGameField(response);
    })
}


function sendGameField(e) {
    let fieldJSON = JSON.stringify(e.target.id);
    let id = Number(document.getElementById("game-id").innerHTML);
    $.ajax({
        type: "post",
        url: "/sendField",
        data: {
            game_field: fieldJSON,
            id: id
        }
    })
}

function checkConnection() {
    let id = Number(document.getElementById("game-id").innerText);
    $.ajax({
        type: "post",
        url: "/checkConnection",
        data: {
            id: id,
        },
    }).done(response => {
        if(response){
            document.getElementById("second-gamer").innerText = response;
            gameProcess();
            clearInterval(intervalConnection);
        }
    })

}

function whoAmI() {
    let id = Number(document.getElementById("game-id").innerHTML);
    let data;
    $.ajax({
        async: false,
        type: "post",
        url: "/whoami",
        data: {
            id: id
        },
        success: function (response) {
            data = Number(response);
        }
    });
    return data;
}


function symbol(input) {
    switch (input) {
        case 0:
            return "X";
        case 1:
            return "O";
    }
}