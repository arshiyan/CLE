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
                    <div class="row">
                        <div class="col-md-3">Teams</div>
                        <div class="col-md-1">PTS</div>
                        <div class="col-md-1">P</div>
                        <div class="col-md-1">W</div>
                        <div class="col-md-1">D</div>
                        <div class="col-md-1">L</div>
                        <div class="col-md-1">LGD</div>
                    </div>
                    <div class="row" id="result">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center" id="#weekNo">  Week Match Result </h4>
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
                <h4 class="text-center" id="#predictionNo">0th Week Prediction of Championship <span class="fa fa-edit pull-right bigicon"></span></h4>
            </div>
            <div class="panel-body text-center">
                <div id="prediction"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        getTeams();
        getResut();
        getPrediction();

        function getTeams()
        {
            $.ajax({
                type: "GET",
                url:"league",
                dataType: "json",
                beforeSend: function() {
                    //$('#response').html("<img src='/images/Preloader_2.gif' />");
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


        function getResut()
        {
            $.ajax({
                type: "GET",
                url:"week/4",
                dataType: "json",
                beforeSend: function() {
                    //$('#response').html("<img src='/images/Preloader_2.gif' />");
                },
                success: function (data) {

                    $.each(data,function(i,obj)
                    {
                        console.log(obj);
                        var week = '<div class="row"><div class="col-md-5">'+obj.winner_team.name +'</div>\n' +
                            '                   <div class="col-md-2">'+obj.result +'</div> <div class="col-md-5">'+obj.lose_team.name +'</div></div>';
                        console.log(week);

                        $('#week').append(week);

                    });

                }
            });
        }

        function getPrediction()
        {
            $.ajax({
                type: "GET",
                url:"prediction",
                dataType: "json",
                beforeSend: function() {
                    //$('#response').html("<img src='/images/Preloader_2.gif' />");
                },
                success: function (data) {

                    $.each(data,function(i,obj)
                    {

                        var prediction = '<div class="row"><div class="col-md-9">'+obj.name +'</div>\n' +
                            '                    <div class="col-md-4">'+obj.power +'</div></div>';
                        console.log(week);

                        $('#prediction').append(prediction);

                    });

                }
            });
        }
    });
</script>

<style type="text/css">

</style>