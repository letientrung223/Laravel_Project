@extends('admin.layouts.app')

@section('content')
 @php
    $html = '';
    @endphp
    @foreach ($blogs as $blog)
        @php
        $html .= '
        <tr role="row">
            <td>' . $blog->{'id'} . '</td>
            <td>' . $blog->{'title'} . '</td>
            
            <td>' . $blog->{'description'} . '</td>
            <td>
                <a href="edit/'.$blog->id.'">Edit</a>

                <a href="delete/'.$blog->id.'">Delete</a>
            </td>
        </tr>';
        @endphp
    @endforeach
	 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Blogs</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>   
    <div class="container-fluid">
    	<div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                
                                <th>Description</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            {!!$html!!}
                        </tbody>
                    </table>
                   <button class="btn btn-success"><a href="add-blog" style="color: white;font-weight: bold;">ADD BLOG</a></button>
    </div>

@endsection
