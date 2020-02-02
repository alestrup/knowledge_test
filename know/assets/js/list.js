var students_per_page = 5; /* Change it to get more than 5 students per page */
var session = getSession();
var current_page = 1; /* Initialize the current page  */
var total_pages = 0;

$(document).ready(function(){
    /* Getting data for the First page */
    
    getStudents();

    $('#logout').click(function(){
        logout();
    })

    $(document).on('click', '.pagination a',function(event)
    {
        event.preventDefault();

        $('li').removeClass('active');
        if($(this).data('page') == undefined){
            if( (current_page + 1 ) <= total_pages ){
                current_page += 1;
            }
            $('#page-'+ current_page).addClass('active');
        }
        else{
            current_page=$(this).data('page');
            $(this).parent('li').addClass('active');
        }

        getStudents();
    });
});

function emptyTable(){
    $("#students-table > tbody").html("");
}

function getStudents(){
    var data = {
        limit : students_per_page,
        current_page : current_page
    }

    request = $.ajax({
        url: api_url + "users",
        type: "GET",
        dataType: 'json',
        headers : {
            'userId' : session.user_id,
            'token' : session.token
        },
        data: data,
        contentType: "application/json; charset=utf-8",
    }).done(function(response){
        emptyTable();
        fillTable(response);
        current_page = response.current_page;
    }).fail(function(){
        logout();
    })
}

function fillTable(response){

    if($('#pagination').children().length == 0){  /* Verify if the pagination has not been initialized */
        total_pages = response.last_page;
        initializePagination();
    }
    var src_checkmark = "./assets/images/checkmark.png";
    $.each(response.data, function( index, student){
        $('#students-table > tbody').append(
            "<tr>" +
                "<td>" +
                    "<img class='float-right' src='"+ src_checkmark +"' alt='' width='30'>"+
                "</td>" +
                "<td>" +
                    "<p class='pb-0 mb-0'>kctest002" + ('0' + student.id).slice(-2) + "</p>" +
                    "<p class='mt-0 pt-0 student-name'>" + student.name + " " + student.lastname + "</p>" +
                "</td>"+
                "<td>" +
                    "<div class='dropdown'>"+
                        "<button class='btn dropdown-dots dropdown-toggle' type='button' id='dropdownStudentsList"+ student.id + "' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"+
                            "..."+
                        "</button>" +
                        "<div class='dropdown-menu' aria-labelledby='dropdownStudentsList'"+ student.id + ">"+
                            "<a class='dropdown-item'>Option 1</a>" +
                            "<a class='dropdown-item'>Option 2</a>" +
                        "</div>"+
                    "</div>"+
                    "<p class='mt-0 pt-0'>Default group</p>"+
                "</td>"+
            "</tr>"
        );
    })
        
}

function initializePagination(){
    for(var page = 0; page < total_pages; page ++){
        var temp_page = page + 1;
        var active = '';
        if(temp_page == 1)
            active = "active";
        $('#pagination').append(
            "<li id='page-" + temp_page + "'class='page-item "+ active +"'><a data-page='"+ temp_page + "'class='page-link'>"+ temp_page + "</a></li>"
        );
    }
    $('#pagination').append(
        "<li class='page-item'><a class='page-link' href='#'>Next&#xbb;</a></li>"
    );
}