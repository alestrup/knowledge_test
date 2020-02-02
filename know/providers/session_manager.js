verifySession();

/* If the user select the remember option, 
the session will remain for 30 days, 
if he does not use it  in 30 days the server 
will expire his session and the session will closed */

function verifySession(){
    if(!$.cookie('session')){
        redirectToLogin();
    }
    else{
        redirectToList();
    }
}   

function redirectToLogin(){
    var pathname = window.location.pathname;
    if(pathname != "/know/ " && pathname != "/know/index.html"){
        location.href = 'index.html';
    }
}

function redirectToList(){
    var pathname = window.location.pathname;
    if(pathname != "/know/list.html"){
        location.href = 'list.html';
    }
}

function logout(){
    var session = getSession();
        
    request = $.ajax({
        url: api_url + "auth",
        type: "DELETE",
        dataType: 'json',
        headers : {
            'userId' : session.user_id,
            'token' : session.token
        },
        contentType: "application/json; charset=utf-8",
    }).done(function(response){
        $.removeCookie('session');
        redirectToLogin();
    }).fail(function(){
        $.removeCookie('session');
        redirectToLogin();
    })
}

function getSession(){
    return JSON.parse($.cookie('session'));
}

window.onbeforeunload = function() {
    removeSession();
};

window.unload = function() {
    removeSession();
};

function removeSession(){
    var pathname = window.location.pathname;
    var session = getSession();
    if(pathname != "/know/ " && pathname != "/know/index.html"){
        if(session.remember != 1)
            $.removeCookie('session');
        return "Bye now!";
    }
}