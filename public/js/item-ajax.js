var page = 1;
var is_ajax_fire = 0;
manageData();
/* manage data list */
function manageData() {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){
        manageRow(data);
        is_ajax_fire = 1
    });
}

/* Get Page Data*/
function getPageData() {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){
        manageRow(data);
    });


}
/* Add new Item table row */
function manageRow(data) {
    console.log(data);
    var	rows = '';
    $.each( data, function( key, value ) {
        key = key + 1;
        rows = rows + '<tr>';
        rows = rows + '<td>'+key+'</td>';
        rows = rows + '<td>'+value.name+'</td>';
        rows = rows + '<td>'+value.recipe+'</td>';
        rows = rows + '<td>'+value.price+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<a  href="cake/'+value.id+'" class="btn btn-primary edit-item">View</a> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';

    });
    $("tbody").html(rows);
}
/* Create new Item */
$(".crud-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var name = $("#create-item").find("input[name='name']").val();
    var recipe = $("#create-item").find("textarea[name='recipe']").val();
    var price = $("#create-item").find("input[name='price']").val();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{name:name, recipe:recipe,price:price}
    }).done(function(data){
        console.log(data);
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Cake Created Successfully.', 'Success Alert', {timeOut: 5000});
    });
    $("#create-item").find("input[name='name']").val('');
    $("#create-item").find("textarea[name='recipe']").val('');
    $("#create-item").find("input[name='price']").val('');
});


/* Remove Item */
$("body").on("click",".remove-item",function(){
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: url + '/' + id,
    }).done(function(data){
        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();
    });


});
/* Edit Item */
$("body").on("click",".edit-item",function(){
    var id = $(this).parent("td").data('id');
    var name = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var recipe = $(this).parent("td").prev("td").prev("td").text();
    var price = $(this).parent("td").prev("td").text();
    $("#edit-item").find("input[name='name']").val(name);
    $("#edit-item").find("textarea[name='recipe']").val(recipe);
    $("#edit-item").find("input[name='price']").val(price);
    $("#edit-item").find("form").attr("action",url + '/' + id);

});
/* Updated new Item */
$(".crud-submit-edit").click(function(e){
    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var name = $("#edit-item").find("input[name='name']").val();
    var price = $("#edit-item").find("input[name='price']").val();
    var recipe = $("#edit-item").find("textarea[name='recipe']").val();
    console.log({name:name, recipe:recipe,price:price});
    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_action,
        data:{name:name, recipe:recipe,price:price}
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
    });
    $("#create-item").find("input[name='name']").val('');
    $("#create-item").find("textarea[name='recipe']").val('');
    $("#create-item").find("input[name='price']").val('');
});