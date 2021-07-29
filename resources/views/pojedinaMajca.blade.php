<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ url('/css/nyes.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Majca</title>
    <script>
    $( document ).ready(function() {
        var dostupneVelicine = @json($dostupneVelicine);
        const yes = dostupneVelicine.map(name => {
            return name.trim(); 
        });
        var parentElement = document.querySelector("#dostupneVelicine");
        var select = document.createElement("select");
        select.setAttribute('id','sele');
        var optionsArray = ["XS","S","M","L","XL","XXL"];
        for (var i = 0; i < optionsArray.length; i++){
            current = optionsArray[i];
            current.trim();
            let option = document.createElement("option");
            option.setAttribute("value",current);
            option.innerHTML = current;
            if(!(yes.includes(current))){
                option.setAttribute("disabled","disabled");
            }
        select.appendChild(option);

        }
        parentElement.appendChild(select);
        document.addEventListener("submit", function(e){
            let selectedOptionVal = $('#sele').find(":selected").val();
            let id = "{{$id}}"; 
            e.preventDefault();
            ajaxCall(selectedOptionVal,id);
        });
    });
    function ajaxCall(velicina,id){ // function that send an ajax request
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            url: '/cart',
            data: {
                velicina:velicina,
                id:id,
                kolicina:1
            },
            type: 'POST',
            success: function(response) { // when the request is done delete the previously placed products for new ones
                console.log(response)
            }
            });
    }

    </script>
</head>
<body>
    @include('navbar')
    <div id="content">
    <h1 id="naslov">{{$naslov}}</h1>
    <img src="{{ $slika1 }}">
    @isset($slika2)
    <img src="{{ $slika2 }}">
    @endisset
    <p>
    <form id="dostupneVelicine">
    <button type="sumbit">ADD TO CART</button>
    </form>
    </p>
    </div>
</body>
</html>