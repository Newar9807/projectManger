const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
const registerStd = document.querySelector("#signupstd");
const registerTec = document.querySelector("#teacherReg");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
  document.getElementById("stdClass").style.display = "block";
  resetForms();
});

sign_in_btn.addEventListener("click", () => {
  sign_in_clicked();
});

var state = false;

function toggle(element) {
  if (state) {
    element.nextElementSibling.setAttribute("type", "password");
    element.style.color = "#7a797e";
    state = false;
  } else {
    element.nextElementSibling.setAttribute("type", "text");
    element.style.color = "#5887ef";
    state = true;
  }
}

function btnFunction() {
  document.getElementById("signupstd").style.display = "block";
  document.getElementById("stdClass").style.display = "none";
  document.querySelector("#stdProgram").selectedIndex = "0";
}

function teacherFunction() {
  document.getElementById("teacherReg").style.display = "block";
  document.getElementById("stdClass").style.display = "none";
  // document.getElementById("").style.display = "none";
}

$(document).ready(function () {
  $("#studentRegister").submit(function (e) {
    e.preventDefault();
    var success = $("#signupstd .successTrack").length;
    if (success == 8) {
      var nam = $("#stdFirstName").val() + " " + $("#stdLastName").val(),
        faculty = $("#stdFaculty").find(":selected").attr("data-name"),
        program = $("#stdProgram").val(),
        phone = $("#stdPhone").val(),
        email = $("#stdEmail").val(),
        password = $("#stdPassword").val(),
        confirmPassword = $("#stdConfirmPassword").val();
      console.log(program);

      $.post(
        "php/tempFunction/register.php",
        {
          name: nam,
          faculty: faculty,
          program: program,
          phone: phone,
          email: email,
          password: password,
        },
        function (response) {
          $("#newTxt").html(response).addClass("successColor");

          var tmpTime = setTimeout(function () {
            $("#newTxt").html("").removeClass("successColor");
            clearTimeout(tmpTime);
          }, 5000);

          sign_in_clicked();
          resetForms();
        }
      );
    } else {
      $("#stdComment").html("All fields requirements are not fulfilled!!");
      var tmpTime = setTimeout(function () {
        $("#stdComment").html("");
        clearTimeout(tmpTime);
      }, 5000);
    }
  });

  $("#teacherRegister").submit(function (e) {
    e.preventDefault();
    var success = $("#teacherReg .successTrack").length;
    if (success == 7) {
      var nam = $("#tecFirstName").val() + " " + $("#tecLastName").val(),
        faculty = $("#tecFaculty").find(":selected").attr("data-name"),
        phone = $("#tecPhone").val(),
        email = $("#tecEmail").val(),
        password = $("#tecPassword").val(),
        confirmPassword = $("#tecConfirmPassword").val();

      $.post(
        "php/tempFunction/register.php",
        {
          name: nam,
          faculty: faculty,
          phone: phone,
          email: email,
          password: password,
        },
        function (response) {
          $("#newTxt").html(response).addClass("successColor");

          var tmpTime = setTimeout(function () {
            $("#newTxt").html("").removeClass("successColor");
            clearTimeout(tmpTime);
          }, 5000);

          sign_in_clicked();
          resetForms();
        }
      );
    } else {
      $("#tecComment").html("All fields requirements are not fulfilled!!");
      var tmpTime = setTimeout(function () {
        $("#tecComment").html("");
        clearTimeout(tmpTime);
      }, 5000);
    }
  });

  $("#signInForm").submit(function (e) {
    e.preventDefault();
    var email = $("#userEmail").val(),
      password = $("#userPassword").val();

    $.post(
      "php/tempFunction/signin.php",
      {
        email: email,
        password: password,
      },
      function (response) {
        response = JSON.parse(response);
        console.log(response[0]);
        if (response[0] == "emailError") {
          $(".emailDiv").addClass("errorTrack");
          $(".passwordDiv").addClass("errorTrack");
          var tmpTime = setTimeout(function () {
            $(".emailDiv").removeClass("errorTrack");
            $(".passwordDiv").removeClass("successTrack");
            clearTimeout(tmpTime);
          }, 6000);
        } else if (response[0] == "passwordError") {
          $(".emailDiv").addClass("successTrack");
          $(".passwordDiv").addClass("errorTrack");
          var tmpTime = setTimeout(function () {
            $(".emailDiv").removeClass("successTrack");
            $(".passwordDiv").removeClass("errorTrack");
            clearTimeout(tmpTime);
          }, 6000);
        } else if (response[0] == "success") {
          if (response[2] == "Teacher") {
            window.location = "php/teacherDashboard.php?id="+response[1];
          } else if (response[2] == "Student") {
            window.location = "php/studentForm.php?id="+response[1];
          }
        }
      }
    );
  });

  $("#stdFaculty").change(function () {
    var facultyId = $(this).val();
    $.post(
      "php/tempFunction/fetchProgram.php",
      {
        facultyId: facultyId,
      },
      function (response) {
        response = JSON.parse(response);
        var htm = "<option value='' disabled>Program</option>";
        Object.keys(response).forEach(function (key, index) {
          htm += `<option value="${key}">${response[key]}</option>`;
        });
        $("#stdProgram").children("option").remove();
        $("#stdProgram").append(htm);
        document.querySelector("#stdProgram").selectedIndex = "0";
      }
    );
    $(this).parent().addClass("successTrack");
    // if ($(this).val() == "1") {
    //   programScienceAndTechnotogy();
    // }
  });

  $("#stdProgram, #tecFaculty").change(function () {
    $(this).parent().addClass("successTrack");
  });
});

function fetchAvailableFaculty(role) {
  $.post("php/tempFunction/fetchFaculty.php", {}, function (response) {
    response = JSON.parse(response);
    var htm = "<option value='' disabled>Faculty</option>";
    Object.keys(response).forEach(function (key, index) {
      htm += `<option value="${key}" data-name="${response[key]}">${response[key]}</option>`;
    });
    if (role == "1") {
      $("#tecFaculty").children("option").remove();
      $("#tecFaculty").append(htm);
      document.querySelector("#tecFaculty").selectedIndex = "0";
    } else if (role == "2") {
      $("#stdFaculty").children("option").remove();
      $("#stdFaculty").append(htm);
      document.querySelector("#stdFaculty").selectedIndex = "0";
    }
  });
}

function sign_in_clicked() {
  container.classList.remove("sign-up-mode");
  registerStd.style.display = "none";
  registerTec.style.display = "none";
}

function resetForms() {
  $("#studentRegister").trigger("reset");
  $("#teacherRegister").trigger("reset");
  $("#signInForm").trigger("reset");
  $(".fa-eye").removeAttr("style");
  $(".successTrack").removeClass("successTrack");
  $(".errorTrack").removeClass("errorTrack");
  $(".comments").html("");
}

function validate(ele) {
  var regExpression = /[]/;
  if (ele.type == "text") {
    regExpression = /^[A-Z]{2,}$/i;
  } else if (ele.type == "password") {
    ele.previousElementSibling.style.color = "#7a797e";
    regExpression =
      /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,32})/;
  } else if (ele.type == "email") {
    regExpression = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  } else if (ele.type == "number") {
    regExpression = /^9\d{9}$/;
  }
  if (ele.value.match(regExpression)) {
    ele.parentElement.classList.add("successTrack");
    ele.parentElement.classList.remove("errorTrack");
    const pass =
      ele.parentElement.previousElementSibling.lastElementChild.value;
    if (
      ele.placeholder == "Confirm Password" &&
      pass != ele.value &&
      pass != ""
    ) {
      ele.parentElement.classList.add("errorTrack");
      ele.parentElement.classList.remove("successTrack");
    }
    $(ele).parent().siblings(".comments").html("");
  } else {
    if (ele.placeholder == "Password") {
      $(ele)
        .parent()
        .siblings(".comments")
        .html(
          "Password must contain at least 8-32 characters including number, special character, upper and lowercase"
        );
      var tmpTime = setTimeout(function () {
        $(ele).parent().siblings(".comments").html("");
        clearTimeout(tmpTime);
      }, 5000);
    }
    ele.parentElement.classList.add("errorTrack");
    ele.parentElement.classList.remove("successTrack");
  }
}
