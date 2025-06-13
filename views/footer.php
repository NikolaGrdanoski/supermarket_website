<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h1>Super Kuper</h1>
                        <p class="mt-2">Kupi super vo Super Kuper</p>
                        <script>
                            function dateDisplay() {
                                const date = new Date();
                                let h = date.getHours();
                                let m = date.getMinutes();
                                let s = date.getSeconds();

                                //let day = date.getDay();
                                //let mm = date.getMonth();
                                //let y = date.getFullYear();

                                document.getElementById("time").innerHTML = h + ":" + m + ":" + s;
                                //document.getElementById("date").innerHTML = day + "/" + mm + "/" + y;
                            }

                            setInterval(function(){
                                dateDisplay();
                            }, 1000);
                        </script>
                        <div id="time"></div>
                        <!--<div id="date"></div>-->
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p>&copy; 2025 Super Kuper. All rights reserved.</p>
                </div>
            </div>
            <br>
        </footer>
    </body>
</html>