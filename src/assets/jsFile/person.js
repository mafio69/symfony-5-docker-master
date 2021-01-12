$('#save').on('click', () => {
    let data = $('#addUser').serialize();
    $.ajax({
        url: 'add-person',
        data: data,
        method: 'POST'
    }).done((data) => {
        $("#close").trigger("click");
        Swal.fire(data)
    })
})

$(document).on('click','.edit', function(){
    let id =  $(this).attr('id');
    $.ajax({
        url: 'edit-person',
        data: id,
        method: 'POST'
    }).done((data) => {
        $('#loginE').val(data.login)
        $('#fnameE').val(data.fName)
        $('#lnameE').val(data.lName)
        $('#id').val(data.id)
        $('#state  > option[value *= ' + data.state + '] ').attr('selected',true);
    })
})

$(document).on('click', '#saveEdit', () => {
    let data = $('#editUser').serialize();

    $.ajax({
        url: 'save-edit-person',
        data: data,
        method: 'POST'
    }).done((data) => {
        $("#closeEdit").trigger("click");
        Swal.fire(data)
        window.location.reload(true);
        console.log(data)
    })
});

$('#save').on('click', () => {
    let data = $('#addUser').serialize();
    $.ajax({
        url: 'save-person',
        data: data,
        method: 'POST'
    }).done((data) => {
        $("#close").trigger("click");
        Swal.fire(data)
    })
})