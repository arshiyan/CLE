<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!------ Include the above in your HEAD tag ---------->

<div class="col-md-12">
    <h4 class="text-center">Champions League Table <span class="fa fa-edit pull-right bigicon"></span></h4>
    <div class="col-md-8">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center">Champions League Table <span class="fa fa-edit pull-right bigicon"></span></h4>
                </div>
                <div class="panel-body text-center">
                    <div class="row" style="background-color:#ccc">
                        <div class="col-md-3"><strong>Teams</strong></div>
                        <div class="col-md-1"><strong>PTS</strong></div>
                        <div class="col-md-1"><strong>P</strong></div>
                        <div class="col-md-1"><strong>W</strong></div>
                        <div class="col-md-1"><strong>D</strong></div>
                        <div class="col-md-1"><strong>L</strong></div>
                        <div class="col-md-1"><strong>LGD</strong></div>
                    </div>
                    <div class="row" id="result">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center" > <span id="weekNo1"></span>th Week Match Result </h4>
                </div>
                <div class="panel-body text-center">
                    <div id="week">

                    </div>



                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center" id="#predictionNo"><span id="weekNo2"></span>thth Week Prediction of Championship <span class="fa fa-edit pull-right bigicon"></span></h4>
            </div>
            <div class="panel-body text-center">
                <div id="prediction"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">

        <botton type="button" class="btn btn btn-primary pull-right" id="nextweek">Next week</botton>
        <botton type="button" class="btn btn btn-primary pull-left" id="allweek">All week</botton>
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#nextweek").click(function(){
            nextweek();

        });
        $("#allweek").click(function(){
            allweek();

        });

        getTeams();


        function getTeams()
        {
            $.ajax({
                type: "GET",
                url:"league",
                dataType: "json",
                beforeSend: function() {

                },
                success: function (data) {

                    $.each(data,function(i,obj)
                    {

                        var grid = '<div class="row"><div class="col-md-3">'+obj.team.name +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.point +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.play +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.win +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.draw +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.lose +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.gd +'</div></div>';

                        $("div#result").append(grid);

                    });
                    getResut();


                }
            });
        }




        function getPrediction()
        {
            $('#prediction').html(" ");
            $.ajax({
                type: "GET",
                url:"prediction",
                dataType: "json",
                beforeSend: function() {

                },
                success: function (data) {

                    $.each(data,function(i,obj)
                    {

                        var prediction = '<div class="row"><div class="col-md-9">'+obj.name +'</div>\n' +
                            '                    <div class="col-md-3"> % '+obj.power +'</div></div>';


                        $('#prediction').append(prediction);

                    });

                }
            });
        }

        function getResut()
        {

            $.ajax({
                type: "GET",
                url:"week/4",
                dataType: "json",
                beforeSend: function() {

                },
                success: function (data) {

                    $.each(data,function(i,obj)
                    {

                        var week = '<div class="row"><div class="col-md-5">'+obj.winner_team.name +'</div>\n' +
                            '                   <div class="col-md-2">'+obj.result +'</div> <div class="col-md-5">'+obj.lose_team.name +'</div></div>';


                        $('#week').append(week);
                        $('#weekNo1').html(obj.week);
                        $('#weekNo2').html(obj.week);
                    });
                    getPrediction();
                }
            });
        }

        function nextweek()
        {
            //resetform();
            $.ajax({
                type: "GET",
                url:"week/5",
                dataType: "json",
                beforeSend: function() {

                },
                success: function (data) {
                    $('#week').html(" ");
                    $.each(data,function(i,obj)
                    {

                        var week = '<div class="row"><div class="col-md-5">'+obj.winner_team.name +'</div>\n' +
                            '                   <div class="col-md-2">'+obj.result +'</div> <div class="col-md-5">'+obj.lose_team.name +'</div></div>';


                        $('#week').append(week);
                        $('#weekNo1').html(obj.week);
                        $('#weekNo2').html(obj.week);

                    });
                    getPrediction();
                    getTeamsAgain();
                    //getResut();
                    //getTeams();
                }
            });
        }
        function allweek()
        {
            //resetform();
            $.ajax({
                type: "GET",
                url:"week/1",
                dataType: "json",
                beforeSend: function() {

                },
                success: function (data) {
                    $('#week').html(" ");
                    $.each(data,function(i,obj)
                    {
                        var week = '';
                        var weekno ='';
                        if(weekno != obj.week)
                        {
                            week += '<div class="row" style="background-color:#ccc"> week '+obj.week+'</div>';
                        }
                        var weekno = obj.week;

                        week += '<div class="row"><div class="col-md-5">'+obj.winner_team.name +'</div>\n' +
                            '                   <div class="col-md-2">'+obj.result +'</div> <div class="col-md-5">'+obj.lose_team.name +'</div></div>';


                        $('#week').append(week);
                        $('#weekNo1').html(obj.week);
                        $('#weekNo2').html(obj.week);

                    });
                    getPrediction();
                    getTeamsAgain();
                    //getResut();
                    //getTeams();
                }
            });
        }

        function resetform()
        {
            $('#week').html("");
            $('#prediction').html("");
            //$("div#result").html("");
        }


        function getTeamsAgain()
        {
            $("div#result").html(" ");

            $.ajax({
                type: "GET",
                url:"allweek",
                dataType: "json",
                beforeSend: function() {

                },
                success: function (data) {

                    $.each(data,function(i,obj)
                    {

                        var grid = '<div class="row"><div class="col-md-3">'+obj.team.name +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.point +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.play +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.win +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.draw +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.lose +'</div>\n' +
                            '                    <div class="col-md-1">'+obj.gd +'</div></div>';

                        $("div#result").append(grid);

                    });
                }
            });
        }


    });


</script>

<style type="text/css">

</style>