var baseUrl = "http://wizard.appthing:9014/application-api/v1";

var settings = {
    authenticateUrl: baseUrl + "/user/authenticate",
    dashboardUrl: baseUrl + "/dashboard",
    eventUrl: baseUrl + "/dashboard/events"
};

var messages = {
    emptyCredentials: "Username or Password cannot be empty",
    internalError: "Internal Error occurred",
    invalidCredentials: "Invalid UserName or Password",
    networkFailure: "Network failure"
};

function getKey(key) {
    return window.localStorage.getItem(key);
}

function setKey(key, value) {
    window.localStorage.setItem(key, value);
}

function clearKey(key) {
    window.localStorage.removeItem(key);
}

function notificationHandler(checkbox) {
    var isChecked;
    if (checkbox.checked) {
        isChecked = true;
        setKey("isChecked", isChecked);
        console.log("Active notification==========> " + getKey("isChecked"));
    } else {
        clearKey("isChecked");
        isChecked = false;
        setKey("isChecked", isChecked);
        console.log("De active notification==========> " + getKey("isChecked"));
    }
}

$("#logout").click(function (e) {
    console.log("===Successfully logout from the dashboard====");
    clearKey("dashboardToken");
    clearKey("isChecked");
    window.location.href = "./index.html";
    e.preventDefault();
});

$('#username').focus(function () {
    if ($('#username').val() == "") {
        $('#username').val(getKey("username"));
    }
    if ($('#password').val() == "") {
        $('#password').val(getKey("password"));
    }
});

$('#login').on('click', function (e) {

    e.preventDefault();
    document.getElementById("loginSpinner").style.visibility = "visible";
    console.log("Token received for dashboard for url ==========> " + settings.authenticateUrl);
    var username = $("#username").val();
    var password = $("#password").val();

    var authReq = {username: username, password: password};

    $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: settings.authenticateUrl,
        data: JSON.stringify(authReq),
        success: function (data) {
            document.getElementById("loginSpinner").style.visibility = "hidden";
            if (username == "" || password == "") {
                var emptyValues = messages.emptyCredentials;
                $('#errorDiv').html(emptyValues);
                document.getElementById("errorDiv").style.visibility = "visible";
            }
            else {
                if (data != null && data != "") {
                    if (data["description"] == "Internal Error" || data["result"] == null) {
                        document.getElementById("loginSpinner").style.visibility = "hidden";
                        console.log("===========Internal Error occurred=========");
                        var internalError = messages.internalError;
                        $('#errorDiv').html(internalError);
                        document.getElementById("errorDiv").style.visibility = "visible";

                    } else if (data["result"] == "Invalid Username/Password") {
                        document.getElementById("loginSpinner").style.visibility = "hidden";
                        console.log("============Invalid Username or password=============");
                        var invalidValues = messages.invalidCredentials;
                        $('#errorDiv').html(invalidValues);
                        document.getElementById("errorDiv").style.visibility = "visible";
                    }
                    else {
                        document.getElementById("loginSpinner").style.visibility = "hidden";
                        document.getElementById("errorDiv").style.visibility = "hidden";
                        console.log("Successfully login with token ============ " + data["result"]);
                        clearKey("dashboard");
                        setKey("dashboardToken", data["result"]);
                        setKey("username", username);
                        setKey("password", password);
                        window.location.href = "./things-loading.html";
                    }
                }

            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {

            document.getElementById("loginSpinner").style.visibility = "hidden";
            document.getElementById("errorDiv").style.visibility = "visible";
            var networkError = messages.networkFailure;
            $('#errorDiv').html(networkError);
        }
    });


});







