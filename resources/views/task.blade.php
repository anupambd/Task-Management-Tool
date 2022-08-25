<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Management-tool</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
        .task-border {
            background-color: yellow;
            border: 1px solid black;
            margin: 30px;
        }
        .task-title{
            border-bottom: 1px solid black ;
            padding-bottom: 5px;
        }
        .custom-btn{
            margin-left: 5px;
        }
        .btn-secondary{
            z-index: 1111;
        }
    </style>

</head>

<body>





<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            {{--<h1 class="display-3">Hello, world!</h1>--}}
            <form class="form-horizontal" role="form" method="POST" action="{{ url('add-task') }}" enctype="multipart/form-data">
            {{--<form id="todo-form">--}}
                {{ csrf_field() }}
                <div class="d-flex align-items-center justify-content-center">
                    <div class="input-group mb-3 mr-4 col-md-4">
                        {{--<div class="input-group-prepend">--}}
                        {{--<span class="input-group-text" id="basic-addon1">@</span>--}}
                        {{--</div>--}}
                        <input required type="text" name="task_detail" id="task_detail" class="form-control" placeholder="Write Your Task" aria-label="Username" aria-describedby="basic-addon1">
                        @error('fast_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn btn-outline-secondary custom-btn"  type="submit">Add</button>
                    </div>
                </div>


            </form>

        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <input type="hidden" id="todo_new_id" value="">
        <div class="row">
            <div class="col-md-3 task-border" id="todozone">
                <h2 class="task-title">To Do</h2>
                <?php foreach ($allData['todo'] as $todo){ ?>
                <p><a onmouseover="getTodo({{$todo->id}})" class="btn btn-secondary" href="#"  id="winston_{{$todo->id}}"role="button">{{$todo->task_detail}} &raquo;</a></p>
                <?php } ?>
            </div>
            <div class="col-md-3 task-border" id="progresszone">
                <h2 class="task-title">In progress</h2>
                <?php foreach ($allData['inProgress'] as $inProgress){ ?>
                <p><a onmouseover="getTodo({{$inProgress->id}})" class="btn btn-secondary" href="#" id="winston_{{$inProgress->id}}" role="button">{{$inProgress->task_detail}} &raquo;</a></p>
                <?php } ?>
            </div>
            <div class="col-md-3 task-border" id="donezone">
                <h2 class="task-title">Done</h2>
                <?php foreach ($allData['done'] as $done){ ?>
                <p><a onmouseover="getTodo({{$done->id}})" class="btn btn-secondary" href="#"  id="winston_{{$done->id}}"role="button">{{$done->task_detail}} &raquo;</a></p>
                <?php } ?>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

</main>

<footer class="container">
    <p>&copy; Company 2022-2023</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- Also include jQueryUI -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
    function getTodo(id){
        var newid = id;
        var newooo = newid;
        $("#todo_new_id").val(newid);
    }

    const alldata = '<?php echo $totalData ?>';
    const newAlldata = JSON.parse(alldata);

    for (let i = 0; i < newAlldata.length; i++){
        const element = newAlldata[i];
        const taskId = element.id;
        $('#winston_'+taskId).draggable({
            revert: 'invalid',
            stop: function(){
                $(this).draggable('option','revert','invalid');
            }
        });
    }


//    $('#winston_2').draggable({
//            revert: 'invalid',
//            stop: function(){
//                $(this).draggable('option','revert','invalid');
//            }
//        });



    $("#progresszone").droppable({
        drop: function(event, ui) {
            const mTask = $("#todo_new_id").val();
            $(this).css('background', 'rgb(0,200,0)');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                type: "GET",
                url: '/update-task',
                data: {task_id:mTask,status_id:2},
                success: function( msg ) {
                    location.reload();
                }
            });
        },
        over: function(event, ui) {
            $(this).css('background', 'orange');
        },
        out: function(event, ui) {
            $(this).css('background', 'cyan');
        }
    });


    $("#donezone").droppable({
        drop: function(event, ui) {
            const mTask = $("#todo_new_id").val();
            $(this).css('background', 'rgb(0,200,0)');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                type: "GET",
                url: '/update-task',
                data: {task_id:mTask,status_id:3},
                success: function( msg ) {
                    console.log(msg);
                    location.reload();
                }
            });
        },
        over: function(event, ui) {
            $(this).css('background', 'orange');
        },
        out: function(event, ui) {
            $(this).css('background', 'cyan');
        }
    });
</script>

<script>
    $('#todo-form').on('submit', function(e) {
        e.preventDefault();
        var task_detail = $('#task_detail').val();
        alert(task_detail);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            type: "POST",
            url: '/api/add-task',
            data: {task_detail:task_detail},
            success: function( msg ) {
                alert( 'fgfdgdf' );
            }
        });
    });
</script>
</body>
</html>
