<?php if(!class_exists('Rain\Tpl')){exit;}?>

    <!-- CONTACT -->
    <section class="sec contact" id="contact">
        <div class="content">
            <div class="mxw800p">
                <h3>Entre em Contato</h3>
                <p>Precha o formulario abaixo que iremos responde-lo em breve</p>
            </div>
            <div class="contactForm">
                <form action="/sent-contact" method="post">
                    <div class="row100">

                        <div class="inputBx50">
                            <input type="text" name="desname" placeholder="Digite seu Nome Completo" required>
                        </div>

                        <div class="inputBx50">
                            <input type="text" name="nrphone" placeholder="Digite um Numero para Contato" required>
                        </div>

                    </div>

                    <div class="row100">
                                       
                        <div class="inputBx100">
                            <input type="email" name="desemail" placeholder="Endereço de Email" required>
                        </div>

                    </div>

                    <div class="row100">
                                       
                        <div class="inputBx100">
                            <select name="typemessage" id="" required>
                                <option value="">Selecione o tipo de Menssagem</option>
                                <option value="Orçamento">Orçamento</option>
                                <option value="Dúvida">Dúvida</option>
                                <option value="Reclamação">Reclamação</option>
                                <option value="Outros...">Outros...</option>
                            </select>
                        </div>

                    </div>

                    <div class="row100">

                        <div class="inputBx100">
                            <textarea name="desmessage" placeholder="Mensagem" required></textarea>
                        </div>

                    </div>

                    <div class="row100">

                        <div class="inputBx100">
                            <input type="submit" value="Enviar">
                        </div>

                    </div>

                </form>
            </div>

            <div class="sci">
                <ul>
                    <li><a href=""><img src="/resources/img/facebook.png"></a></li>
                    <li><a href=""><img src="/resources/img/twitter.png"></a></li>
                    <li><a href=""><img src="/resources/img/linkedin.png"></a></li>
                </ul>
            </div>

            <p class="copyright">Criado por <a href="#team">Equipe de Desenvolvimento</a><br>© 2021 Copyright: www.lumira.com.br</p>
        
        </div>
    </section>


    <script type="text/javascript">

        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })

        function toggle() {
            var header = document.querySelector("header");
            header.classList.toggle("active");
        }

    </script>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>