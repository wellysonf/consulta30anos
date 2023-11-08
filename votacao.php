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
    <link href="css/select2.min.css" rel="stylesheet" />
    <style>
        #menu-toggle:checked+#menu {
            display: block;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['auth'])) {
        header("Location: index.php");
    }
    require_once './repositorio_eleitor.php';
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
                        <a class="text-green-600 hover:pb-4 hover:border-b-4 hover:border-green-400" href="#">
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
        </section>
        <p class="text-justify">Olá <?= $_SESSION['auth']['nome'] ?>, como forma de valorizar aquele que se destacou em seu ofício, o IFPE <i>Campus</i> Pesqueira, lança a votação para escolha através dos pares. Você pode escolher apenas um (a) representante para receber a homenagem em nome dos demais. A homenagem será realizada durante a solenidade oficial das comemorações dos 30 anos, que acontecerá no dia 13.11.23, no espaço Ford.</p>

        <div class="flex flex-col items-center md:flex-row gap-4 basis-1">
            <div class="flex flex-col gap-2 container">
                <form action="votacao_enviar.php" method="post" class="flex flex-col md:flex-row gap-5 w-full justify-center flex-wrap">
                    <div class="flex flex-col bg-gray-200 my-4 max-w-sm shadow-md py-8 px-10 md:px-8 rounded-md">
                        <div class="font-medium text-lg text-gray-800">Modalidade</div>
                        <div class="text-gray-500 mb-3 whitespace-normal h-10"><?= $_SESSION['auth']['categoria']  ?></div>
                        <select name="<?= $lista_descricao[$_SESSION['auth']['categoria']] ?>" id="<?= $lista_descricao[$_SESSION['auth']['categoria']] ?>" class="select_votacao" required>
                            <option value="" disabled selected>Selecione um candidato</option>
                            <option value="branco">Branco/Nulo</option>
                            <?php
                            $lista_candidatos = $repo_eleitor->buscarCandidatosPorCategoria($_SESSION['auth']['categoria'] );
                            foreach ($lista_candidatos as $candidato) {
                            ?>
                                <option value="<?= $candidato['matricula'] ?>"><?= $candidato['nome'] ?>
                                (
                                <?php 
                                    if($_SESSION['auth']['categoria'] == "TAE" || $_SESSION['auth']['categoria'] == "PROFESSOR" ){
                                        echo $candidato['matricula'];
                                    }else{
                                        echo $candidato['periodo'] . "º";
                                    }
                                ?>
                                 )
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="block w-full bg-green-600 mt-5 py-2 rounded-2xl hover:bg-green-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2">Enviar Voto</button>
                    <!-- <button type="submit" class="w-full bg-green-300 text-green-950 text-3xl mb-10 p-3 rounded-md font-bold">Enviar Voto</button> -->
                </form>
            </div>
        </div>
    </main>
</body>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/select2.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.select_votacao').select2();

    });
</script>

</html>