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
        .login_img_section {
            background: linear-gradient(rgba(2, 2, 2, .7), rgba(0, 0, 0, .7)), url("img/foto_campus.jpg") center center;
        }
    </style>
</head>

<body>
    <div class="h-screen flex">
        <div class="hidden lg:flex w-full lg:w-1/2 login_img_section justify-around items-center">
            <div class=" 
                  bg-black 
                  opacity-20 
                  inset-0 
                  z-0">

            </div>
        </div>
        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white space-y-8">
            <div class="w-full px-8 md:px-32 lg:px-24">
                <form class="bg-white rounded-md shadow-2xl p-5" action="logar.php" method="post">
                    <div class="flex flex-col items-center m-2">
                        <img src="img/logo.png" alt="Logo 30 anos" srcset="" class="w-32 text-center">
                    </div>
                    <h1 class="text-gray-800 font-bold text-2xl mb-1 text-center">Seja bem-vindo</h1>
                    <p class="text-sm font-normal text-gray-600 mb-8 text-center">Votação 30 anos IFPE - Pesqueira</p>
                    <?php
                    if (count($_GET) > 0) {
                        $erro = base64_decode($_GET['err']);
                        if (is_numeric($erro)) {
                            switch ($erro) {
                                case 10:
                                    $msg = "Dados incorretos, favor tentar novamente.";
                                    break;
                                case 529:
                                    $msg = "Período de votação expirado";
                                    break;
                            }
                            ?>
                                <p class="text-sm font-normal text-red-800 mb-8 text-center"><?php echo $msg; ?></p>
                            <?php
                        }
                    }
                    ?>
                        <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                            <input id="matricula" class=" pl-2 w-full outline-none border-none" type="text" name="matricula" placeholder="Matrícula (SIAPE ou QAcadêmico)" />
                        </div>
                        <div class="flex items-center border-2 mb-12 py-2 px-3 rounded-2xl ">
                            <input class="pl-2 w-full outline-none border-none" type="password" name="cpf" id="cpf" placeholder="CPF" />
                        </div>
                        <button type="submit" class="block w-full bg-green-600 mt-5 py-2 rounded-2xl hover:bg-green-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2">Login</button>
                   
                </form>
            </div>

        </div>
    </div>
</body>

</html>