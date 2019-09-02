$(document).ready(function() {
    $('#table-type-room').DataTable();
    $('#table-create-room').DataTable();
} );

function  openModal(){
    $('#detail-modal').modal('show')
}

function createTypeRoom(e) {
    alert('asdasd')
    e.preventDefault();
    console.log(puto);
    
}
$("#form-type-room").submit(function(e) {
    e.preventDefault();
    alert("sfln")
})


