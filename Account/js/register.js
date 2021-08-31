var logged = false;
var data = null;

function Register() {
  if (!CheckPassword()) {
    alert("Password does not match!");
    window.location.href = "register.html";
    return;
  }

  $.ajax({
    type: "post",
    url: "php/register.php",
    data: $("form").serialize(),
    success: function (response) {
      if (response) {
        logged = true;
        data = response;

        localStorage.setItem("logged", logged);
        localStorage.setItem("data", data);

        window.location.href = "../Shop/index.php";
      } else {
        logged = false;
        data = null;
        
        localStorage.clear();

        alert("Errore nella registrazione!");
        window.location.href = "register.html";
      }
    },
  });
}

//Funzione per controllare l'input
function CheckPassword() {
  //Ottenimento reference del form
  let form = document.getElementById("form");

  //Ottenimento password inserite
  password1 = form.password1.value;
  password2 = form.password2.value;

  //Controllo password
  if (password1.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/)) {
    if (password1 != password2) {
      //Password non combaciano
      SwapColor(false);
      return false;
    } else {
      //Password combaciano
      SwapColor(true);
      return true;
    }
  } else {
    let error = "Password written is not valid";

    if (password1 == form.username.value) {
      error = "Password must be different from username!";
      SwapColor(false, error);
      return false;
    }

    let re = /[0-9]/;

    if (!re.test(password1)) {
      error = "Password must contain at least one number (0-9)!";
      SwapColor(false, error);
      return false;
    }

    re = /[a-z]/;

    if (!re.test(password1)) {
      error = "Password must contain at least one lowercase letter (a-z)!";
      SwapColor(false, error);
      return false;
    }

    re = /[A-Z]/;

    if (!re.test(password1)) {
      error = "Password must contain at least one uppercase letter (A-Z)!";
      SwapColor(false, error);
      return false;
    }
  }
}

//Funzione per cambiare lo stile
function SwapColor(mode, text = "Password does not match") {
  if (mode == false) {
    //Cambio lo stile ad errato
    document.getElementById("wrong").style.display = "block";
    document.getElementById("password2").classList.add("wrong-form");
    document.getElementById("wrong-txt").classList.add("wrong-txt");
  } else {
    //Cambio lo stile a corretto
    document.getElementById("wrong").style.display = "none";
    document.getElementById("password2").classList.remove("wrong-form");
    document.getElementById("wrong-txt").classList.remove("wrong-txt");
  }

  document.getElementById("wrong").innerHTML = text;
}