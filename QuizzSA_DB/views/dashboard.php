<div class="row mt-2 mb-2 m">
    <div class="card text-left col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-2">
      <div class="card-body">
        <canvas id="chart-area"></canvas>
      </div>
    </div>
    <div class="card text-left col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-2">
      <div class="card-body">
        <canvas id="pie"></canvas>
      </div>
    </div>
</div>
<script>
  $(function () {
    const charArea = document.querySelector("#chart-area");
    const chartPie = document.querySelector("#pie");
    const userConfig = {
      type: 'doughnut',
      data: {
        datasets: [
          {
            data: [
                0,
                0
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
    const questionConfig = {
      type: 'pie',
      data: {
        datasets: [
          {
            data: [
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
    const countPlayer = admins => {
      let nbrAdmins = 0;
      for (const admin of admins) {
        if(admin["idAdmin"]){
          nbrAdmins++;
        }
      }
      return nbrAdmins;
    };
    const getQuestions = () => {
      const data = new FormData();
      data.append("question","question");
      $.ajax({
        type: "POST",
        url: "../models/getUsersList.php",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        dataType: "json",
        success: function (response) {
          const result = countNbrOfEachQuestionType(response);
          questionConfig.data.datasets[0].data = result;
          console.log(userConfig.data.datasets[0].data);
          
          const ctx = chartPie.getContext('2d');
          const myCtx = new Chart(ctx, questionConfig);
        }
      });
    };
    const countNbrOfEachQuestionType = questions => {
      const result = [0,0,0];
      for (const question of questions) {
        if(question.typeQuestion == "checkbox"){
          result[0]++;
        }else if(question.typeQuestion == "radio"){
          result[1]++;
        }else{
          result[2]++;
        }
      }
      return result;
    };
    const getThemAll = () => {
      const data = new FormData();
      data.append("login","login");
      $.ajax({
        type: "POST",
        url: "../models/getUsersList.php",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        dataType: "json",
        success: function (response) {
          const nbrAdmin = countPlayer(response);
          const nbrPlayer = response.length - nbrAdmin;
          userConfig.data.datasets[0].data[0] = nbrPlayer;
          userConfig.data.datasets[0].data[1] = nbrAdmin;
          const ctx = charArea.getContext('2d');
          const myCtx = new Chart(ctx, userConfig);
        }
      });
    };
    getThemAll();
    getQuestions();
  });
</script>