
function deleteLanguage(route, redirect) {
    $.ajax({
        url: route,
        type: 'DELETE',
        statusCode: {
            202: function(data) {
                console.log('202: '+data);
                window.location.replace(redirect);
            },
            204: function(data) {
                console.log('204'+data);
                window.location.replace(redirect);
            }
        }


    });
}


