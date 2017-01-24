$(document).on('pagecreate', "#scan", function () {
    // QRScanner.scan(function (err, txt) {
    //     if (err)  {
    //         alert(err);
    //     } else {
    //         alert(txt);
    //     }
    // });
    //
    // QRScanner.show();



    function scan()
    {
        cordova.plugins.barcodeScanner.scan(
            function (result) {
                if(!result.cancelled)
                {
                    alert("Scan");
                    if(result.format == "QR_CODE")
                    {
                        alert("Done");

                    }

                }
            },
            function (error) {
                alert("Scanning failed: " + error);
            }
        );
    }

});