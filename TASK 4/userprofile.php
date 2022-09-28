
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>body {
  font-family: arial;
}

.collapsed .fa {
  transform: rotate(180deg);
  color: #007bff;
}

.mystyle {
  color: #ff0066;
}

#notifyHeader {
  color: #007bff;
  font-size: 18px;
  text-align: center;
}

#notifyContent {
  font-size: 14px;
  text-align: center;
}

.fa {
  transition: 0.2s transform ease-in-out;
}

.card-header {
  background: #ffffff;
}

span {
  font-size: 18px;
  font-weight: bold;
}

.card {
  background: #ffffff;
}

div.a {
  margin: 0 auto;
}

.table {
  text-align: center;
}

h1,
h2 {
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
}

#messageTitle:before,
#messageTitle:after {
  content: " - ";
  color: #ff0066;
  font-weight: 800;
}

#followingTitle:before,
#followingTitle:after {
  font-weight: 800;
  content: " - ";
  color: #99ccff;
}

#followTitle:before,
#followTitle:after {
  font-weight: 800;
  content: " - ";
  color: #ff884d;
}

.imageVacation {
  width: 46%;
  height: 300px;
  float: left;
  margin: 1.66%;
}

@media screen and (max-width: 800px) {
  .imageVacation {
    width: 96%;
    height: 300px;
    float: left;
    margin: 1.66%;
  }
}

footer {
  background-color: #007bff;
  color: white;
  padding: 15px;
  text-align: center;
}
</style>

<script>let toggle = true;

//this retrieves the localStorage value
toggle = JSON.parse(localStorage.getItem("toggle"));

//If there is nothing in the localStorage, we just set the variable to true.
if (toggle == null) {
     toggle = true;
}
//If there is a localStorage value, we change the content of the page based if it is true or false.
else{
   let addFollower2 = document.getElementById("followers");
   if(toggle == false){
   const follow = document.getElementById("follow");
   follow.classList.add("btn-danger");
   follow.classList.remove("btn-success");
   follow.textContent = "Unfollow";
   addFollower2.textContent = 201;
   const updates = document.getElementById("updates");
   updates.classList.add("mystyle");
   const changeMessageHeader = document.getElementById("notifyHeader");
   changeMessageHeader.textContent = "You have one update";
   const changeMessageBody = document.getElementById("notifyContent");
   changeMessageBody.textContent = "You are now following James Prendergast.";
  }
  else{
    const follow = document.getElementById("follow");
    follow.classList.add("btn-success");
     follow.classList.remove("btn-danger");
     follow.textContent = "Follow";
     addFollower2.textContent = 200;
     const updates = document.getElementById("updates");
     updates.classList.remove("mystyle");
     const changeMessageHeader = document.getElementById("notifyHeader");
     changeMessageHeader.textContent = "You have 0 updates.";
     const changeMessageBody = document.getElementById("notifyContent");
     changeMessageBody.textContent = " ";
  }
}

//This handler is called whenever the follow button is pressed, changing the style and material on the html page
const myHandler = event =>
{
  if(toggle == true){
   const follow = document.getElementById("follow");
   follow.classList.add("btn-danger");
   follow.classList.remove("btn-success");
   follow.textContent = "Unfollow";
   const updates = document.getElementById("updates");
   updates.classList.add("mystyle");
   const changeMessageHeader = document.getElementById("notifyHeader");
   changeMessageHeader.textContent = "You have one update.";
   const changeMessageBody = document.getElementById("notifyContent");
   changeMessageBody.textContent = "You are now following James Prendergast.";
   let addFollower = document.getElementById("followers");
   addFollower.textContent = 201;
   toggle = false;
  }
  else{
   const follow = document.getElementById("follow");
   follow.classList.add("btn-success");
   follow.classList.remove("btn-danger");
   follow.textContent = "Follow";
   const updates = document.getElementById("updates");
   updates.classList.remove("mystyle");
   const changeMessageHeader = document.getElementById("notifyHeader");
   changeMessageHeader.textContent = "You have 0 updates.";
   const changeMessageBody = document.getElementById("notifyContent");
   changeMessageBody.textContent = " ";
   let addFollower = document.getElementById("followers");
   addFollower.textContent = 200;
   toggle =true;
  }
  //The toggle value is stored in the localStorage, keeping track if the user is being followed or not.
  localStorage.setItem("toggle", JSON.stringify(toggle));
}

//This sets up the event listener
const follow = document.getElementById("follow");
follow.addEventListener("click", myHandler);
</script>

</head>

<body>
  <nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">User Profile</a>
      <a class="navbar-brand" href="http://localhost/home.php">products</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Bookmarks</a>
          </li>
          <li class="nav-item">
          </li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <i id="updates" class="fa d-inline fa-lg fa-envelope-o"></i> Notifications
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li class="dropdown-header" id="notifyHeader">You have 0 updates.</li>
              <hr>
              <li id="notifyContent"></li>
            </ul>
          </div>
        </ul>
        <a href="http://localhost/login.php" class="btn navbar-btn btn-primary ml-2 text-white"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign out</a>
      </div>
    </div>
  </nav>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <div class="card">
            <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_KznlAxhYAOSfOgSIjSTRWkLzzfJfqPNdUg&usqp=CAU" alt="Card image cap" >
            <h1> Fatma Ehab </h1>
            <table class="table ">
              <thead>
                <tr>
                  <th id="messageTitle">Email</th>
                  <th id="followingTitle">Phone</th>
                  <th id="followTitle">Gender</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>fatmaa791@gmail.com</td>
                  <td>01112223334</td>
                  <td id="followers">female</td>
                </tr>
              </tbody>
            </table>

            <form action="http://localhost/editprofile.php">
            <button class="btn btn-success" id=edit > Edit Profile </button>
            </form>
            


            <div class="card-header collapsed card-link" data-toggle="collapse" href="#collapseOne">

              <span> About Me 
                       <i class="fa fa-chevron-down pull-right"></i>
                    </span>

            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion">
              <div class="card-body">
                Name:Fatma Ehab
                Adress:Cairo,Egypt
              </div>
            </div>

            <div class="card-header collapsed card-link" data-toggle="collapse" href="#collapseTwo">
              <span>
         Orders
           <i class="fa fa-chevron-down pull-right"></i>
           </span>

            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
              <div class="card-body">
                NO ORDERS YET.
              </div>
            </div>

            <div class="card-header collapsed card-link" data-toggle="collapse" href="#collapseThree">
              <span>
         Wishlist
           <i class="fa fa-chevron-down pull-right"></i>
            </span>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
              <div class="card-body">
                It is empty here.
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <footer class="container-fluid">
    <p>© 2018 User Profile. All rights reserved.</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>