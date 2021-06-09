// create modal

$("#listTasks").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../Helper.php",
        data: { "list": "list"},
        success: function(data) {
            $("p").html(data);
        },
        error: function(result) {
            alert('error');
        }
    });
});

$("#createTasks").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../Helper.php",
        data: { "create": "create"},
        success: function(data) {
            $("p").html(data);
        },
        error: function(result) {
            alert('error');
        }
    });
});

$("#insert").click(function(e) {
    e.preventDefault();
    var title = $("#title");
    var description = $("#description");

    $.ajax({
        type: "POST",
        url: "../../Helper.php",
        data: {
        "insert": "insert",
        title: title,
        description: description},
        success: function(data) {
            $("p").html(data);
        },
        error: function(result) {
            alert('error');
        }
    });
});
