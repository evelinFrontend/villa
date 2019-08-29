function init() {
    $("#section-2-tab").hide();
    $("#section-3-tab").hide();
}

$(".slide-item").click(function(e){
    var id = e.currentTarget.id;
    switch (id) {
        case 'section-1':
            $("#section-2-tab").hide();
            $("#section-3-tab").hide();
            $("#section-1-tab").show();
            break;
        case 'section-2':
            $("#section-2-tab").show();
            $("#section-1-tab").hide();
            $("#section-3-tab").hide();
            break;
        case 'section-3':
            $("#section-2-tab").hide();
            $("#section-1-tab").hide();
            $("#section-3-tab").show();
            break;
        default:
            $("#section-1-tab").show();
            break;
    }    
});