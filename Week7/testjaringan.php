<html>
    <head>
        <title>Koneksi Database MySQL</title>
    </head>
    <body>
        <h1>Demo Koneksi database MySQL</h1>
        <?php
        $conn = mysqli_connect("localhost","root","","sakila");

        //Check conection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: ". mysqli_connect_errno()
            ;
            exit();
        }
        ?>
    </body>
</html>