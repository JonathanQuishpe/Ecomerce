<script src="{{ asset('frontend/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/shuffle.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/plugins/fancybox/fancybox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/whatsapp/floating-wpp.min.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" type="text/javascript"></script>
<script src="https://contable.eurolatina.travel/js/jquery.loading.js"></script>
@stack('scripts')

<script type="text/javascript">
    $(function () {
    $('#myDiv').floatingWhatsApp({
    phone: '593998319686',
            message: "Me gustaría obtener más información sobre sus productos.",
    });
    });
    /* $(function(){
     $('.carousel').carousel({
     interval: 1000
     });
     });*/
</script>