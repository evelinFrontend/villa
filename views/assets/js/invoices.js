$(document).ready(function() {
    $('#table-search-invoices').DataTable();
} );
$("#select-option").change(function(e) {
  const value =  $(this).val();
  if ( value === "range") {
      $('.range').show();
      $(".number").hide()
    } else if (value === "number") {
        $(".number").show()
        $('.range').hide();
  }
});
$("#form-search-invoice").submit(function(e) {
    e.preventDefault(); 
    var data = []
    const value = $("#select-option").val();
    if (value === "range") {
        data.push({
            "init": $("#date-init").val(),
            "finish" : $("#date-finish").val()
        })   
    } else if (value === "number") {
        data.push({"number":  $("#number-invoice").val()})
    }
    $.ajax({
        url: actionurl,
        type: 'POST',
        dataType: 'json',
        data: ({}),
        success: function(response) {
            
        },
        error: {

        }
    });    
});

$("#config-invoce").submit(function(e){
    e.preventDefault();
    var data = [];
    data.push({
        "prefix": $("#prefix").val(),
        "resolution": $("#resolution").val(),
        "nit": $("#nit").val(),
        "business-name": $("#business-name").val(),
        "description": $("#description").val(),
        "phone": $("#phone").val(),
        "adress": $("#adress").val(),
        "city": $("#city").val(),
        "date-init": $("#config-date-init").val(),
        "date-finish": $("#config-date-finish").val(),
        "range-init": $("#range-init").val(),
        "range-finish": $("#range-finish").val(),
        "text": $("#text").val(),
        "logo": $("#logo").val(),        
    });
    console.log(data);
    
    
})