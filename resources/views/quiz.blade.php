<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #333;
        }

        .container {
            background-color: #555;
            color: #ddd;
            border-radius: 10px;
            padding: 20px;
            font-family: 'Montserrat', sans-serif;
            max-width: 700px;
        }

        .container>p {
            font-size: 32px;
        }

        .question {
            width: 75%;
        }

        .options {
            position: relative;
            padding-left: 40px;
        }

        #options label {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            cursor: pointer;
        }

        .options input {
            opacity: 0;
        }

        .checkmark {
            position: absolute;
            top: -1px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #555;
            border: 1px solid #ddd;
            border-radius: 50%;
        }

        .options input:checked~.checkmark:after {
            display: block;
        }

        .options .checkmark:after {
            content: "";
            width: 10px;
            height: 10px;
            display: block;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s;
        }

        .options input[type="radio"]:checked~.checkmark {
            background: #21bf73;
            transition: 300ms ease-in-out 0s;
        }

        .options input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1);
        }

        .btn-primary {
            background-color: #555;
            color: #ddd;
            border: 1px solid #ddd;
        }

        .btn-primary:hover {
            background-color: #21bf73;
            border: 1px solid #21bf73;
        }

        .btn-success {
            padding: 5px 25px;
            background-color: #21bf73;
        }

    </style>
</head>

<body>
    <form action="/save" method="get" id="form1">
        <div class="container mt-sm-5 my-1">
            <div id="demo"></div>
            <div class="question ml-sm-5 pl-sm-5 pt-2">
                @foreach ($ques as $ques)
                    <div class="py-2 h5"><b><span>{{ $question_id }}</span> {{ $ques->question }}</b></div>
                @endforeach
                @foreach ($ansr as $ansr)
                    <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
                        <label class="element-animation1 btn btn-lg btn-primary btn-block"><span class="btn-label"><i
                                    class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio"
                                name="answer" id="radio_id" value="{{ $ansr->answer }}">{{ $ansr->answer }}</label>
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="question_id" value="{{ $question_id + 1 }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="d-flex align-items-center pt-3">
                <div id="prev">
                    <a href={{ '/next/' . $question_id - 1 }} class="btn btn-primary">Previous</a>
                </div>
                <div class="ml-auto mr-sm-5">
                    <input type="submit" id="register" class="btn btn-success" value="Next">
                </div>
            </div>
        </div>
    </form>


</body>
<script>
    // Set the date we're counting down to


    var countDownDate = new Date("{{ Session('time') }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);

            window.location.href = "http://127.0.0.1:8000/test_result";
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>

</html>
