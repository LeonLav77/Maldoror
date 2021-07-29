<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ url('/css/nyes.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart</title>
    <script>
        $( document ).ready(function() {
            ajaxCall();
        });
    function ajaxCall() { // function that send an ajax request
        $.ajax({
            dataType: 'json',
            url: '/GetCart',
            data: {
                id:"{{$id}}"
            },
            success: function(response) { // when the request is done delete the previously placed products for new ones
                console.log(response)
                addToProductList(response);
            }
            });
    }
    function ajaxCall2(id,kolicina,velicina){ // function that send an ajax request
        $.ajax({
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/MajcaInfo',
            type: 'POST',
            data: {
                id:id
            },
            success: function(response) { // when the request is done delete the previously placed products for new ones
                DOMinantan(response,kolicina,velicina);
            }
            });
    }
    function ajaxDelete(id,velicina) {
        $.ajax({
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/delete',
            type: 'POST',
            data: {
                id:id,
                velicina:velicina
            },
            success: function(response) { // when the request is done delete the previously placed products for new ones
                console.log(response)
                ajaxCall();
            }
            });
    }
    function addToProductList(products) {
        let parentElement = document.querySelector("#parentElement");
        removeAllChildNodes(parentElement);
        for(var i=0; i<products.length;i++){
            currentProduct = products[i];
            console.log(currentProduct);
            ajaxCall2(currentProduct['product'],currentProduct['kolicina'],currentProduct['velicina']);
        }

    }
    function deleteIt(id,velicina){
        ajaxDelete(id,velicina);
    }
    function DOMinantan(resp,kolicina,velicina){
        console.log(resp);
        let id = resp['id'];
        let slika1 = resp['slika1'];
        let naslov = resp['naslov'];
        let cijena = resp['cijenaUKN'];
        let parentElement = document.querySelector("#parentElement");

        let mainList = document.createElement('ul')
        mainList.setAttribute('class','flexy');
        let buttonList = document.createElement('li')
        let picture = document.createElement('li')
        let naslovList = document.createElement('li')
        let velicinaList = document.createElement('li')
        let cijenaList = document.createElement('li')
        let kolicinaList = document.createElement('li')
        let ukupno = document.createElement('li')

        let funkcija = `deleteIt(${id},"${velicina}")`;

        let closePic = document.createElement('img')
        let linkZaMaknut = document.createElement('a')
        linkZaMaknut.setAttribute('class','centercenter');
        linkZaMaknut.setAttribute('onclick',funkcija);
        closePic.setAttribute('src','/images/close-cross.png');
        closePic.setAttribute('class','tiny');
        linkZaMaknut.appendChild(closePic);
        buttonList.appendChild(linkZaMaknut);
        buttonList.setAttribute('class','centercenter')


        let pic = document.createElement('img')
        pic.setAttribute('src',slika1);
        pic.setAttribute('class','malaSlika');
        picture.appendChild(pic);

        naslovList.innerHTML = naslov;

        velicinaList.innerHTML = velicina;

        cijenaList.innerHTML = cijena;

        let num = document.createElement('input');
        num.setAttribute('type','number');
        num.setAttribute('min','1');
        num.setAttribute('max','5');
        num.setAttribute('step','1');
        num.setAttribute('value',kolicina);
        num.setAttribute('class','malen');
        kolicinaList.appendChild(num);

        mainList.appendChild(buttonList);
        mainList.appendChild(picture);
        mainList.appendChild(naslovList);
        mainList.appendChild(velicinaList);
        mainList.appendChild(cijenaList);
        mainList.appendChild(kolicinaList);

        parentElement.appendChild(mainList);
    }
    function calculatePrice() {
        var inputs = $(".malen");
        finalPrice = 0;
        for(var i = 0; i < inputs.length; i++){
            finalPrice += $(inputs[i]).val() * 169;
        }
        let parentElement = $("#placeForFinalPrice");
        parentElement.html(finalPrice+" kn");
    }
    </script>
</head>
<body>
    @include('navbar')
    <div class="container">
        <h1>CART</h1>
    <ul id="parentElement">
        
        
    </ul>
    <div id="ukupnaCijena">
        <button onClick="calculatePrice()">Calculate Final Price</button>
    </div>
    <h1 id="placeForFinalPrice"></h1>
    </div>
</body>
</html>