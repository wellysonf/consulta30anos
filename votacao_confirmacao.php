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
    session_start();
    if (!isset($_SESSION['auth'])) {
        header("Location: index.php");
    }
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
            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 20 20">
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
        </section>
        <p>Olá
            <?= $_SESSION['auth']['nome'] ?>, seu voto foi registrado com sucesso. Caso deseja alterar, basta
            efetuar a votação novamente que seu voto será atualizado.
        </p>
        <p>A equipe do IFPE <i>Campus</i> Pesqueira agradece o seu voto.</p>
        <div>
            <div class="flex flex-col gap-2 container">
                <section class="flex flex-col md:flex-row gap-5 w-full justify-center flex-wrap">

                <?php
                        $lista_modalidades = [
                            'enfermagem'  => 'BACHARELADO EM ENFERMAGEM',
                            'eng_elet'    => 'ENGENHARIA ELÉTRICA',
                            'esp_solar'   => 'ESPECIALIZAÇÃO EM ENERGIA SOLAR FOTOVOLTAICA',
                            'esp_fis_mat' => 'ESPECIALIZAÇÃO EM ENSINO DE FÍSICA E MATEMÁTICA',
                            'fisica'      => 'LICENCIATURA EM FÍSICA',
                            'matematica'  => 'LICENCIATURA EM MATEMÁTICA',
                            'edif_sub'    => 'TÉCNICO EM EDIFICAÇÕES - SUBSEQUENTE',
                            'edif_mi'     => 'TÉCNICO EM EDIFICAÇÕES INTEGRADO AO ENSINO MÉDIO',
                            'elet_mi'     => 'TÉCNICO EM ELETROTÉCNICA - INTEGRADO',
                            'elet_sub'    => 'TÉCNICO EM ELETROTÉCNICA - SUBSEQUENTE',
                            'meio_amb'    => 'TÉCNICO EM MEIO AMBIENTE - INTEGRADO',
                            'tae'         => 'Técnico Administrativo',
                            'docente'     => 'Docente',
                        ];
                        $lista_de_votos = $repo_eleitor->buscarVotosPorEleitor($_SESSION['auth']['id']);
                        foreach ($lista_de_votos as $voto_atual) {
                        ?>
                            <div class="flex flex-col bg-gray-200 my-4 max-w-sm shadow-md py-8 px-10 md:px-8 rounded-md w-96  gap-4">
                                <div class="font-medium text-lg text-gray-800 h-10"><?= $lista_modalidades[$voto_atual['categoria']] ?></div>
                                <div class="text-gray-500 mb-3 whitespace-normal h-10"><?= $voto_atual['voto'] ?> - <?= $voto_atual['nome'] ?> <?php $voto_atual['periodo'] != "" ? "(" . $voto_atual['periodo'] . "º)" : "" ; ?> </div>
                            </div>
                        <?php
                        }
                        ?>

                </section>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4 my-10 ">
            <a class="block w-full text-center bg-green-600 mt-5 py-2 rounded-2xl hover:bg-green-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2"
                data-ripple-light="true" href="votacao.php">
                Modificar Votar
            </a>
            <a class="block w-full text-center bg-green-600 mt-5 py-2 rounded-2xl hover:bg-green-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2"
                data-ripple-light="true" href="logout.php">
                Sair
            </a>
            <!-- <a class="middle none center text-center w-full rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                data-ripple-light="true" href="votacao.php">
                Votar novamente
            </a>
            <a class="middle none center text-center w-full rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                data-ripple-light="true" href="logout.php">
                sair
            </a> -->

        </div>
        </div>
    </main>
</body>

</html>