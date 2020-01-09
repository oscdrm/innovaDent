@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Pacientes</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/patients')}}">Pacientes</a>
                        </li>
                        <li class="active">
                            <strong>Perfil de paciente</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">


            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="/img/profile.jpg" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    Alex Smith
                                </h2>
                                <h4>Founder of Groupeq</h4>
                                <small>
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered alteration in some form Ipsum available.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{url('/patients/create')}}">
                        <div class="widget lazur-bg p-lg text-center">
                            <div class="m-b-md">
                                <i style="margin-bottom:5px;" class="fa fa-user-o fa-4x"></i>
                                <h3 class="font-bold no-margins">
                                    Nueva Cita
                                </h3>
                            </div>
                        </div>
                    </a>      
                </div>

                <div class="col-md-3">
                    <a href="{{url('/patients/create')}}">
                        <div class="widget navy-bg p-lg text-center">
                            <div class="m-b-md">
                                <i style="margin-bottom:5px;" class="fa fa-user-o fa-4x"></i>
                                <h3 class="font-bold no-margins">
                                    Nuevo Tratamiento
                                </h3>
                            </div>
                        </div>
                    </a>      
                </div>


            </div>
            <div class="row">

                <div class="col-lg-7">
                        <div class="ibox">
                            <div class="ibox-content">
                            <div class="row wrapper border-bottom white-bg page-heading">
                                <div class="col-lg-9">
                                    <h2>Listado de Tratamientos</h2>
                                </div>
                            </div>
                    
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
                                        <th>ID Tratamiento</th>
                                        <th data-hide="phone">Paciente</th>
                                        <th data-hide="phone">Doctor</th>
                                        <th data-hide="phone">Tipo de tratamiento</th>
                                        <th data-hide="phone,tablet" >Numero de Sesiones</th>
                                        <th data-hide="phone">Status</th>
                                        <!--<th class="text-right">Action</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                            
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                               
                                            </td>
                                            <td>
                                               
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    

                    <div class="ibox">
                        <div class="ibox-content">
                                <h3>About Alex Smith</h3>

                            <p class="small">
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't.
                                <br/>
                                <br/>
                                If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                                anything embarrassing
                            </p>

                            <p class="small font-bold">
                                <span><i class="fa fa-circle text-navy"></i> Online status</span>
                                </p>

                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Followers and friends</h3>
                            <p class="small">
                                If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                                anything embarrassing
                            </p>
                            <div class="user-friends">
                                <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a6.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a8.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                            </div>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Personal friends</h3>
                            <ul class="list-unstyled file-list">
                                <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                                <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                                <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                                <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                                <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                                <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Private message</h3>

                            <p class="small">
                                Send private message to Alex Smith
                            </p>

                            <div class="form-group">
                                <label>Subject</label>
                                <input type="email" class="form-control" placeholder="Message subject">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" placeholder="Your message" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary btn-block">Send</button>

                        </div>
                    </div>

                </div>
                <!-- INICIO TRATAMIENTOS-->
                <div class="col-lg-5">
                    <!-- Tratamiento -->
                    <div class="social-feed-box">
                        <div class="social-avatar">
                            <div class="media-body">
                                <h3>Tratamiento de Brackets</h3>
                                <small class="text-muted">Fecha de Inicio: 4:21 pm - 12.06.2014</small>
                            </div>
                        </div>
                        <div class="social-body">
                            
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Tratamiento</small>
                                        <h4>Endodoncia</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">Doctor</small>
                                        <h4>Nora</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Numero de Sesiones</small>
                                        <h4>10</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Costo Total</small>
                                        <h4>$500</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Sesiones</small>
                                        <h4>3</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">Pago</small>
                                        <h4>$400</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="social-footer">
                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a1.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                                    <br/>
                                    <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                                    <small class="text-muted">12.06.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a2.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    Making this the first true generator on the Internet. It uses a dictionary of.
                                    <br/>
                                    <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                    <small class="text-muted">10.07.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a3.jpg">
                                </a>
                                <div class="media-body">
                                    <textarea class="form-control" placeholder="Write comment..."></textarea>
                                </div>
                            </div>

                        </div>

                    </div><!-- End Tratamiento-->
                    <!-- Historia Clinica -->
                    <div class="social-feed-box">

                        <div class="pull-right social-action dropdown">
                            <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu m-t-xs">
                                <li><a href="#">Config</a></li>
                            </ul>
                        </div>
                        <div class="social-avatar">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/a6.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#">
                                    Andrew Williams
                                </a>
                                <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                            </div>
                        </div>
                        <div class="social-body">
                            <p>
                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                default model text.
                            </p>
                            <p>
                                Lorem Ipsum as their
                                default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                default model text.
                            </p>
                            <img src="img/gallery/3.jpg" class="img-responsive">
                            <div class="btn-group">
                                <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
                                <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
                                <button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
                            </div>
                        </div>
                        <div class="social-footer">
                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a1.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                                    <br/>
                                    <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                                    <small class="text-muted">12.06.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a2.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    Making this the first true generator on the Internet. It uses a dictionary of.
                                    <br/>
                                    <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                    <small class="text-muted">10.07.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a8.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    Making this the first true generator on the Internet. It uses a dictionary of.
                                    <br/>
                                    <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                    <small class="text-muted">10.07.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    <img alt="image" src="img/a3.jpg">
                                </a>
                                <div class="media-body">
                                    <textarea class="form-control" placeholder="Write comment..."></textarea>
                                </div>
                            </div>

                        </div>

                    </div>




                </div>


 

        </div>

@endsection