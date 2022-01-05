<?php
    if(isset($_SESSION['User']) && $_SESSION['User']{'statut'} != 2)
    {
        echo '
                </main>
                <footer>
                    contact an administrator : <a href="index.php?main=contactAdm"><button class="footBTN">Contact</button></a>
                </footer>
            </body>
        </html>';
    }
    else
    {
        $count = 0;
        $cont = SQLgetContactAdmin("", "");
        for($c=0; $c<sizeof($cont); $c++)
        {
            if($cont{$c}{'idAdmin'} == null)
            {
                $count++;
            }
        }
        echo '
                </main>
                <footer>
                    <a href="index.php?main=contactPpl"><button class="footBTN">Requests('.$count.')</button></a>
                </footer>
            </body>
        </html>';
    }
?>