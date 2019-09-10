$("#reception").ready(function(){
    $('#init-modal').modal('show');
    
});

$('#value').keypress(function() {
    var data = this.value
    var result = data.replace(/(?=(\d{3})+(?!\d))/g, '$1,');
    console.log(result);   
});
$('#box').submit(function(e) {
    e.preventDefault();
    var value = $('#value').val();
    if (value !== '') {
        $('#init-modal').modal('hide')
    }
})