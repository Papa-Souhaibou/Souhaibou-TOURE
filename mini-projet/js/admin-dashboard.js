const getJsonFileContent = (url) => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET",url,false);
    xhr.send(null);
    return JSON.parse(xhr.responseText);
} 
const users = getJsonFileContent("../models/user.php");
const questions = getJsonFileContent("../models/allQuestions.php");
const nbr_user = users["users"].length;
const nbr_admin = users["admins"].length;
let nbre_of_all_type = {
    checkbox : 0,
    radio : 0,
    text : 0
};
let nbr_question = questions.length;
for (const question of questions) {
    if (question["typeReponse"] === "checkbox"){
        nbre_of_all_type["checkbox"]++;
    }else if(question["typeReponse"] === "radio"){
        nbre_of_all_type["radio"]++;
    }else{
        nbre_of_all_type["text"]++;
    }
}
const question_config = {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                nbre_of_all_type["checkbox"],
                nbre_of_all_type["radio"],
                nbre_of_all_type["text"]
            ],
            backgroundColor:[
                "rgb(255,125,64)",
                "rgb(125,100,185)",
                'rgb(54, 162, 235)'
            ]
        }
    ],
        labels: [
            'Type checkbox',
            'Type radio',
            'Type text'
        ]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Representation graphique des differents type de reponse.'
        }
    }
};
const user_config = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                nbr_user,
                nbr_admin
            ],
            backgroundColor:[
                "rgb(255,125,64)",
                "rgb(125,100,185)"
            ]
        }
    ],
        labels: [
            'Players',
            'Admins'
        ]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Representation graphique des utilisateurs'
        }
    }
};

window.onload = function () {
    const ctx = document.querySelector('#chart-area').getContext('2d');
    const pie = document.querySelector('#pie').getContext('2d');
    const myCtx = new Chart(ctx, user_config);
    const myPie = new Chart(pie, question_config);
};
