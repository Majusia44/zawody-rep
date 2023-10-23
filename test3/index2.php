<?php
    session_set_cookie_params(3); 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["iloscPol"] = $_POST["iloscPol"];
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;500&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="container-grid">
<div id="menu"></div>
<div id="home">
    <div id="oblicz">
    <form method="post" action="">
        <label for="iloscPol"><h1>Ilość pól:</h1></label>
        <input type="number" id="iloscPol" name="iloscPol" min="1" required value="<?php echo isset($_SESSION['iloscPol']) ? $_SESSION['iloscPol'] : '' ?>">
        <input type="submit" value="generuj formularz">
    </form>

    <div id="formularz"></div>
    <div id="suma"></div>
    <div id="sumax"></div>
    

    <script>

        function generujFormularz(iloscPol) {
            let formularz = '<form>';
            for (let i = 1; i <= iloscPol; i++) { 
                formularz += '<label for="pole' + i + '"><p>Strzały ' + i + ':</label></p>';
                formularz += '<input type="text" id="pole'+ i +'" name="pole'+ i +'" oninput="obliczSume()">';
            }
            
            formularz += '</form>';
            document.getElementById('formularz').innerHTML = formularz;
        }

        function obliczSume() {
            let iloscPol = document.getElementById('iloscPol').value;
            let suma = 0;
            let sumax = 0;

            for (let i = 1; i <= iloscPol; i++) { 
                let poleValue = document.getElementById('pole' + i).value;
                    switch(poleValue){
                        case "X":
                            suma += 10;
                            sumax += 1;
                            break; 
                        case "/":
                            suma += 10;
                            break;
                        case "":
                            break;
                        default:
                            poleValue = parseInt(poleValue);
                            suma += poleValue;
                            break;
                        
                        
                    }   
            }


            document.getElementById('suma').innerHTML = '<p>Suma:</p>' + suma;
            document.getElementById('sumax').innerHTML = '<p>Ilość strzałów wewnętrznych:</p>' + sumax;
        }


    </script>
    </div>
   
    <div id="pkt">
    <h3>Punktacja:</h3>
    <p>X to strzał wewnętrzny który daje 10 punktów</p>
    <p>/ to strzał zwykły który daje 10 punktów</p>
    <p>none oznacza że nie udało się strzelić, więc daje to 0 punktów</p>
    </div>
   <div id="zdjecie">
    <img src="zdj1.jpg">
   </div>
   <div id="zdjecie2">
    <img src="zdj2.jpg">
   </div>
   <div id="mapa">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20054.63015009263!2d19.43471915898671!3d51.07471088993331!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4719ffc50e1bd775%3A0xd0b658d62717f056!2sStrzelnica%20LOK%20Radomsko!5e0!3m2!1spl!2spl!4v1697556334994!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>
    <div class="stopka">
                <p>&copy 2023 Copyright Maja Buda</p>
            </div>
    </div>
    
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $iloscPol = $_SESSION["iloscPol"]; 
         echo "<script>generujFormularz($iloscPol);</script>"; 
    }
?>