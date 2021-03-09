@extends('layouts.main_layout')

@section('title')
    IT Beep Form
@endsection

@section('body')


    <nav class="navbar navbar-expand-lg  text-white" style="background-color:#43BFC7">
        <a class="navbar-brand text-white" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>

    <body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('dashboard_theme/images/ITBEEP_LOGO.png')}}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form id="form" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="au-input au-input--full" type="text" name="name"
                                           placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input class="au-input au-input--full" type="tel" name="mobile"
                                           placeholder="Mobile" value="{{ old('mobile') }}">
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email"
                                           placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="login-checkbox">

                                </div>
                            <!-- Button trigger modal -->
                                <button type="button" class="au-btn au-btn--block au-btn--green m-b-20"
                                        data-toggle="modal" data-target="#exampleModalCenter">
                                    SEND
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($services as $service)
                                                    <button id={{$service->name}}  value="0" onClick="selector(this
                                                    .id)"
                                                            type="button"
                                                            class="btn btn-secondary pr-4 pl-4"
                                                            >
                                                        {{$service->name}}</button>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button id="goToPeriod"type="button" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#exampleModalCenter2" style="background-color:#43BFC7	"
                                                >Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle2">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($intrests as $intrest)
                                                    <button id={{$intrest->name}}  value="0" onClick="intrest(this
                                                    .id)"
                                                            type="button"
                                                            class="btn btn-secondary pr-4 pl-4"
                                                    >
                                                        {{$intrest->name}}</button>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button id="goToPeriod2" type="submit" class="btn
                                                btn-primary" style="background-color:#43BFC7	">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input id="servicehid1" type="hidden" name="service1" value="0" />
                                <input id="servicehid2" type="hidden" name="service2" value="0" />
                                <input id="servicehid3" type="hidden" name="service3" value="0" />
                                <input id="intresthide" type="hidden" name="intreset" value="general" />

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </body>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#form').on('submit', function (event){
              event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/send",
                    data: $('#form').serialize(),
                    success: function (response){
                        console.log(response)
                        Swal.fire(
                            'Good job!',
                            'check Your email!',
                            'success'
                        )
                        $('#exampleModalCenter').modal('hide');
                        $('#exampleModalCenter2').modal('hide');
                    },
                    error: function (error){
                        console.log(error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please Enter Correct Data!',
                        })
                        $('#exampleModalCenter').modal('hide')
                    }
                });
            });
        });

    </script>

    <script>
        document.getElementById('goToPeriod').disabled = true;
    </script>

    <script>
        function selector(id) {
            let service1 = document.getElementById("service1").value;
            let service2 = document.getElementById("service2").value;
            let service3 = document.getElementById("service3").value;
            if ( id == 'service1' && service1 == 0) {
                document.getElementById("service1").value = 1;
                document.getElementById("servicehid1").value = 1;
                document.getElementById("service1").className = "btn btn-primary pr-4 pl-4";
                document.getElementById('goToPeriod').disabled = false;
            }
            else if( id == 'service1' && service1 == 1){
                document.getElementById("service1").value = 0;
                document.getElementById("servicehid1").value = 0;
                document.getElementById("service1").className = "btn btn-secondary pr-4 pl-4";
            }
            if (id == 'service2' && service2 == 0) {
                document.getElementById("service2").value = 1;
                document.getElementById("servicehid2").value = 1;
                document.getElementById("service2").className = "btn btn-primary pr-4 pl-4";
                document.getElementById('goToPeriod').disabled = false;
            }
            else if( id == 'service2' && service2 == 1){
                document.getElementById("service2").value = 0;
                document.getElementById("servicehid2").value = 0;
                document.getElementById("service2").className = "btn btn-secondary pr-4 pl-4";
            }
            if (id == 'service3' && service3 == 0) {
                document.getElementById("service3").value = 1;
                document.getElementById("servicehid3").value = 1;
                document.getElementById("service3").className = "btn btn-primary pr-4 pl-4";
                document.getElementById('goToPeriod').disabled = false;
            }
            else if( id == 'service3' && service3 == 1){
                document.getElementById("service3").value = 0;
                document.getElementById("servicehid3").value = 0;
                document.getElementById("service3").className = "btn btn-secondary pr-4 pl-4";
            }
        }
    </script>



    <script>
        function intrest(id) {
            let intrest1 = document.getElementById("General").value;
            let intrest2 = document.getElementById("Week").value;
            let intrest3 = document.getElementById("Month").value;
            if ( id == 'General' && intrest1 == 0) {
                document.getElementById("intresthide").value = 'General';
                document.getElementById("General").className = "btn btn-primary pr-4 pl-4";
                document.getElementById("Week").className = "btn btn-secondary pr-4 pl-4";
                document.getElementById("Month").className = "btn btn-secondary pr-4 pl-4";
            }
            if (id == 'Week' && intrest2 == 0) {
                document.getElementById("intresthide").value = 'Week';
                document.getElementById("Week").className = "btn btn-primary pr-4 pl-4";
                document.getElementById("General").className = "btn btn-secondary pr-4 pl-4";
                document.getElementById("Month").className = "btn btn-secondary pr-4 pl-4";
            }

            if ( id == 'Month' && intrest3 == 0) {
                document.getElementById("intresthide").value = 'Month';
                document.getElementById("Month").className = "btn btn-primary pr-4 pl-4";
                document.getElementById("General").className = "btn btn-secondary pr-4 pl-4";
                document.getElementById("Week").className = "btn btn-secondary pr-4 pl-4";
            }
        }
    </script>

@endsection
