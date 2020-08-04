<?php
    
    session_start();
    include_once('../back-end/connection.php');

    $userId = $_SESSION['id'];
    $bookId = $_SESSION['book_id'];
    $query = "SELECT r.value FROM rate r JOIN usr u ON u.id=r.user_id JOIN book b ON b.id=r.book_id WHERE u.id='$userId' AND b.id='$bookId'";
    $result = pg_query($dbConnection, $query);
    $row = pg_fetch_assoc($result);

    if ($row['value'] == 0.5) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" checked/><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 1) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" checked/><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 1.5) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" checked/><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 2) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" checked/><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 2.5) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" checked/><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 3) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" checked/><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 3.5) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" checked/><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 4) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" checked/><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 4.5) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" checked/><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }elseif ($row['value'] == 5) {
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" checked/><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }else{
        echo '<form action="" method="POST">
                <fieldset class="rating">
                    <input type="radio" class="the-value" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excelente - 5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Ótimo - 4.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Muito Bom - 4 estrelas"></label>
                    <input type="radio" class="the-value" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Bom - 3.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Mediano - 3 estrelas"></label>
                    <input type="radio" class="the-value" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Mediano - 2.5 estrelas"></label>
                    <input type="radio" class="the-value" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Fraco - 2 estrelas"></label>
                    <input type="radio" class="the-value" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Fraco - 1.5 estrela"></label>
                    <input type="radio" class="the-value" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Terrível - 1 estrela"></label>
                    <input type="radio" class="the-value" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Terrível - 0.5 estrela"></label>
                </fieldset> 
              </form>';
    }


?>