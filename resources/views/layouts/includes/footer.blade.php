
<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>

{{--select 2--}}
<script type="text/javascript" src="{{ asset('admin_assets/plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('admin_assets/js/main.js') }}"></script>

{{--ckeditor--}}
<script src="{{ asset('admin_assets/plugins/ckeditor/ckeditor.js') }}"></script>

{{--magnific-popup--}}
<script src="{{ asset('admin_assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>


<script src="{{ asset('js/plugins/pace.min.js') }}"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('js/plugins/chart.js') }}"></script>
{{--apex chart--}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

{{--custom--}}
<script src="{{ asset('admin_assets/js/custom/index.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom/roles.js') }}"></script>

<script>
    $(document).ready(function () {

        //delete
        $(document).on('click', '.delete, #bulk-delete', function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "alert",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        let url = that.closest('form').attr('action');
                        let data = new FormData(that.closest('form').get(0));

                        let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                        let originalText = that.html();
                        that.html(loadingText);

                        n.close();

                        $.ajax({
                            url: url,
                            data: data,
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (response) {

                                $("#record__select-all").prop("checked", false);

                                $('.datatable').DataTable().ajax.reload();

                                new Noty({
                                    layout: 'topRight',
                                    type: 'alert',
                                    text: response,
                                    killer: true,
                                    timeout: 2000,
                                }).show();

                                that.html(originalText);
                            },

                        });//end of ajax call

                    }),

                    Noty.button("@lang('site.no')", 'btn btn-danger mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

    });//end of document ready

    CKEDITOR.config.language = "{{ app()->getLocale() }}";

    //select 2
    $('.select2').select2({
        'width': '100%',
    });

</script>

@stack('scripts')

</body>
</html>
