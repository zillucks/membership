<script>
    $(function () {

        @if (request()->session()->has('success'))
            $.notify({
                icon: 'fas fa-check',
                title: "{{ request()->session()->get('success')['title'] }}",
                message: "{{ request()->session()->get('success')['message'] }}",
            }, {
                type: 'success',
                delay: 3000,
                timer: 1000,
                allow_dismiss: true,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
            });
        @endif

        @if (request()->session()->has('error'))
            $.notify({
                icon: 'fas fa-exclamation-triangle',
                title: "{{ request()->session()->get('error')['title'] }}",
                message: "{{ request()->session()->get('error')['message'] }}",
            }, {
                type: 'danger',
                delay: 5000,
                timer: 1000,
                allow_dismiss: true,
                mouse_over: 'pause',
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
            });
        @endif

        @if (request()->session()->has('deleted'))
            $.notify({
                icon: 'fas fa-check',
                title: "{{ request()->session()->get('deleted')['title'] }}",
                message: "{{ request()->session()->get('deleted')['message'] }}",
            }, {
                type: 'danger',
                delay: 3000,
                timer: 1000,
                allow_dismiss: true,
                mouse_over: 'pause',
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
            });
        @endif
    })
</script>