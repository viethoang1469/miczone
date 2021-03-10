$(document).ready(function () {
    let btnDelete = "<span class='deleteBtn'>delete</span>";
    let btnDone = "<span class='statusBtn done'>done</span>";
    let btnUndone = "<span class='statusBtn undone'>undone</span>";
    $.ajax({
        url: 'http://localhost:8082/api/list.php?action=toDoList',
        method: 'get',
        dataType: 'json',
        success: function (result) {
            if (result.success === true && result.code === 200) {
                $.each(result.data, function (i) {
                    let btn = (result.data[i].status === 'done') ? btnUndone : btnDone ;
                    let element = '<li data-id = '+ result.data[i].id + '>' + result.data[i].name + btnDelete + btn + '</li>';
                    $('#list').prepend(element);
                });
            }
        }
    });
    $('.addBtn').click(function (e) {
        e.preventDefault();
        let frm = $("#form");
        $.ajax({
            url: 'http://localhost:8082/api/list.php?action=add',
            method: 'post',
            dataType: 'json',
            data: frm.serialize(),
            success: function(result) {
                let element = '<li data-id = '+ result.data.id + '>' + result.data.name + btnDelete + btnDone + '</li>';
                $('#list').prepend(element);
                $('#myInput').val('');
                alert(result.message);
            }
        });

    });
    $('#list').on("click", '.statusBtn', function () {
        let flag = false;
        let id = $(this).parent().data('id');
        let old_status = ($(this).text() === 'undone') ? 'done' : 'not_done_yet';
        let element = $(this);
        $.get('http://localhost:8082/api/list.php?action=edit&id=' + id + '&old_status=' + old_status, function( result ) {
            if(result.success === true){
                flag = true;
                changeStatus(element);
                alert(result.message);
            }
        });
        
        // changeStatus(element);
    });
    $('#list').on("click", '.deleteBtn', function () {
        let id = $(this).parent().data('id');
        let flag = false;
        $.get('http://localhost:8082/api/list.php?action=delete&id=' + id, function( result ) {
            if(result.success === true){
                $('[data-id="' + id + '"]').css('display', 'none');
                flag = true;
                alert(result.message);
            }
        });
    });
});
function changeStatus(element) {
    let oldValue = $(element).text();
    let newValue = (oldValue == 'done') ? 'undone' : 'done';
    $(element).text(newValue);
    $(element).removeClass(oldValue);
    $(element).addClass(newValue);
}

