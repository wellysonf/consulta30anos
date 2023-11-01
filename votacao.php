<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação 30 anos IFPE - Campus Pesqueira</title>
    <script src="js/tailwindcss.js"></script>
    <link href="css/styles_select2.css" rel="stylesheet" />
    <script src="js/select2.min.js"></script>
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
                        <a class="text-green-900 hover:pb-4 hover:border-b-4 hover:border-green-400" href="#">
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
        <p>Olá <?= $_SESSION['auth']['nome'] ?>, descrição completa...</p>

        <div class="flex flex-col items-center md:flex-row gap-4 basis-1">
            <?php if ($_SESSION['auth']['categoria'] == "TAE") { ?>
                <div class="flex flex-col gap-2">
                    <span class="my-5">Vote na categoria de Técnico Administrativo:</span>
                    <div class="flex flex-col bg-gray-200 my-4 max-w-sm shadow-md py-8 px-10 md:px-8 rounded-md">
                        <div class="flex flex-col md:flex-row gap-6 md:gap-8">
                            <!-- <img class="rounded-full border-4 border-gray-300 h-24 w-24 mx-auto" src="https://randomuser.me/api/portraits/men/78.jpg" alt="" /> -->
                            <div class="flex flex-col text-center md:text-left">
                                <div class="font-medium text-lg text-gray-800">Terry Sherman</div>
                                <div class="text-gray-500 mb-3 whitespace-nowrap">Senior Software Developer</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } elseif ($_SESSION['auth']['categoria'] == "PROFESSOR") {  ?>
                <div class="flex flex-col gap-2">
                    <span class="my-5">Vote na categoria de Docente:</span>
                    <div class="flex flex-col bg-gray-200 my-4 max-w-sm shadow-md py-8 px-10 md:px-8 rounded-md">
                        <div class="flex flex-col md:flex-row gap-6 md:gap-8">
                            <!-- <img class="rounded-full border-4 border-gray-300 h-24 w-24 mx-auto" src="https://randomuser.me/api/portraits/men/78.jpg" alt="" /> -->
                            <div class="flex flex-col text-center md:text-left">
                                <div class="font-medium text-lg text-gray-800">Terry Sherman</div>
                                <div class="text-gray-500 mb-3 whitespace-nowrap">Senior Software Developer</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {  ?>
                <div class="flex flex-col gap-2">
                    <span class="my-5">Vote na categoria de Discente:</span>
                    <form action="#" method="post">

                        <div class="flex flex-col bg-gray-200 my-4 max-w-sm shadow-md py-8 px-10 md:px-8 rounded-md">
                            <div class="flex flex-col md:flex-row gap-6 md:gap-8">
                                <!-- <img class="rounded-full border-4 border-gray-300 h-24 w-24 mx-auto" src="https://randomuser.me/api/portraits/men/78.jpg" alt="" /> -->
                                <div class="flex flex-col text-center md:text-left">
                                    <select name="enfermagem" id="enfermagem" class="select_votacao">
                                        <option value="01">aluno01</option>
                                        <option value="02">aluno02</option>
                                        <option value="03">aluno03</option>
                                        <option value="04">aluno04</option>
                                        <option value="05">aluno05</option>
                                    </select>
                                    <div class="font-medium text-lg text-gray-800">Terry Sherman</div>
                                    <div class="text-gray-500 mb-3 whitespace-nowrap">Senior Software Developer</div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            <?php }  ?>
        </div>
    </main>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select_votacao').select2();
    });
</script>

</html>