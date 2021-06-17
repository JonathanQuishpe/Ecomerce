<!-- ========================= FOOTER ========================= -->
<footer class="section-footer">
    <div class="container">
        <section class="footer-top padding-top">
            <div class="row">
                <aside class="col-sm-3 col-md-3 white">
                    <h5 class="title">Servicio al cliente</h5>
                    <ul class="list-unstyled">
                        <li> <a href="#">Contáctanos</a></li>
                        <li> <a href="#">Términos y Condiciones</a></li>
                        <li> <a href="#">Reclamos y Sugerencias</a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-3 white">
                    <h5 class="title">Mi cuenta</h5>
                    <ul class="list-unstyled">
                        @guest
                        <li> <a href="{{ route('login') }}"> Inicio de Sesión </a></li>
                        <li> <a href="{{ route('register') }}"> Registro de Usuario </a></li>
                        <li> <a href="#"> Configuración de cuenta </a></li>
                        @endguest
                        <li> <a href="{{ route('checkout.cart') }}"> Mi carrito de compras </a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-3 white">
                    <h5 class="title">Acerca de</h5>
                    <ul class="list-unstyled">
                        <li> <a href="#"> Como comprar </a></li>
                        <li> <a href="#"> Entrega y Pago </a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3">
                    <article class="white">
                        <h5 class="title">Contacto</h5>
                        <p>
                            <strong>Telef.: </strong> 0998318686 
                            <br>
                            <strong>Correo:</strong> ventas@jackmodaecuador.com
                        </p>

                        <div class="btn-group white">
                            <a class="btn btn-facebook" title="Facebook" target="_blank" href="{{ config('settings.social_facebook') }}"><i
                                    class="fab fa-facebook-f  fa-fw"></i></a>
                            <a class="btn btn-instagram" title="Instagram" target="_blank" href="{{ config('settings.social_instagram') }}"><i
                                    class="fab fa-instagram  fa-fw"></i></a>
                            <!--<a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i
                                    class="fab fa-youtube  fa-fw"></i></a>
                            <a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i
                                    class="fab fa-twitter  fa-fw"></i></a>-->
                        </div>
                    </article>
                </aside>
            </div>
            <!-- row.// -->
            <br>
        </section>
        <section class="footer-bottom row border-top-white">
            <div class="col-sm-6">
                <p class="white">
                    <strong>Desarrollado por TraceRoot</strong>
                </p>
            </div>
            <div class="col-sm-6">
                <p class="text-md-right text-white-50">

                </p>
            </div>
        </section>
        <!-- //footer-top -->
    </div>
    <!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
