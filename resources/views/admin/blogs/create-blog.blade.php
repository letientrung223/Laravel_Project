@extends('admin.layouts.app')

@section('content')
@if(session('success'))
    <div class= "alert alert-success alert-dismissible">
    <button type ="button" class ="close" data-dismiss ="alert" aria-hidden ="true">X</button>
    <h4><i class="icon fa fa-check"></i>Thông báo </h4>
    <h3> Thêm Blog thành công</h3>
    </div>
@endif 
@if($errors->any())
    <div class = "alert alert-danger alert-dismissible">
        <button type ="button" class ="close" data-dismiss ="alert" aria-hidden="true">X</button>
        <h4><i class ="icon fa fa-check"></i>Thông báo </h4>
        <ul>
            @foreach($errors ->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Add Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
</div>
 <div class="container-fluid">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" 
                                action =""
                                enctype="multipart/form-data" class="form-horizontal form-material">
                                    @csrf
                                    @method('post')

                                    <div class="form-group">
                                        <label class="col-md-12">Title</label>
                                        <div class="col-md-12">
                                            <input type="text"    name= "title" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Image</label>
                                        <div class="col-md-12">
                                            <input type="file"   name= "image" class="form-control form-control-line" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Description</label>
                                        <div class="col-md-12">
                                            <textarea name="description" class='form-control' ></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Content</label>
                                        <div class="col-md-12">
                                            <textarea name="txtContent" class='form-control' id='editor'></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Add Blog</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

@endsection
