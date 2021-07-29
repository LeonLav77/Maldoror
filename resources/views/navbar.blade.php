<!DOCTYPE html>
<html>
<head>
<link href="{{ url('/css/nyes.css') }}" rel="stylesheet">
<script src="{{ asset('js/common.js') }}"></script>

<script>
  $( document ).ready(function() {
  var isAuth = "{{ $isAuth }}";
  var howManyItems = "{{ $howManyItems }}";
  if(!(isAuth == "")){
    if(howManyItems == ""){
      howManyItems = 0;
    }
    let parentElement = document.querySelector("#right");
    removeAllChildNodes(parentElement);
    let signOut = document.createElement("li");
    signOut.setAttribute('class','list');
    let link = document.createElement("a");
    link.innerHTML = 'Sign Out';
    link.setAttribute('href','/logOut');
    signOut.appendChild(link);
    parentElement.appendChild(signOut);
    let secondParentElement = document.querySelector("#krug");
    secondParentElement.innerHTML = howManyItems;
  }
  });
</script>
</head>
<body>

<ul class="listFather">
  <li class="list"><a href="/">Home</a></li>
  <li class="list"><a href="#news">News</a></li>
  <li class="list"><a href="#contact">Contact</a></li>
  <li class="right lst"><a href="/cart"><div id="krug"></div><img src="/images/cart.jpg" width="25"></a></li>
  <div id="right" class="right">
    <li class="list"><a href="/register">Sign up</a></li>
    <li class="list"><a href="/login">Login</a></li>
  </div>
</ul>

</body>
</html>