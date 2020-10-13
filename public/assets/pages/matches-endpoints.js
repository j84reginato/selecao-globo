const matchesEndpoints = {

    GET_MATCHES: 'https://selecao-globo.herokuapp.com/api/desktop/v1/soccer-matches/:date',

    readMatches: function (date) {
        return new Promise(function (resolve, reject) {
            let url = matchesEndpoints.GET_MATCHES.replace(':date', date);
            $.ajax({
                url: url,
                headers: Object.assign(PARAM_AJAX_HEADERS, {
                    'cache-control': 'no-cache',
                    'Content-Type': 'application/json'
                }),
                dataType: 'json',
                type: 'GET',
            success: function (response) {
                if (response.success === 'false') {
                    if (helpers.isDebugMode()) {
                        console.log(response, matchesEndpoints.GET_MATCHES.replace(':date', date));
                    }
                    reject({message: 'Serviço indisponível no momento', level: 'warning'});
                }

                resolve(response);
            },
            error: function (error, response) {
                if (helpers.isDebugMode()) {
                    console.log(error.responseJSON.message, matchesEndpoints.GET_MATCHES.replace(':date', date));
                }
                reject({message: error.responseJSON.message, level: 'error'});
            }
        });
    });
}}
