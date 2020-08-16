// custom contact form 7

let response_output = (eventName, classToRemove, classtoAdd, colorBorder) => {
    document.addEventListener(eventName, function(event) {
        $('.wpcf7-response-output').removeClass(classToRemove);
        $('.wpcf7-response-output').removeClass('alert alert-success alert-warning alert-danger');
        $('.wpcf7-response-output').addClass(classtoAdd);
        $('.wpcf7-response-output').css({
            'border': '1px solid ' + colorBorder,
            'padding': '.75rem 1.25rem'
        })
    }, false )
}

response_output('wpcf7invalid', 'wpcf7-validation-errors', 'alert alert-danger', '#f5c6cb')
response_output('wpcf7spam', 'wpcf7-validation-errors', 'alert alert-warning', '#ffeeba')
response_output('wpcf7mailfailed', 'wpcf7-validation-errors', 'alert alert-warning', '#ffeeba')
response_output('wpcf7mailsent', 'wpcf7-validation-errors', 'alert alert-success', '#c3e6cb')
