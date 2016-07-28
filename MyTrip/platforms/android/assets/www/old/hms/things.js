var xhr = new XMLHttpRequest();
var dashboard;
var message = {};
var sequence = 0;
var aliasMap = {};

xhr.open("POST", settings.dashboardUrl, true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("Authorization", "Bearer " + getKey("dashboardToken"));

$(document).ready(function () {
        console.log("URL is ============> " + settings.dashboardUrl);
        console.log("Bearer " + getKey("dashboardToken"));

        if (getKey("dashboard") == null) {
            $.ajax({
                type: 'POST',
                dataType: "json",
                contentType: "application/json",
                url: settings.dashboardUrl,
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + getKey("dashboardToken")
                },
                success: function (data) {

                    if (data['status'] == "ATW-S1000") {
                        if (data["result"] == null) {
                            $.notify({
                                title: '<p class="text-center-notify">Dashboard is empty.</p>',
                                message: '<p class="text-center-notify">Please go to the wizard page to configure.</p>'
                            }, {
                                type: 'warning',
                                delay: '5000',
                                z_index: 1,
                                placement: {
                                    from: "bottom",
                                    align: "center"
                                },
                                animate: {
                                    enter: "animated fadeInUp",
                                    exit: "animated fadeOutDown"
                                }
                            });

                        } else {
                            setKey("dashboard", JSON.stringify(data["result"]));
                            init();
                        }
                    } else {
                        $.notify({
                            message: '<p class="text-center-notify">Internal error occurred. Try again Later.</p>'
                        }, {
                            type: 'danger',
                            delay: '500',
                            z_index: 1,
                            placement: {
                                from: "bottom",
                                align: "center"
                            },
                            animate: {
                                enter: "animated fadeInUp",
                                exit: "animated fadeOutDown"
                            }
                        });
                    }
                },
                error: function (err) {
                    console.log("An error Occurred====>" + err.toString());
                    $.notify({
                        message: '<p class="text-center-notify">Internal error occurred. Try again Later.</p>'
                    }, {
                        type: 'danger',
                        delay: '500',
                        z_index: 1,
                        placement: {
                            from: "bottom",
                            align: "center"
                        },
                        animate: {
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown"
                        }
                    });

                }
            });
        } else {
            init();
        }
    }
);


function init() {

    dashboard = getKey("dashboard");
    console.log("Receive dashboard json ===============> " + dashboard);
    var token = JSON.parse(dashboard).token;
    console.log("Receive token ============> " + token);
    var wsURL = "ws://gateway.appthing:9008/app?token=" + token;
    var wsConnector = new WebSocket(wsURL);

    wsConnector.onopen = function (event) {
        console.log("Open connection to " + wsURL);
    };

    wsConnector.onclose = function (event) {
        console.log("Closed connection to " + wsURL);
    };

    wsConnector.onmessage = function (event) {

        console.log("Received message " + event.data);
        var type = JSON.parse(event.data).type;

        if (type == "MSG_NTFY_REQ") {
            var content = JSON.parse(event.data).content;
            for (var i in content) {
                var command = content[i].value;
                var notification = command.split("-");
                var notificationValues = notification[1].split(" ");
                var id = notification[0] + "-" + notificationValues[0];
                var value = notificationValues[1];

                ntfySwitch(id, value);
                var msg = aliasMap[id] + " is turned " + (value == 1 ? "on" : "off");
                var icon = document.getElementById("icon").src;
                var tag = type;
                if (getKey("isChecked") === "true") {
                    displayNotification(msg, tag, icon);
                }
            }
        } else if (type == "MSG_COMM_RES") {
            var content = JSON.parse(event.data).content;
            for (var i in content) {
                var received = content[i].value;
                if (received.indexOf("SET") >= 0) {
                    var response = received.split("-");             // SET-SK101D1-0-0 0
                    var responseValue = response[3].split(" ");
                    var id = response[1] + "-" + response[2];
                    var value = responseValue[1] == 1 ? true : false;
                    var button = document.getElementById(id);
                    button.checked = value;
                    setKey(id, value);
                    $(button).attr('disabled', false);
                    $.notify({
                        message: '<p class="text-center-notify">Command executed successfully</p>'
                    }, {
                        type: 'info',
                        delay: '500',
                        z_index: 1,
                        placement: {
                            from: "bottom",
                            align: "center"
                        },
                        animate: {
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown"
                        }
                    });
                }
            }
        }
    };

    wsConnector.onerror = function (event) {
        console.log("Error connecting to " + wsURL);
        $.notify({
            message: '<p class="text-center-notify">Connection couldn\'t be established.Try again Later.</p>'
        }, {
            type: 'danger',
            delay: '1000',
            z_index: 1,
            placement: {
                from: "bottom",
                align: "center"
            },
            animate: {
                enter: "animated fadeInUp",
                exit: "animated fadeOutDown"
            }
        });
    };

    getDevices();

    //TODO: fix this iot device html generation

    $(".switch-input").click(function (event) {
        var switchId = event.target.id;
        var button = document.getElementById(switchId);
        var currentState = button.checked;
        setKey(switchId, currentState);
        $(button).attr('disabled', true);
        button.style.opacity = 0.5;
        window.setTimeout(reEnable, 3000, switchId, currentState);
        var cmd = "SET-" + switchId;
        console.log("switch clicked " + switchId);

        if (currentState) {
            cmd = cmd + "-" + 1;
        } else {
            cmd = cmd + "-" + 0;
        }
        console.log("Sending command " + cmd);
        sequence = sequence + 1;

        if (sequence >= 127) {
            sequence = 0;
        }
        console.log("dashboard" + dashboard);
        var sequenceNumber = "" + sequence;
        var origination = JSON.parse(dashboard).id;
        var destination = JSON.parse(dashboard).master;
        var message = {
            type: "MSG_COMM_REQ",
            version: "1.0",
            sequence: sequenceNumber,
            origination: origination,
            destination: destination,
            content: [{type: "DATA", value: cmd}]
        };
        console.log(message);
        wsConnector.send(JSON.stringify(message));
    });
    console.log(JSON.stringify(data));

}

function ntfySwitch(id, value) {
    var button = document.getElementById(id);
    console.log("toggling");

    if (value == 1) {
        button.checked = true;
    } else {
        button.checked = false;
    }
    setKey(id, button.checked);
    console.log("Button is " + value);
}

function displayNotification(message, tag, image) {
    var notify = new Notification(message, {icon: image, tag: tag});
    notify.onclick = function () {
        displayEvents(this);
    };
}
function displayEvents() {
    window.location.href = "./history.html";
}
function getDevices() {

    var tblString = '<table><tbody> ';
    var items = 1;
    var needToCloseTag = false;
    var slaves = JSON.parse(getKey("dashboard")).slaves;
    console.log("Getting slaves============> " + JSON.stringify(slaves));

    for (key in slaves) {
        if (key.indexOf("SK") >= 0) {
            var serial = key;
            var softSwitch = slaves[key];
            var ports = softSwitch["ports"];
            var mapping = softSwitch["mappings"];
            for (key in ports) {
                var id = serial + "-" + ports[key].split("-")[1];
                var linkedToComps = mapping[key].split("-");
                var linkedTo = linkedToComps[0];
                var linkedToPort = linkedToComps[1];
                var linkedSlave = slaves[linkedTo];
                var outputPort = parseInt(linkedToPort) + 1;
                var outputPortKey = "output-" + outputPort;
                var outputElementName = linkedSlave["mappings"][outputPortKey];
                var name = linkedSlave['name'] + " " + outputElementName;
                aliasMap[id] = name;
                // todo remove this switch and use the outputElementName directly to create img path once the images
                // todo .. and names are finalized
                var imageDiv;
                switch (outputElementName.split("-")[0]) {
                    case "Bulb":
                        imageDiv = '<div><img id="icon" src="./img/mobile/bulb.png"/></div>';
                        break;
                    case "TV":
                        imageDiv = '<div><img id="icon" src="./img/mobile/tv.png"/></div>';
                        break;
                    case "AC":
                        imageDiv = '<div><img id="icon" src="./img/mobile/common-bulb.png"/></div>';
                        break;
                    case "Music Player":
                        imageDiv = '<div><img id="icon" src="./img/mobile/music-player.png"/></div>';
                        break;
                    default:
                        imageDiv = '<div><img id="icon" src="./img/mobile/common-bulb.png"/></div>';
                        break;
                }
                if (items % 2 != 0) {
                    tblString += '<tr> ';
                    needToCloseTag = true;
                }
                tblString += '<td width="100">' +
                    imageDiv +
                    name +
                    '<label class="switch switch-flat" style="margin-left: auto; margin-right: auto ">'

                if (getKey(id) == "true") {
                    tblString += '<input  id="' + id + '" class="switch-input" type="checkbox" checked/>'
                } else {
                    tblString += '<input  id="' + id + '" class="switch-input" type="checkbox" />'
                }
                tblString += '<span class="switch-label" data-on="On" data-off="Off"></span>' +
                    '<span class="switch-handle"></span>' +
                    ' </label>' +
                    '</td>'

                if (items % 2 == 0) {
                    tblString += '</tr>';
                    needToCloseTag = false;
                }
                items += 1;
            }
        }
    }
    tblString = tblString + '</tbody> </table>';
    $('.iot-devices').html(tblString);
    window.localStorage.setItem("aliasMap", JSON.stringify(aliasMap));
}

function reEnable(switchId, currentState) {
    var button = document.getElementById(switchId);
    if ($(button).attr('disabled')) {
        $(button).attr('disabled', false);
        button.style.opacity = 1;
        button.checked = !currentState;
        setKey(switchId, !currentState);
        console.log("ReEnabled" + switchId);
        $.notify({
            message: '<p class="text-center-notify">Command execution Failed</p>'
        }, {
            type: 'danger',
            delay: '500',
            z_index: 1,
            placement: {
                from: "bottom",
                align: "center"
            },
            animate: {
                enter: "animated fadeInUp",
                exit: "animated fadeOutDown"
            }
        });
    }
}





