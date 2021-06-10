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

    var title = $("#title").val();
    var description = $("#description").val();

    $.ajax({
        type: "POST",
        url: "../../Helper.php",
        data: {
        "insert": "insert",
        "title": title,
        "description": description
        },
        success: function(data) {
            alert("SUCESS!");
            top.location.href = '/';
        },
        error: function(result) {
            alert('error');
        }
    });
});

$(".update").click(function(e) {
    e.preventDefault();

    var id = $(this).data("custom-value");

    $.ajax({
        type: "POST",
        url: "../../Helper.php",
        data: {
            "update": "update",
            "id": id
        },
        success: function(data) {
            $("p").html(data);
        },
        error: function(result) {
            alert('error');
        }
    });
});

$(".delete").click(function(e) {
    e.preventDefault();

    var id = $(this).data("custom-value");
    var confirmation = confirm("are you sure you want to remove the item?");

    if (confirmation) {
        $.ajax({
            type: "POST",
            url: "../../Helper.php",
            data: {
                "delete": "delete",
                "id": id
            },
            success: function(data) {
                if(data){ // if true (1)
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            },
            error: function(result) {
                alert('error');
            }
        });
        alert('removed');
    }

});

$("#saveUpdate").click(function(e) {
    e.preventDefault();

    var id = $('#title').data("custom-value");
    var title = $("#title").val();
    var description = $("#description").val();

    $.ajax({
        type: "POST",
        url: "../../Helper.php",
        data: {
            "saveUpdate": "saveUpdate",
            "id": id,
            "title": title,
            "description": description
        },
        success: function(data) {
            if(data){
                setTimeout(function() {
                    location.reload();
                }, 500);
            }
        },
        error: function(result) {
            alert('error');
        }
    });
});
