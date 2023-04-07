$.ajax({
    url: 'https://cdn.shopify.com/s/files/1/0717/6971/9092/files/Beblox_Manual_22623.pdf',
    method: 'GET',
    xhrFields: {
        responseType: 'blob'
    },
    success: function(response) {
        var blob = new Blob([response], {
            type: 'application/pdf'
        });
        var url = URL.createObjectURL(blob);
        var a = $('<a>', {
            href: url,
            download: 'Beblox_Manual_22623.pdf'
        }).appendTo('body');
        a[0].click();
        setTimeout(function() {
            a.remove();
            URL.revokeObjectURL(url);
        }, 0);
    }
});
