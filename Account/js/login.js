var logged = false;
var data = null;

function Login() {
  $.ajax({
    type: "post",
    url: "php/login.php",
    data: $("form").serialize(),
    success: function (response) {
      
      console.log(response);
      if (response) {
        logged = true;
        data = response;

        localStorage.setItem("logged", true);
        localStorage.setItem("data", data);  

        window.location.href = "../Shop/index.php";
      } else {
        logged = false;
        data = null;
        
        localStorage.clear();

        alert("Password errata!");
        window.location.href = "login.html";
      }
    },
  });
}