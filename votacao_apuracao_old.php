<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação 30 anos IFPE - Campus Pesqueira</title>
    <?php
    include("inc.favicon.php");
    ?>
    <script src="js/tailwindcss.js"></script>
    <style>
        #menu-toggle:checked+#menu {
            display: block;
        }
    </style>
</head>

<body>
    <?php
    /* session_start();
    if (!isset($_SESSION['auth']) && $_SESSION['auth']['matricula'] == "1898805") {
        header("Location: index.php");
    } */
    require_once './repositorio_eleitor.php';

    ?>
    <nav class="lg:px-16 px-6 bg-white shadow-md flex flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-between items-center">
            <a href="/" class="flex text-lg font-semibold">
                <img src="img/logo.png" alt="Logo 30 anos Campus Pesqueira" srcset="" class="h-10">
                <!-- <div class="mt-3 text-green-600">IFPE Pesqueira</div> -->
            </a>
        </div>
        <label for="menu-toggle" class="cursor-pointer lg:hidden block">
            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />
        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="text-xl text-center items-center gap-x-5 pt-4 md:gap-x-4 lg:text-lg lg:flex  lg:pt-0">
                    <li class="py-2 lg:py-0 ">
                        <a class="text-green-600 hover:pb-4 hover:border-b-4 hover:border-green-400" href="votacao.php">
                            Votação
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 ">
                        <a class="text-green-900 hover:pb-4 hover:border-b-4 hover:border-green-400" href="logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
    <main class="container mx-auto">
        <section class="text-center">
            <h1 class="text-6xl my-3">Votação 30 anos</h1>
            <h2 class="text-3xl">IFPE - <i>Campus</i> Pesqueira</h2>
            <h2 class="text-3xl">Apuração dos votos</h2>
            <hr>
        </section>
        <div>
            <div class="flex flex-col gap-2 container">
                <section class="flex flex-col md:flex-row gap-5 w-full justify-center flex-wrap">
                    
                        <?php
                        $lista_de_votos = $repo_eleitor->buscarVotosParaApuracao();
                        $cat_anterior = "";
                        $lista_descricao = [
                            'BACHARELADO EM ENFERMAGEM' => 'enfermagem',
                            'ENGENHARIA ELÉTRICA' => 'eng_elet',
                            'ESPECIALIZAÇÃO EM ENERGIA SOLAR FOTOVOLTAICA' => 'esp_solar',
                            'ESPECIALIZAÇÃO EM ENSINO DE FÍSICA E MATEMÁTICA' => 'esp_fis_mat',
                            'LICENCIATURA EM FÍSICA' => 'fisica',
                            'LICENCIATURA EM MATEMÁTICA' => 'matematica',
                            'TÉCNICO EM EDIFICAÇÕES - SUBSEQUENTE' => 'edif_sub',
                            'TÉCNICO EM EDIFICAÇÕES INTEGRADO AO ENSINO MÉDIO' => 'edif_mi',
                            'TÉCNICO EM ELETROTÉCNICA - INTEGRADO' => 'elet_mi',
                            'TÉCNICO EM ELETROTÉCNICA - SUBSEQUENTE' => 'elet_sub',
                            'TÉCNICO EM MEIO AMBIENTE - INTEGRADO' => 'meio_amb',
                            'TAE' => 'tae',
                            'PROFESSOR' => 'docente',
                        ];
                        foreach ($lista_de_votos as $voto_atual) {
                            if ($cat_anterior != $voto_atual['voto_categoria']) {
                                $cat_anterior = $voto_atual['voto_categoria'];
                                $var_name = $lista_descricao[$voto_atual['voto_categoria']];
                                $$var_name = array();
                        ?>
                               <div class="flex w-1/2 flex-col p-3 border-2 border-green-700 gap-2 rounded-md">
                                   <span class="text-lg text-center font-bold"><?= $cat_anterior ?></span>
                                    <canvas id="<?= $var_name ?>"></canvas>
                                </div>
                        <?php
                            }
                            $item = ['nome' => $voto_atual['voto_nome'], 'votos' => $voto_atual['qtd_voto']];
                            if (count($$var_name) < 3) {
                                array_push($$var_name, $item);
                            }
                        }

                        ?>
                    
                </section>
            </div>
        </div>
        </div>
    </main>
</body>
<script src="js/jquery-3.7.1.min.js"></script>
<!-- <script type="module"  src="./js/chart.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script type="text/javascript">
    $(function() {
        <?php
        foreach ($lista_descricao as $key => $value) {
            if (isset($$value)) {
            ?>
const <?=$value?> = <?=json_encode($$value)?>;
        new Chart(
            document.getElementById('<?=$value?>'), {
                type: 'bar',
                data: {
                    labels: <?=$value?>.map(row => row.nome),
                    datasets: [{
                        label: 'Votos',
                        data: <?=$value?>.map(row => row.votos),
                        borderWidth: 1
                    }]
                }
            }
        );

        <?php

            }
        }
        ?>
    });
</script>

</html>