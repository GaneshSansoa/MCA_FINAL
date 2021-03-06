var books = require("google-books-search");
var resIndex;
var res = {};
var articleRes = {};
$("#book").on("keyup", function () {
  //console.log(event.keyCode);
  //console.log("repeating");
  switch (event.keyCode) {
    case 13:
      break;
    case 40:
      break;
    case 38:
      break;
    case 37:
      break;
    case 39:
      break;
    default:
      var keyword = $("#book").val();
      console.log(keyword);
      var options = {
        limit: 5,
        type: "books",
        order: "relevance",
        lang: "en",
      };
      books.search(keyword, options, function (error, results) {
        if (!error) {
          res = results;
          $(".results").css("display", "block");
          html = "";
          for (var i = 0; i < results.length; i++) {
            if (i === 0) {
              html +=
                '<li class="list-group-item active" data-result=' +
                i +
                ">" +
                results[i]["title"] +
                "</li>";
            } else {
              html +=
                '<li class="list-group-item" data-result=' +
                i +
                ">" +
                results[i]["title"] +
                "</li>";
            }
          }
          $(".results ul").html(html);
          $("#books").html('<option value="' + results[0]["title"] + '">');
          // console.log(results.length);

          $(".results ul li").on("click", function () {
            resIndex = $(this).data("result");
            console.log(resIndex);
            $("#book").val(results[resIndex]["title"]);
            $(".results").css("display", "none");
          });
        } else {
          //		$(".results ul").html('<li>'+error+'</li>');
          $(".results").css("display", "none");
        }
      });
      break;
  }
});
const firstIndex = $(".looping_element")
  .find(".list-group-item")
  .first()
  .index();
const lastIndex = $(".looping_element").find(".list-group-item").last().index();
console.log(firstIndex);
console.log(lastIndex);

$("#book").on("keydown", function (e) {
  // console.log("key down");
  var index = $(".looping_element").find(".active").index();

  console.log(index);
  console.log("keydown during focus");
  switch (e.keyCode) {
    case 40:
      index = index == lastIndex ? 0 : index + 1;
      console.log(index);
      break;
    case 38:
      index = index == firstIndex ? lastIndex : index - 1;
      console.log(index);
      break;
    case 13:
      console.log(index);
      resIndex = $(".looping_element").find(".active").data("result");
      console.log(resIndex);
      $("#book").val(res[resIndex]["title"]);
      $(".results").css("display", "none");
      break;
  }
  $(".looping_element").find(".active").removeClass("active");
  $(".looping_element")
    .find(".list-group-item:eq( " + index + " )")
    .addClass("active");
});

$("#sb").on("click", function () {
  console.log(res[resIndex]);
  // function redirectPost(url, data) {
  // 	var form = document.createElement('form');
  // 	document.body.appendChild(form);
  // 	form.method = 'post';
  // 	form.action = url;
  // 	for (var name in data) {
  // 		var input = document.createElement('input');
  // 		input.type = 'hidden';
  // 		input.name = name;
  // 		input.value = data[name];
  // 		form.appendChild(input);
  // 	}
  // 	form.submit();
  // }
  // $.extend(res[resIndex],{
  // 	type: 'book'
  // })
  $.redirect("cite-book.php", { data: JSON.stringify(res[resIndex]) });
  // data = {
  // 	title: res[resIndex],

  // }
  // $.ajax({
  // 	url:"test",
  // 	type:'post',
  // 	data:data,

  // 	success:function(){

  // 	}
  // });
});

//Article Api
var artIndex;
var artRes = {};
var artSearchType = $("#article-search-type option:selected").val();
$("#article-search-type").on("change", function () {
  artSearchType = $("#article-search-type option:selected").val();
  if (artSearchType == "keyword") {
    $("#article").attr("placeholder", "Enter Article Title");
  } else {
    $("#article").attr("placeholder", "Enter DOI URL");
  }

  //		alert(artSearchType);
});
$("#article").on("keyup", function () {
  switch (event.keyCode) {
    case 13:
      break;
    case 40:
      break;
    case 38:
      break;
    case 37:
      break;
    case 39:
      break;
    default:
      var keyword = $("#article").val();
      //alert(artSearchType);
      var flickerAPI;
      if (artSearchType == "keyword") {
        flickerAPI =
          "http://api.springernature.com/meta/v2/json?q=keyword:" +
          keyword +
          "&api_key=e741be7fcb7d54b75ad4b3e775f3f39c&p=5";
      } else {
        var el = document.createElement("a");
        el.href = keyword;
        //Extracting DOI from Doi.org URL
        flickerAPI =
          "http://api.springernature.com/meta/v2/json?q=doi:" +
          el.pathname.slice(1) +
          "&api_key=e741be7fcb7d54b75ad4b3e775f3f39c&p=5";
      }

      //$.support.cors = true;
      $.ajax({
        url: flickerAPI,
        crossOrigin: true,
        crossDomain: true,
        //dataType:'xml',
        success: function (results) {
          console.log(results);
          if (results.records == 0) {
            $(".article-results").css("display", "block");
            html = "";
            html += "<li>Nothing Found</li>";
            $(".article-results ul").html(html);
          } else {
            artRes = results.records;
            $(".article-results").css("display", "block");

            html = "";
            for (var i = 0; i < results["records"].length; i++) {
              if (i == 0) {
                html +=
                  '<li class="list-group-item active" data-result=' +
                  i +
                  ">" +
                  results["records"][i]["title"] +
                  "</li>";
              } else {
                html +=
                  '<li class="list-group-item" data-result=' +
                  i +
                  ">" +
                  results["records"][i]["title"] +
                  "</li>";
              }
            }
            $(".article-results ul").html(html);
            //						$("#books").html('<option value="'+results[0]['title']+'">');
            console.log(results.length);
            $(".article-results ul li").on("click", function () {
              artIndex = $(this).data("result");
              console.log(artIndex);
              $("#article").val(results["records"][artIndex]["title"]);
              $(".article-results").css("display", "none");
            });
          }
          if (keyword == "") {
            $(".article-results").css("display", "none");
          }
          //console.log(data);
        },
      });
      break;
  }
});
const articleFirstIndex = $(".article_looping_element")
  .find(".list-group-item")
  .first()
  .index();
const articleLastIndex = $(".article_looping_element")
  .find(".list-group-item")
  .last()
  .index();

$("#article").on("keydown", function (e) {
  // console.log("key down");
  var index = $(".article_looping_element").find(".active").index();

  console.log(index);
  console.log("keydown during focus");
  switch (e.keyCode) {
    case 40:
      index = index == articleLastIndex ? 0 : index + 1;
      console.log(index);
      break;
    case 38:
      index = index == articleFirstIndex ? articleLastIndex : index - 1;
      console.log(index);
      break;
    case 13:
      console.log(index);
      artIndex = $(".article_looping_element").find(".active").data("result");
      console.log(artRes);
      $("#article").val(artRes[artIndex]["title"]);
      $(".article-results").css("display", "none");
      break;
  }
  $(".article_looping_element").find(".active").removeClass("active");
  $(".article_looping_element")
    .find(".list-group-item:eq( " + index + " )")
    .addClass("active");
});
$("#sb-article").on("click", function () {
  // var datax = artRes[artIndex];
  console.log(artRes[artIndex]);
  $.redirect("cite-article.php", { data: JSON.stringify(artRes[artIndex]) });
});

//Signup Function
$("#signup_form").submit(function () {
  var checkUser = ValidateUserName($("#username"), "Empty Username");
  var checkEmail = ValidateEmail($("#email"), "Invalid Email");
  var checkPass = ValidatePassword(
    $("#password"),
    "At least 6 characters, one number, one lowercase and one uppercase letter"
  );
  var checkRePass = VaildateRePassword(
    $("#password"),
    $("#re-password"),
    "Password Doesnt Matched"
  );
  console.log(checkUser);
  console.log(checkEmail);
  console.log(checkPass);
  console.log(checkRePass);
  if (
    checkEmail == true &&
    checkUser == true &&
    checkPass == true &&
    checkRePass == true
  ) {
    //alert("Valid");

    $.ajax({
      url: "signup_attempt.php",
      type: "POST",
      dataType: "json",
      data: $("#signup_form").serialize(),
      success: function (res) {
        //		alert(res);
        console.log(res);
        if (res.response.username == true) {
          FormErrorStyle($("#username"), "Username Already Exists!");
        }
        if (res.response.email == true) {
          FormErrorStyle($("#email"), "Email Already Exists!");
        }
        if (res.response.status == "success") {
          // alert("yo");
          $("#signup_form").trigger("reset");
          FormReset($("#signup_form"));

          $(".bs-example-modal-sm")
            .find(".modal-body")
            .html("Verification email has been sent to " + res.response.email);
          $(".bs-example-modal-sm").modal("show");
        }
      },
    });
  }

  //ValidateUserName($("#username"),"Empty Username");
  //ValidateEmail($("#email"),"Invalid Email");
  //ValidatePassword($("#password"),$("#re-password"),"At least 6 characters, one number, one lowercase and one uppercase letter");
  //alert("validate it");
  //		console.log($("#email").prev());
  //		emailPrev = $("#email").prev();
  //	console.log(emailPrev.children());
});
// $("#username").keyup(function(){
// 	ValidateUserName($("#username"),"Empty Username");
// });
// $("#email").keyup(function(){
// 	ValidateEmail($("#email"),"Invalid Email");
// })
// $("#password").keyup(function(){
// 	ValidatePassword($("#password"),"At least 6 characters, one number, one lowercase and one uppercase letter");
// });
// $("#re-password").keyup(function(){
// 	VaildateRePassword($("#password"),$("#re-password"),"Password Doesnt Matched");
// });

//validators
function ValidateUserName(InputID, CustomMsg) {
  if (InputID.val() == "") {
    FormErrorStyle(InputID, CustomMsg);
    return false;
  } else if (InputID.val().length < 6) {
    FormErrorStyle(InputID, "Username must be at least 6 characters");
    return false;
  } else {
    var myValid = false;
    $.ajax({
      async: false,
      url: "signup_attempt.php",
      type: "POST",
      dataType: "json",
      data: {
        type: "userValidate",
        username: InputID.val(),
      },
      success: function (res) {
        if (res.username == true) {
          FormErrorStyle($("#username"), "Username Already Exists!");
          // return false;
        } else {
          FormSuccessStyle(InputID);
          myValid = true;
        }
      },
    });
    //			alert(myValid);
    return myValid;
  }
}
function ValidateEmail(EmailID, CustomMsg) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var email = EmailID.val();
  //		 console.log(re.test(email));
  if (re.test(email)) {
    var isValid = false;
    $.ajax({
      async: false,
      url: "signup_attempt.php",
      type: "POST",
      dataType: "json",
      data: {
        type: "emailValidate",
        email: EmailID.val(),
      },
      success: function (res) {
        if (res.email == true) {
          FormErrorStyle($("#email"), "Email Already Exists!");
          //						return false;
        } else {
          FormSuccessStyle(EmailID);
          isValid = true;
        }
      },
    });
    // FormSuccessStyle(EmailID);
    return isValid;
  } else {
    FormErrorStyle(EmailID, CustomMsg);
    return false;
  }
}
function ValidatePassword(PasswordID, CustomMsg) {
  var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
  if (PasswordID.val() == "") {
    FormErrorStyle(PasswordID, CustomMsg);
    return false;
  } else if (!re.test(PasswordID.val())) {
    FormErrorStyle(PasswordID, CustomMsg);
    return false;
  } else {
    FormSuccessStyle(PasswordID);
    return true;
  }
}
function ValidateOldPassword(PasswordID, CustomMsg) {
  var oldPassword = PasswordID.val();
  var returnVal;
  $.ajax({
    async: false,
    url: "../dashboard/user_actions.php",
    type: "POST",
    dataType: "json",
    data: {
      type: "old-password-check",
      oldPassword: oldPassword,
    },
    success: function (res) {
      if (res.status == "success") {
        FormSuccessStyle(PasswordID);
        returnVal = true;
      } else {
        FormErrorStyle(PasswordID, CustomMsg);
        returnVal = false;
      }
    },
  });
  return returnVal;
}
function VaildateRePassword(PasswordID, RePasswordID, CustomMsg) {
  if (RePasswordID.val() == "") {
    FormErrorStyle(RePasswordID, "Empty Field");
    return false;
  } else if (RePasswordID.val() == PasswordID.val()) {
    FormSuccessStyle(RePasswordID);
    return true;
  } else {
    FormErrorStyle(RePasswordID, "Password Doesn't Matched");
    return false;
  }
}

function FormSuccessStyle(ID) {
  ID.addClass("form-success");
  ID.removeClass("form-error");
  ID.attr("data-content", "<span class='material-icons'>check_circle</span>");
  ID.popover("show");
  ID.prev().children().addClass("form-text-success");
  ID.prev().children().removeClass("form-text-error");
}
function FormErrorStyle(ID, Msg) {
  ID.addClass("form-error");
  ID.removeClass("form-success");
  ID.attr("data-content", Msg);
  ID.popover("show");
  ID.prev().children().addClass("form-text-error");
  ID.prev().children().removeClass("form-text-success");
}
function FormReset(FormID) {
  var inputs = FormID.find("input");
  FormID.find("input").popover("hide");
  FormID.find("input").prev().children().removeClass("form-text-success");
  FormID.find("input").removeClass("form-success");
}

//Login Form
$("#login_form").on("submit", function () {
  $.ajax({
    url: "login_attempt.php",
    type: "POST",
    dataType: "json",
    data: $("#login_form").serialize(),
    success: function (res) {
      console.log(res);
      if (res.status == "error") {
        $("#login_form")
          .find("input")
          .prev()
          .children()
          .addClass("form-text-error");
        $("#login_form").find("input").addClass("form-error");
        $("#login_form").find(".form-control-feedback").show();
        $("#login_form").find(".form-control-feedback").html(res.type);

        setTimeout(() => {
          $("#login_form").find(".form-control-feedback").hide();
        }, 5000);
      }
      if (res.status == "success") {
        $("#login_form")
          .find("input")
          .prev()
          .children()
          .removeClass("form-text-error");
        $("#login_form")
          .find("input")
          .prev()
          .children()
          .addClass("form-text-success");
        $("#login_form").find("input").removeClass("form-error");
        $("#login_form").find("input").addClass("form-success");
        //localStorage.token = res.token;
        // console.log(localStorage.token);
        window.location = "dashboard";
      }
    },
  });
});
//Change Password Form
$("#change-password-form").submit(function () {
  var oldPass = ValidateOldPassword($("#old-password"), "Wrong Password");
  var checkPass = ValidatePassword(
    $("#new-password"),
    "At least 6 characters, one number, one lowercase and one uppercase letter"
  );
  var checkRePass = VaildateRePassword(
    $("#new-password"),
    $("#renew-password"),
    "Password Doesnt Matched"
  );
  console.log(oldPass);
  console.log(checkPass);
  console.log(checkRePass);
  if (oldPass == true && checkPass == true && checkRePass == true) {
    var newPassword = $("#new-password").val();
    $.ajax({
      url: "../dashboard/user_actions.php",
      type: "POST",
      dataType: "json",
      data: {
        type: "change-password",
        newPassword: newPassword,
      },
      success: function (res) {
        if (res.status == "success") {
          $("#change-password-form").trigger("reset");

          $(".password-validation-msg").removeClass("invalid-feedback");
          $(".password-validation-msg").addClass("valid-feedback");
          $(".password-validation-msg").html("Password Changed Successfully");
          $(".password-validation-msg").show();
          $("#change-password-form").find("input").removeClass("form-success");
          $("#change-password-form").find("input").popover("hide");
        } else {
        }
      },
    });
  }
});

var rellax = new Rellax(".rellax");

$(document).ready(function () {
  var a = 0;
  $("#logout").click(function () {
    $.ajax({
      url: "/my-project/logout.php",
      type: "POST",
      dataType: "json",
      success: function (res) {
        // alert(res.status);
        if (res.status == "success") {
          window.location = "/my-project/";
        }
      },
    });
  });
  var clipboard = new ClipboardJS("#copy");

  clipboard.on("success", function (e) {
    $("#copy-alert").html("copied");
    setInterval(function () {
      $("#copy-alert").html("copy");
    }, 3000);
  });

  clipboard.on("error", function (e) {
    $("#copy-alert").html("Error Copying");
  });
});
