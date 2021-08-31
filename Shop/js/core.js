var logged = false;
var data = null;

function Setup() {
  $.ajax({
    url: "https://geolocation-db.com/jsonp",
    jsonpCallback: "callback",
    dataType: "jsonp",
    success: function (location) {
      $("#city").html(location.city);
    },
  });

  LoadData();
}

function Login() {
  if (data != null) {
    LoadData();
    return;
  } else {
    window.location.href = "../Account/login.html";
  }
}

function LoadData() {
  logged = localStorage.getItem("logged");

  if (logged == false) {
    document.getElementById("welcome").innerHTML = "Non sei loggato";
    document.getElementById("username").innerHTML = "Accedi/registrati";
    localStorage.clear();
  } else {
    data = localStorage.getItem("data");
    document.getElementById("welcome").innerHTML = "Benvenuto";
    document.getElementById("username").innerHTML = data
      .split(":")[2]
      .split('"')[1];
  }
}

function Logout() {
  if (logged) {
    logged = false;
    data = null;

    localStorage.clear();

    document.getElementById("welcome").innerHTML = "Non sei loggato";
    document.getElementById("username").innerHTML = "Accedi/registrati";

    window.location.href = "index.html";
  }
}

function Search() {
  let name = $(".src-input").val();

  window.location.href = `index.php?Name=${name}`;
}