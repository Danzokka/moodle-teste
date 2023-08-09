<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style-adicional-index-dash.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include 'header_2.php' ?>
    <div class="container_home">
        <div class="container_home_int">
            <div class="area_home">
                <div class="area_texts_home">
                    <div class="title_home">
                        <h2>
                            Você está na
                        </h2>
                    </div>
                    <div class="sub_title_home">
                        <p>
                            Escola Virtual do
                            ChildFund Brasil
                        </p>
                    </div>
                </div>
                <div class="area_img_home">
                    <img src="img/bg_home.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container_cards_home">
        <div class="container_cards_home_int">
            <div class="area_cards_home">
                <a href=#>
                    <div class="cards_home">
                        <img src="img/icon_home_1.svg" alt="">
                        <div class="title_cards_home">
                            <h2>
                                Matricular
                            </h2>
                        </div>
                    </div>
                </a>
                <a href=#>
                    <div class="cards_home">
                        <img src="img/icon_home_2.svg" alt="">
                        <div class="title_cards_home">
                            <h2>
                                Suporte Técnico
                            </h2>
                        </div>
                    </div>
                </a>
                <a href=#>
                    <div class="cards_home">
                        <img src="img/icon_home_3.svg" alt="">
                        <div class="title_cards_home">
                            <h2>
                                Cursos
                                Disponíveis
                            </h2>
                        </div>
                    </div>
                </a>
                <a href=#>
                    <div class="cards_home">
                        <img src="img/icon_home_4.svg" alt="">
                        <div class="title_cards_home">
                            <h2>
                                Verificar
                                certificado
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container_2_home">
        <div class="container_2_int">
            <div class="title_cursos_pesquisa_home">
                <h2>
                    Cursos disponíveis
                </h2>
            </div>
            <div class="area_btns_cursos_home" id="modalidadesContainer">

            </div>
        </div>
    </div>
    <div class="area_container_2_total">
        <div class="area_pesquisa_home">
            <div class="area_lupa">
                <form onsubmit="fazerPesquisa(event)">
                    <img src="img_perfil/lupa.svg" alt="">
                    <input id="pesquisa_home" class="pesquisa_home" type="text" name="pesquisa_home" placeholder="Cursos online disponíveis">
                </form>
            </div>


            <div class="area_btns_cursos_home">
                <!-- Fazer Recursivamente
                    <a href="#">
                        <div class="btn_pesquisa_home animation_btns">
                            <h2>
                                Trilha (0)
                            </h2>
                        </div>
                    </a>
                    -->
            </div>
        </div>
        <div class="area_container_2_home">
            <!--Trocar na area_info_cursos_online_home_total
        para arrumar a altura do card-->
        </div>

    </div>
    </div>
    </div>
    <section id="noticia">
        <div class="container_noticia">
            <div class="container_noticia_int">
                <div class="area_noticia">
                    <div class="container_relacionados">
                        <div class="container_relacionados_int">
                            <div class="area_relacionados">
                                <div class="area_texts_relacionados">
                                    <div class="title_noticiais">
                                        <h2>Notícias</h2>
                                    </div>
                                </div>
                                <div class="slide-1 owl-carousel owl-theme area_cards_relacionados_noticia_home">
                                    <?php
                                    $curl = curl_init();

                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'https://lynx.avantebrasil.com.br/webhook/102709c7-6c0c-4a13-8476-06e57369fdd2/rafael/noticias',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                        CURLOPT_HTTPHEADER => array(
                                            'x-url: skills.superapprova.com.br',
                                            'x-wstoken: 8684d46338373740bf1390950f6540d0',
                                            'Authorization: Basic c3VwZXJhcHByb3ZhOlc3MDM0UTAwNDlmcQ=='
                                        ),
                                    ));

                                    $json = curl_exec($curl);

                                    curl_close($curl);
                                    $dados = json_decode($json, true);
                                    foreach ($dados["noticias"] as $noticia) {
                                        $mensagem = $noticia["mensagem"];
                                        $mensagemSemTags = strip_tags($mensagem);
                                        $mensagemLimitada = strlen($mensagemSemTags) > 100 ? substr($mensagemSemTags, 0, 100) . '...' : $mensagemSemTags;

                                        $pattern = '/<img src="([^"]+)"/';
                                        preg_match($pattern, $mensagem, $urlImagem);
                                        $urlImagem = isset($urlImagem[1]) ? $urlImagem[1] : null;

                                        if ($urlImagem) {
                                            $token = "8684d46338373740bf1390950f6540d0";
                                            $urlImagem = $urlImagem . '?token=' . $token;
                                        } else {
                                            $numeroAleatorio = mt_rand(1, 4);
                                            $urlImagem = 'img/noticia_' . $numeroAleatorio . '.png';
                                        }
                                        echo                          '<div class="item">
                                                                                    <div class="card_relacionados_noticia">
                                                                                        <div class="img_relacionados">
                                                                                            <img src="' . $urlImagem . '" alt="">
                                                                                        </div>
                                            
                                                                                        <div class="area_texts_relacionados_2_noticia">
                                                                                            <div class="title_noticia_card">
                                                                                                <h2>
                                                                                                    ' . $noticia["titulo"] . '
                                                                                                </h2>
                                                                                            </div>
                                            
                                                                                            <div class="sub_title_noticia_card">
                                                                                                ' . $mensagemLimitada . '
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="area_texts_relacionados_2_noticia">
                                                                                        <a href="https://skills.superapprova.com.br/mod/forum/discuss.php?d=' . $noticia["idNoticia"] . '" target="_blank">
                                                                                        <div class="btn_noticias_home animation_btns">
                                                                                            <h2>Leia Mais</h2>
                                                                                        </div>
                                                                                        </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container_info_home">
                        <div class="container_info_home_int">
                            <div class="title_info_home_total">
                                <h2>
                                    Como funciona
                                </h2>
                            </div>
                            <div class="area_info_home">
                                <div class="card_info_home">
                                    <div class="card_info_home_int">
                                        <div>
                                            <div class="circulo_info_home">
                                                <p>1</p>
                                            </div>
                                        </div>
                                        <div class="title_info_home">
                                            <h2>
                                                Você poderá selecionar um dos cursos do catálogo, ou nos cursos
                                                disponíveis na página inicial.
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card_info_home_2">
                                    <div class="card_info_home_int">
                                        <div>
                                            <div class="circulo_info_home">
                                                <p>2</p>
                                            </div>
                                        </div>
                                        <div class="title_info_home">
                                            <h2>
                                                Faça a sua inscrição conforme o formulário.
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card_info_home_3">
                                    <div class="card_info_home_int">
                                        <div>
                                            <div class="circulo_info_home">
                                                <p>3</p>
                                            </div>
                                        </div>
                                        <div class="title_info_home">
                                            <h2>
                                                Você receberá um e-mail ou mensagem via WhatsApp com a confirmação.
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card_info_home_4">
                                    <div class="card_info_home_int">
                                        <div>
                                            <div class="circulo_info_home">
                                                <p>4</p>
                                            </div>
                                        </div>
                                        <div class="title_info_home">
                                            <h2>
                                                Pronto! Você poderá iniciar o curso.
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <img class="img_info_home" src="img/bg_info_home.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/cards.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script defer src="js/script.js"></script>
    <script type="text/javascript">
        const next = '<img src="img/arrow_left.png" alt="">';
        const prev = '<img src="img/arrow_right.png" alt="">';
        $(document).ready(() => {

            $(".slide-1").owlCarousel({

                items: 3,
                loop: true,
                nav: true,
                navText: [
                    prev,
                    next
                ],
                autoplay: false,
                autoplayTimeout: 12000,
                dots: false,
                responsive: {
                    320: {
                        items: 1
                    },
                    425: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    800: {
                        items: 2
                    },
                    1024: {
                        items: 3
                    },
                    1300: {
                        items: 4
                    }
                }

            });

        });
    </script>
</body>

</html>