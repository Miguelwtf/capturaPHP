<?php
if (!isset($_GET['host'])){
    header("location: index.php");
}
$host = $_GET['host'];
$ipX = gethostbyname($host);
$ipY = gethostbynamel($host);
$records = dns_get_record($host);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <html lang="pt">
    <title>Captura - PHP</title>
    <meta name="viewport">
    <link rel="icon" type="imagem/png" href="https://cdn-icons-png.flaticon.com/512/919/919830.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
</head>
<body style="font-family: Lato; background-color: white; color:black;">
    <div class="container" style="margin-top: 50px; margin-bottom: 150px;">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="padding: 0; border: 1px solid #340375; border-radius: 35px 35px 0px 0px">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png" alt="Ferramenta Php" style="width: 100%;">
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6 offset-md-3" style="border: 1px solid #340375; border-radius: 0px 0px 35px 35px;">
                <p style="text-align: center; font-size 45px; font-weight: 100px;">
                <div class="row" style="margin: auto; justify-content:center;">
                    <button type="button" class="btn btn-outline-primary" style="width: 200px;" onclick="history.go(0)">Atualizar</button>
                    <button type="button" class="btn btn-outline-primary" style="width: 200px;" onclick="history.go(-1)">Retornar</button>
                </div>
                <hr>
                <h6><strong>Resumo da busca:</strong></h6>
                <?php echo 'Endereço buscado foi: ' . $host . '</br> Sua busca teve ' . count($ipY) . ' IPS encontrados! </br> Sua busca teve ' . count($records) . ' DNS encontrados! <hr>';?>
                    <div class="row">
                        <div class="row" style="width: 100%; margin: auto; padding-bottom: 2%;">
                            <div class="row">
                            <p style="text-align: center;"><strong>Busca de endereços de IP</strong></p>
                                <?php   
                                rsort($ipY, SORT_NUMERIC);
                                foreach ($ipY as $ips){
                                echo $ips . '</br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-md-1" style="border: 1px solid #340375; border-radius: 35px 35px 35px 35px; padding-bottom: 2%;">
                <p style="text-align: center; font-size 35px; font-weight: 100px"><strong>Busca de DNS</strong></p>
                <p><strong></strong></p> 
                <hr>
                    <div class="row" style="width: 100%; font-weight:600px;">
                        <div class="col-md-2">Tipo</div>
                        <div class="col-md-3">Host</div>
                        <div class="col-md-2">TTL</div>
                        <div class="col-md-1">Classe</div>
                        <div class="col-md-2">IP</div>
                        <div class="col-md-2">Txt</div>
                    </div>
                    <hr>
                    <?php foreach ($records as $record):?>
                        <?php $record = json_decode(json_encode($record)) ;?>
                        <div class="row" style="width: 100%; overflow-wrap: break-word;">
                            <div class="col-md-2"><?php echo $record->type; ?></div>
                            <div class="col-md-3"><?php echo $record->host; ?></div>
                            <div class="col-md-2"><?php echo $record->ttl; ?></div>
                            <div class="col-md-1"><?php echo $record->class ?></div>
                            <div class="col-md-2"><?php if (isset($record->ip)){
                                echo $record->ip;
                            } else { echo "N/A";} ?></div>
                            <div class="col-md-2"><?php if (isset($record->txt)){
                                echo $record->txt;
                            } else { echo "N/A";} ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>