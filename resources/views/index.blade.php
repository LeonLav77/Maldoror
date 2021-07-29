<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/ProductsClass.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <link href="{{ url('/css/nyes.css') }}" rel="stylesheet">

    <title>Product list</title>
    <script>
        function $_GET(q,s) {
            s = (s) ? s : window.location.search;
            var re = new RegExp('&amp;'+q+'=([^&amp;]*)','i');
            return (s=s.replace(/^\?/,'&amp;').match(re)) ?s=s[1] :s='';
        }
        $( document ).ready(function() {
            console.log("{{ $isAuth }}")
            console.log("{{ $howManyItems }}")
            var staticURL = (window.location.href).split('?')[0]
            ajaxCall2("{{$startPoint}}");
            makePageNumber('{{$id}}',"{{$yee}}");
            addEventListener('submit', function(event) {
                event.preventDefault();
                let nextURL = staticURL+"?filter="+$('#filter').val();
                let brojStr = "{{$id}}";
                if(brojStr != 1) {
                    window.location.href = "http://127.0.0.1:8000/page/1"+"?filter="+$('#filter').val();
                }
                window.history.pushState('', 'nextTitle', nextURL);
                test();
            })
        });
        function ajaxCall2(startPoint,method){ // function that send an ajax request
            var value = $_GET('filter');
            if(!(value=='')){
                test(value);
            }else{
            $.ajax({
                dataType: 'json',
                url: '/gobble',
                type: 'GET',
                data:{startPoint:startPoint},
                success: function(response) { // when the request is done delete the previously placed products for new ones
                    let parentDiv = document.querySelector('#basic-grid');
                    //console.log(response);
                    removeAllChildNodes(parentDiv);
                    turnToObjects(response);
                }
            });
              };
        }
        function turnToObjects(response){
            var arrayOfObjects = [];
            // (response.length)
            for(let i = 0; i < response.length; i++) {
                let currentItem = response[i];
                //console.log(currentItem);
                let newObject = new Products(currentItem['id'],currentItem['naslov'],currentItem['dostupneVelicine'],currentItem['cijenaUKN'],currentItem['slika1'],currentItem['slika2']);
                arrayOfObjects.push(newObject);
            }
            makeDOMable(arrayOfObjects);
            
        }
        function makeDOMable(arrayOfObjects){    // loops through the objects
            for (let i = 0; i < arrayOfObjects.length; i++) {
                currentItem = arrayOfObjects[i];
                changeDOM(currentItem);
            }
        }

        function changeDOM(currentObject){
            //console.log(currentObject);
            let parentElement = document.querySelector(".basic-grid");
            let outerDiv = document.createElement('div');
            let innerDiv = document.createElement('div');

            imeSlike = currentObject['slika1'];
            imeNastavka = "/1.png";
            //console.log(imeSlike);
            imeSlike = imeSlike.replace("/1.png","");
            imeSlike = imeSlike.replace("/","");
            //console.log(imeSlike);
            imeSlike = imeSlike.concat(imeNastavka);
            //console.log(imeSlike);
            let linkSlika = "http://mockapi.ddns.net/YEE/"+imeSlike;
            let picture = document.createElement('img');
            picture.setAttribute('src',linkSlika);
            picture.setAttribute('class',"slika");
            picture.setAttribute('alt','ye');
            linkSlike = document.createElement('a');
            lnk = "/Majca/"+currentObject['id'];
            linkSlike.setAttribute('href',lnk);
            linkSlike.appendChild(picture);
            innerDiv.appendChild(linkSlike);

            hmm = [currentObject['naslov'],currentObject['cijenaUKN']]
            for(let k = 0; k < 2; k++) {
                var textToAdd = document.createTextNode(hmm[k]);
                let p1 = document.createElement('p');
                p1.appendChild(textToAdd);
                innerDiv.appendChild(p1);

            outerDiv.setAttribute('class','card');
            innerDiv.setAttribute('class','center');
            outerDiv.appendChild(innerDiv);
            parentElement.appendChild(outerDiv);
            }
        }
        
        function clear() {
            console.log("clear");
            window.location.replace("/page/1");
        }
        function nextPage(nastavak){
            if (nastavak == undefined) {
                nastavak = '';
            }
            let currentPage = "{{$id}}";
            let nextPage = parseInt(currentPage) + 1;
            window.location.replace("/page/"+nextPage+nastavak);
        }
        function lastPage(nastavak){
            if (nastavak == undefined) {
                nastavak = '';
            }
            let currentPage = "{{$id}}";
            let nextPage = parseInt(currentPage) - 1;
            window.location.replace("/page/"+nextPage+nastavak);
        }
        function makePageNumber(currentPage,ukupnoStranica,nastavak){
                let parentDiv = document.querySelector('#pageNumber');
                removeAllChildNodes(parentDiv);
                if(currentPage > 1 && currentPage<= (parseInt(ukupnoStranica)-2)){
                    minPage = parseInt(currentPage) - 2;
                    maxPage = parseInt(currentPage) + 2;
                }
                switch(currentPage) { // dont like this because its hardcoded
                        case '1':
                            var last = document.getElementById('last');
                            last.setAttribute('onclick','');
                            var minPage = 1;
                            var maxPage = parseInt(currentPage) + 4;
                            if(ukupnoStranica < 5){
                                var maxPage = parseInt(currentPage) + (ukupnoStranica-parseInt(currentPage));
                            }
                            break;
                        case '2':
                            minPage = 1;
                            maxPage = parseInt(currentPage) + 3;
                            if(ukupnoStranica < 5){
                                maxPage = parseInt(currentPage) + (ukupnoStranica-parseInt(currentPage));
                            }
                            break;
                        case (parseInt(ukupnoStranica)-1).toString():

                            minPage = parseInt(currentPage) - 3;
                            maxPage = parseInt(currentPage) + 1;
                            if(ukupnoStranica < 5){
                                var minPage = parseInt(currentPage) + (parseInt(currentPage) - parseInt(ukupnoStranica));
                                var maxPage = parseInt(currentPage) + (ukupnoStranica-parseInt(currentPage));
                            }
                            break;
                        case (ukupnoStranica).toString():
                            var next = document.getElementById('next');
                            next.setAttribute('onclick','');
                            minPage = parseInt(currentPage) - 4;
                            maxPage = parseInt(currentPage);
                            if(ukupnoStranica < 5){
                                var minPage = parseInt(ukupnoStranica) - (parseInt(ukupnoStranica) -1);
                            }
                        }
                    specialPage = currentPage;
                    ifPresent = "/?filter=";
                    if(nastavak == undefined){
                        nastavak = '';
                        ifPresent = '';
                    }
                    for (let i = minPage; i <= maxPage; i++) {
                        let currentCircle = document.createElement('div');
                        if(i == specialPage){
                            currentCircle.setAttribute('class', 'circleRed');
                            currentCircle.innerHTML = i;
                            parentDiv.appendChild(currentCircle);
                            
                        }else{
                            linkSlike = document.createElement('a');
                            lnk = "/page/"+i+ifPresent+nastavak;
                            linkSlike.setAttribute('href',lnk);
                            currentCircle.setAttribute('class', 'circle');
                            currentCircle.innerHTML = i;
                            linkSlike.appendChild(currentCircle);
                            parentDiv.appendChild(linkSlike);

                    
                    
                }
            }
        }
        function test(nastavak){ // function that send an ajax request
            if (nastavak == undefined) {
                broj = $('#filter').val()
            }else{
                broj = nastavak;
            }
            var last = document.getElementById('last');
            var filt = broj;
            var whereToLast = "lastPage('?filter="+filt+"')";
            var whereToNext = "nextPage('?filter="+filt+"')";
            last.setAttribute('onclick',whereToLast);
            var next = document.getElementById('next');
            next.setAttribute('onclick',whereToNext);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                url: '/filter',
                data: {yourNumber:broj,
                        brojStranice:"{{$id}}"
                },
                type: 'GET',
                success: function(response) { // when the request is done delete the previously placed products for new ones
                    let parentDiv = document.querySelector('#basic-grid');
                    console.log(response['filteredData']);
                    console.log(response['ukupanBroj']);
                    removeAllChildNodes(parentDiv);
                    turnToObjects(response['filteredData']);
                    makePageNumber('{{$id}}',parseInt(response['ukupanBroj']/40)+1,broj);

                }
            });
    }
    </script>
</head>
<body> 
    @include('navbar')
    <br />
    <div class="container">
        <form>
            <select name="filter" id="filter">
                <option value="S">S</option>      
                <option value="M">M</option>       
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
            <input type="submit" value="filter" />
        </form>
            <a href="/page/1"><button id="clear" onclick="clear()">Clear</button></a>
    </div>
        <div class="basic-grid" id="basic-grid">

        </div>
        <div class="buttton">
        <button type="button" class="nextPage" onclick="lastPage()" id="last">last page</button>
        <div id="pageNumber">
        </div>
        <button type="button" class="nextPage" onclick="nextPage()" id="next">next page</button>
        </div>
</body>
</html>