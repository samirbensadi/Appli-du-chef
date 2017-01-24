$(document).on('pagecreate', "#scan", function () {
    QRScanner.scan(function (err, txt) {
        if (err)  {
            alert(err);
        } else {
            alert(txt);
        }
    });

    QRScanner.show();
});