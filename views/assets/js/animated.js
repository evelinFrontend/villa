$("#logOut").click(function () {
    console.log("salir");
    $.ajax({
        url: 'logOut',
        type: 'GET',
        success: function (success) {
            console.log(success);
            location.href = 'login'
        },
        error: function (err) {
            console.log(err);
        }
    });

})

function init() {
    $("#section-2-tab").hide();
    $("#section-3-tab").hide();
    $("#section-1").addClass('active');
}

$(".slide-item").click(function (e) {
    var id = e.currentTarget.id;
    switch (id) {
        case 'section-1':
            $("#section-1").addClass('active');
            $("#section-2").removeClass('active')
            $("#section-3").removeClass('active')
            $("#section-4").removeClass('active')
            $("#section-2-tab").hide();
            $("#section-3-tab").hide();
            $("#section-4-tab").hide();
            $("#section-1-tab").show();
            break;
        case 'section-2':
            $("#section-2").addClass('active')
            $("#section-3").removeClass('active')
            $("#section-1").removeClass('active')
            $("#section-4").removeClass('active')
            $("#section-2-tab").show();
            $("#section-1-tab").hide();
            $("#section-3-tab").hide();
            $("#section-4-tab").hide();
            break;
        case 'section-3':
            $("#section-3").addClass('active')
            $("#section-1").removeClass('active')
            $("#section-2").removeClass('active')
            $("#section-4").removeClass('active')
            $("#section-2-tab").hide();
            $("#section-1-tab").hide();
            $("#section-4-tab").hide();
            $("#section-3-tab").show();
            break;
        case 'section-4':
            $("#section-4").addClass('active')
            $("#section-3").removeClass('active')
            $("#section-2").removeClass('active')
            $("#section-1").removeClass('active')
            $("#section-2-tab").hide();
            $("#section-1-tab").hide();
            $("#section-3-tab").hide();
            $("#section-4-tab").show();
            break;
        default:
            $("#section-1-tab").show();
            $("#section-1").addClass('active');
            break;
    }
});

