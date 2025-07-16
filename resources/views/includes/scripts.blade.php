<!--   Core JS Files   -->
<script src="/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
{{-- <script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> --}}

<!-- jQuery Vector Maps -->
<script src="/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="/assets/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="/assets/js/kaiadmin.min.js"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000, // Durasi animasi dalam milidetik
        once: true, // Animasi hanya terjadi sekali
    });
</script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="/assets/js/setting-demo.js"></script>
<script src="/assets/js/demo.js"></script>
<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>

<script>
    //== Class definition
    var SweetAlert2Demo = (function() {
        //== Demos
        var initDemos = function() {
            //== Sweetalert Demo 1
            $("#alert_demo_1").click(function(e) {
                swal("Good job!", {
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
            });

            //== Sweetalert Demo 2
            $("#alert_demo_2").click(function(e) {
                swal("Here's the title!", "...and here's the text!", {
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
            });

            //== Sweetalert Demo 3
            $("#alert_demo_3_1").click(function(e) {
                swal("Good job!", "You clicked the button!", {
                    icon: "warning",
                    buttons: {
                        confirm: {
                            className: "btn btn-warning",
                        },
                    },
                });
            });

            $("#alert_demo_3_2").click(function(e) {
                swal("Good job!", "You clicked the button!", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: "btn btn-danger",
                        },
                    },
                });
            });

            $("#alert_demo_3_3").click(function(e) {
                swal("Good job!", "You clicked the button!", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
            });

            $("#alert_demo_3_4").click(function(e) {
                swal("Good job!", "You clicked the button!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: "btn btn-info",
                        },
                    },
                });
            });

            //== Sweetalert Demo 4
            $("#alert_demo_4").click(function(e) {
                swal({
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "Confirm Me",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true,
                        },
                    },
                });
            });

            $("#alert_demo_5").click(function(e) {
                swal({
                    title: "Input Something",
                    html: '<br><input class="form-control" placeholder="Input Something" id="input-field">',
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "Input Something",
                            type: "text",
                            id: "input-field",
                            className: "form-control",
                        },
                    },
                    buttons: {
                        cancel: {
                            visible: true,
                            className: "btn btn-danger",
                        },
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                }).then(function() {
                    swal("", "You entered : " + $("#input-field").val(), "success");
                });
            });

            $("#alert_demo_6").click(function(e) {
                swal("This modal will disappear soon!", {
                    buttons: false,
                    timer: 3000,
                });
            });

            $("#alert_demo_7").click(function(e) {
                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    buttons: {
                        confirm: {
                            text: "Yes, delete it!",
                            className: "btn btn-success",
                        },
                        cancel: {
                            visible: true,
                            className: "btn btn-danger",
                        },
                    },
                }).then((Delete) => {
                    if (Delete) {
                        swal({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            type: "success",
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                    } else {
                        swal.close();
                    }
                });
            });

            $("#alert_demo_8").click(function(e) {
                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    buttons: {
                        cancel: {
                            visible: true,
                            text: "No, cancel!",
                            className: "btn btn-danger",
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            className: "btn btn-success",
                        },
                    },
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                    } else {
                        swal("Your imaginary file is safe!", {
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                    }
                });
            });
        };

        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    })();

    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>
