document.forms[0].onsubmit = () => {
  //Regular Expressions for the form inputs
  let emailRegEx =
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  let passwordRegEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; //Minimum eight characters, at least one letter and one number.

  //Form inputs values
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  //Test values for the RegEx
  let resEmail = emailRegEx.test(email);
  let resPass = passwordRegEx.test(password);

  //Validations
  if (password == "admin" && email == "admin") {
    return true;
  } else if (!resEmail || email == "") {
    document.getElementById("wrongEmail").innerHTML =
      "Por favor, entre com um e-mail válido.";
    setTimeout(() => {
      document.getElementById("wrongEmail").innerHTML = "";
    }, 3000);
    return false;
  } else if (!resPass || password == "") {
    document.getElementById("wrongPass").innerHTML =
      "Por Favor, entre com uma senha válida. A senha deve conter pelo menos oito caracteres e pelo menos uma letra e um número.";
    setTimeout(() => {
      document.getElementById("wrongPass").innerHTML = "";
    }, 3000);
    return false;
  } else {
    return true;
  }
};
